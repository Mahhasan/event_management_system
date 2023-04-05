<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Registration;
use Auth;


use Illuminate\Http\Request;

class EventCalendarController extends Controller
{
    //
    public function event_calendar(Registration $Registration, Event $event)
    {
        $registrations = Registration::where('user_id',Auth::user()->id)->get();
        // dd($registrations);
        return view('calendar.event_calendar', compact('registration','registrations', 'event'));
        
        
    }
}
