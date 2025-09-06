<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationCause;
use Illuminate\Http\Request;

class PublicDonateController extends Controller
{

    public function showForm(){
        $causes = DonationCause::where('is_active', true)->orderBy('priority')->get(['id','name']);
        return view('donate', compact('causes')); 
    }

    public function store(Request $request) {
        $data = $request->validate([
            'amount'           => ['required','numeric','min:1'],
            'donation_cause_id'=> ['required','exists:donation_causes,id'],
            'payment_method'   => ['required','in:bkash,nagad,card,bank'],
            'full_name'        => ['nullable','string','max:255'],
            'email'            => ['nullable','email','max:255'],
            'phone'            => ['nullable','string','max:50'],
            'address'          => ['nullable','string','max:255'],
            'is_anonymous'     => ['nullable','boolean'],
            'note'             => ['nullable','string','max:1000'],
        ]);

        $data['is_anonymous'] = (bool)($data['is_anonymous'] ?? false);

        $donation = Donation::create($data);

        // TODO: এখানে গেটওয়ে ইন্টিগ্রেশন হলে redirect to gateway
        // এখন আপাতত ধরা হলো pending অবস্থায় রইলো
        return redirect()->back()->with('success','Thanks! Your donation request was received and is pending review.');
    }
}
