<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class PublicEventRegistrationController extends Controller
{
    // UI price map (server-side authoritative)
    private array $ticketMap = [
        'student' => 100,
        'general' => 300,
        'vip'     => 1000,
    ];

    private array $paymentMethods = ['bKash','Nagad','Rocket','Bank Transfer'];

    public function index(Request $request)
    {
         $events = Event::published()
            ->upcoming()
            ->orderByDesc('is_featured')
            ->orderBy('priority')
            ->orderBy('start_at')
            ->get(['id','title','start_at','location']);

        return view('event_registration', [
            'events' => $events,
            'ticketMap' => $this->ticketMap,
            'paymentMethods' => $this->paymentMethods,
            'prefillEvent' => (int) $request->get('event_id', 0),
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'full_name'      => ['required','string','max:255'],
            'email'          => ['required','email','max:255'],
            'phone'          => ['required','string','max:30'],
            'event_id'       => ['required','exists:events,id'],
            'ticket_type'    => ['required','in:student,general,vip'],
            'payment_method' => ['required','in:bKash,Nagad,Rocket,Bank Transfer'],
            'transaction_id' => ['required','string','max:100','unique:event_registrations,transaction_id'],
            'consent'        => ['accepted'],
        ], [
            'consent.accepted' => 'You must agree to the Terms & Conditions.',
        ]);

        // Set amount from server-side map
        $data['amount']  = $this->ticketMap[$data['ticket_type']];
        $data['consent'] = true;

        EventRegistration::create($data);

        return redirect()
            ->back()
            ->with('success', '✅ Registration received! We will contact you soon.');
    }
}