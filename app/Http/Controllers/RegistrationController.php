<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Event;
use Illuminate\Http\Request;
use Stripe\Stripe;

class RegistrationController extends Controller
{
    public function create(Event $event)
    {
        return view('events.registrations.create', compact('event'));
    }

    public function store(Event $event, Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'payment_method' => 'required',
        ]);

        $registration = new Registration();
        $registration->event_id = $event->id;
        $registration->user_id = auth()->user()->id;
        $registration->ticket_quantity = $request->quantity;
        $registration->total_amount = $event->ticket_price * $request->quantity;
        $registration->payment_intent_id = $request->payment_method;
        $registration->save();

        return redirect()->route('events.show', $event)->with('success', 'Registration Successful!');
    }
}
