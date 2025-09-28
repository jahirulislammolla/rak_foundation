<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MemberApplicationController extends Controller
{
    public function index(Request $request)
    {
        $q = Member::query()
            ->when(
                $request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected']),
                fn($qr) => $qr->where('status', $request->status)
            )
            ->when(
                $request->filled('type') && in_array($request->type, ['yearly', 'lifetime']),
                fn($qr) => $qr->where('membership_type', $request->type)
            )
            ->when($request->filled('q'), function ($qr) use ($request) {
                $search = '%' . $request->q . '%';
                $qr->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search)
                        ->orWhere('phone', 'like', $search)
                        ->orWhere('membership_no', 'like', $search)
                        ->orWhere('transaction_id', 'like', $search);
                });
            })
            ->orderByDesc('id');

        $members = $q->paginate(20)->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function edit($id)
    {
        $member = Member::find($id);
        return view('admin.members.edit', ['m' => $member]);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['nullable', 'email', 'max:255'],
            'phone'           => ['nullable', 'string', 'max:50'],
            'profession'      => ['nullable', 'string', 'max:255'],
            'address'         => ['nullable', 'string', 'max:500'],
            'membership_type' => ['required', 'in:yearly,lifetime'],
            'is_paid'         => ['nullable', 'boolean'],
            'payment_method'  => ['nullable', 'string', 'max:50'],
            'transaction_id'  => ['nullable', 'string', 'max:100'],
            'note'            => ['nullable', 'string', 'max:1000'],
            'photo'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // keep fee in sync
        $data['fee'] = $data['membership_type'] === 'lifetime' ? 5000 : 1000;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            // Get file name with extension
            $fileNameWithExt = $file->getClientOriginalName();

            // Get just the file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get the file extension
            $extension = $file->getClientOriginalExtension();

            // Create a unique file name
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // $path = $file->storeAs('public/publications', $fileNameToStore);
            $file->move(base_path('public/member'), $fileNameToStore);

            $data['photo_path'] = 'member/' . $fileNameToStore;
        }

        $data['is_paid'] = (bool) ($data['is_paid'] ?? false);
        $member->update($data);

        return redirect()->route('manage-members.index')->with('success', 'Member updated.');
    }

    public function approve(Request $request, $id)
    {
        $member = Member::find($id);
        // Optional: allow admin to mark paid during approval
        $member->is_paid = (bool) $request->boolean('is_paid', $member->is_paid);
        $member->status = 'approved';
        $member->approved_at = now();
        $member->approved_by = Auth::id();
        $member->start_date = now()->toDateString();
        $member->end_date = $member->membership_type === 'yearly'
            ? now()->copy()->addYear()->toDateString()
            : null;

        if (!$member->membership_no) {
            $member->membership_no = Member::makeMembershipNo();
        }

        $member->save();
        return back()->with('success', 'Application approved.');
    }

    public function reject($id)
    {
        $member = Member::find($id);
        $member->status = 'rejected';
        $member->approved_at = null;
        $member->approved_by = null;
        $member->start_date = null;
        $member->end_date = null;
        $member->save();

        return back()->with('success', 'Application rejected.');
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return back()->with('success', 'Record deleted.');
    }

    public function export(Request $request)
    {
        $base = 'members';
        if ($request->filled('status')) $base .= '_' . Str::slug($request->status);
        if ($request->filled('type'))   $base .= '_' . Str::slug($request->type);

        $fileName = $base . '_' . now()->format('Ymd_His') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];
        
        // ফাইলনেমে active filter গুলো যোগ করি
        $query = Member::query()->orderBy('id');

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type') && in_array($request->type, ['yearly', 'lifetime'])) {
            $query->where('membership_type', $request->type);
        }
        // NEW: search filter
        if ($request->filled('q')) {
            $search = '%' . $request->q . '%';
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('phone', 'like', $search)
                    ->orWhere('membership_no', 'like', $search)
                    ->orWhere('transaction_id', 'like', $search);
            });
        }

        // stream response (pagination ছাড়াই, সব matching রেকর্ড যাবে)
        return response()->stream(function () use ($query) {
            $out = fopen('php://output', 'w');

            // Excel-friendly UTF-8 BOM
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Header
            fputcsv($out, [
                'ID',
                'Membership No',
                'Name',
                'Email',
                'Phone',
                'Type',
                'Fee',
                'Paid',
                'Payment Method',
                'Txn ID',
                'Status',
                'Approved At',
                'Approved By (ID)',
                'Start Date',
                'End Date',
                'Created At',
                'Note'
            ]);

            // simple sanitizer (CSV formula injection প্রতিরোধ)
            $safe = function ($v) {
                $s = (string)($v ?? '');
                return preg_match('/^[=\+\-@]/', $s) ? "'" . $s : $s;
            };

            // memory-safe streaming
            $query->chunkById(1000, function ($rows) use ($out, $safe) {
                foreach ($rows as $m) {
                    fputcsv($out, [
                        $m->id,
                        $safe($m->membership_no),
                        $safe($m->name),
                        $safe($m->email),
                        $safe($m->phone),
                        ucfirst($m->membership_type),
                        $m->fee,
                        $m->is_paid ? 'Yes' : 'No',
                        $safe($m->payment_method),
                        $safe($m->transaction_id),
                        ucfirst($m->status),
                        optional($m->approved_at)->format('Y-m-d H:i:s'),
                        $m->approved_by, // চাইলে relation করে নাম দেখাতে পারেন
                        $m->start_date,
                        $m->end_date,
                        optional($m->created_at)->format('Y-m-d H:i:s'),
                        $safe($m->note),
                    ]);
                }
            });

            fclose($out);
        }, 200, $headers);
    }
}
