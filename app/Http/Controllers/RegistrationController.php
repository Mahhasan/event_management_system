<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Event;
use Illuminate\Http\Request;
use Stripe\Stripe;

class RegistrationController extends Controller
{
    public function index(Event $event)
    {
        $registrations = $event->registrations;

        return view('events.registrations.index', compact('registrations', 'event'));
    }

    public function create(Event $event)
    {
        return view('events.registrations.create', compact('event'));
    }

    public function store(Event $event, Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255',],
        ]);
        

        $registration = new Registration();
        $registration->event_id = $event->id;
        $registration->user_id = auth()->user()->id;
        $registration->name = $request->name;
        $registration->email = $request->email;
        $registration->phone = $request->phone;
        $registration->ticket_quantity = $request->quantity;
        $registration->total_amount = $event->price * $registration->ticket_quantity;
        $registration->payment_intent_id = 'Bkash';
        $registration->is_paid = $request->is_paid;

        $registration->save();

        return redirect()->route('registrations.show', [$event, $registration])->with('success', 'Registration created successfully');
    }

    public function show(Event $event, Registration $registration)
    {
        return view('events.registrations.show', compact('event', 'registration'));
    }

    public function edit(Event $event, Registration $registration)
    {
        return view('events.registrations.edit', compact('event', 'registration'));
    }

    public function update(Request $request, Event $event, Registration $registration)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registrations,email,'.$registration->id.',id,event_id,'.$event->id,
            'phone' => 'required|string|max:20',
        ]);

        $registration->update($validatedData);

        return redirect()->route('registrations.show', [$event, $registration])->with('success', 'Registration updated successfully');
    }

    public function destroy(Event $event, Registration $registration)
    {
        $registration->delete();

        return redirect()->route('registrations.index', $event)->with('success', 'Registration deleted successfully');
    }

}
