<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $q       = trim((string) $request->get('q', ''));
        $eventId = (int) $request->get('event_id', 0);
        $status  = $request->get('status'); // pending/verified/cancelled

        $registrations = EventRegistration::query()
            ->with('event:id,title')
            ->when($eventId, fn($qq) => $qq->where('event_id', $eventId))
            ->when($status,  fn($qq) => $qq->where('status', $status))
            ->when($q, function ($qq) use ($q) {
                $qq->where(function ($w) use ($q) {
                    $w->where('full_name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('transaction_id', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        $events = Event::orderBy('title')->get(['id', 'title']);

        return view('admin.event_registrations.index', compact('registrations', 'events', 'q', 'eventId', 'status'));
    }

    public function destroy(EventRegistration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Registration deleted.');
    }

    public function verify($id)
    {
        $registration = EventRegistration::find($id);
        if ($registration->status !== 'verified') {
            $registration->update(['status' => 'verified']);
        }
        return back()->with('success', 'Registration verified.');
    }
    // Optional: CSV export
    public function export(Request $request)
    {
        // Dynamic filename (event/status সহ)
        $fileNameBase = 'event_registrations';
        if ($request->filled('event_id')) {
            $title = Event::find($request->event_id)?->title;
            $fileNameBase .= '_' . Str::slug($title ?? ('event-' . $request->event_id));
        }
        if ($request->filled('status')) {
            $fileNameBase .= '_' . Str::slug($request->status);
        }
        $fileName = $fileNameBase . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $query = EventRegistration::with('event:id,title')->orderBy('id');

        // === Apply filters ===
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->integer('event_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $search = '%' . $request->string('q') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('phone', 'like', $search)
                    ->orWhere('transaction_id', 'like', $search);
            });
        }
        // =====================

        return response()->stream(function () use ($query) {
            $out = fopen('php://output', 'w');

            // (Optional) Excel-friendly UTF-8 BOM
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Header
            fputcsv($out, ['ID', 'Event', 'Name', 'Email', 'Phone', 'Ticket', 'Amount', 'Method', 'TxnID', 'Status', 'Created']);

            // Memory-safe streaming
            $query->chunkById(1000, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->id,
                        $r->event?->title,
                        $r->full_name,
                        $r->email,
                        $r->phone,
                        $r->ticket_type,
                        $r->amount,
                        $r->payment_method,
                        $r->transaction_id,
                        $r->status,
                        optional($r->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($out);
        }, 200, $headers);
    }
}
