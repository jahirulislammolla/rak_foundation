<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCause;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateController extends Controller
{
    public function index(Request $request) {
        $filters = [
            'status'  => $request->get('status'),
            'cause_id'=> $request->get('cause_id'),
            'search'  => $request->get('search'),
        ];

        $causes = DonationCause::orderBy('priority')->get(['id','name']);
        $donations = Donation::with('cause','reviewer')
            ->filter($filters)
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        // ছোটখাটো স্ট্যাটস
        $stats = [
            'today'     => Donation::whereDate('created_at', now())->sum('amount'),
            'approved'  => Donation::where('status','approved')->sum('amount'),
            'pending'   => Donation::where('status','pending')->count(),
            'rejected'  => Donation::where('status','rejected')->count(),
        ];

        return view('admin.donations.index', compact('donations','causes','filters','stats'));
    }

    public function approve(Donation $donation) {
        if ($donation->status !== 'approved') {
            $donation->update([
                'status' => 'approved',
                'approved_at' => Carbon::now(),
                'reviewed_by' => Auth::id(),
            ]);
        }
        return back()->with('success','Donation approved.');
    }

    public function reject(Donation $donation) {
        if ($donation->status !== 'rejected') {
            $donation->update([
                'status' => 'rejected',
                'rejected_at' => Carbon::now(),
                'reviewed_by' => Auth::id(),
            ]);
        }
        return back()->with('warning','Donation rejected.');
    }
}