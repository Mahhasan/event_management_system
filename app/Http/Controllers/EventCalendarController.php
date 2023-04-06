<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Registration;
use Auth;
use Carbon\Carbon;


use Illuminate\Http\Request;

class EventCalendarController extends Controller
{
    
    public function event_calendar()
    {
        // dd($registrations);
        // return view('calendar.event_calendar');
        $events = Event::all();

        $data = [];

        foreach ($events as $event) {
            $data[] = [
                'title' => $event->title,
                'start_datetime' => \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i:s'),
                'end_datetime' => $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i:s') : null,
                'description' => $event->description,
                'location' => $event->location,
            ];
        }

        // return response()->json($data);
        return view('calendar.event_calendar', compact('events'));
        
        
    }

    // public function getCalendarData()
    // {
    //     $events = Event::all();

    //     $data = [];

    //     foreach ($events as $event) {
    //         $data[] = [
    //             'title' => $event->title,
    //             'start_datetime' => \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i:s'),
    //             'end_datetime' => $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i:s') : null,
    //             'description' => $event->description,
    //             'location' => $event->location,
    //         ];
    //     }

    //     return response()->json($data);
    // }
}
