<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_datetime' => 'required|date|after_or_equal:today',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $image = $request->file('image');
        $new_image = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img'), $new_image);

        $form_data = array(
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'location' => $request->location,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'image' => $new_image
        );
        $data = Event::create($form_data);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $registrations = $event->registrations;
        return view('events.show', compact('event', 'registrations'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_datetime' => 'required|date|after_or_equal:today',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $event->update($input);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
