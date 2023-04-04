@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Events</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>
    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- <table class="table">
        <thead>
            <tr>
            <th></th>
            <th>Title</th>
            <!-- <th>Description</th> -->
            <th>Start Date</th>
            <th>End Date</th>
            <th>Location</th>
            <th>Price</th>
            <th>Capacity</th>
            <th>Register</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td><img id="blah" src="/img/{{ $event->image}}" width="240" height="240" class="rounded-circle" alt="your image" /></td>
                <td>{{ $event->title }}</td>
                <!-- <td>{{ $event->description }}</td> -->
                <td>{{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y g:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($event->end_datetime)->format('F j, Y g:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->price }}</td>
                <td>{{ $event->capacity }}</td>
                <td><a href="{{ route('registrations.create', $event) }}">Register</a></td>
                <td>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table> --}}

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <img src="img/{{ $event->image }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="row">
                        <div class="col-sm-7 text-center">
                            <small style="font-size: 11px; color: #ffae00;" class=""><i class="fa fa-clock" aria-hidden="true"></i><b>{{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y g:i A') }}</b></small>
                        </div>
                        <div class="col-sm-5 text-center">
                            <small class="text-info"><i class="fa fa-map-marker" aria-hidden="true"></i> <b>{{ $event->location }}</b></small>
                        </div>
                    </div>
                    {{-- <div class="text-right pr-2">
                        
                        <small><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $event->location }}</small>
                    </div> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        {{-- <div class="row text-center">
                            <div class="col-sm-6">
                                <small style="font-size: 11px;" class=""><b><i class="fa fa-clock" aria-hidden="true"></i> Start Time</b><br> {{ \Carbon\Carbon::parse($event->start_datetime)->format('j F Y, g:i A') }}</small>
                            </div>
                            <div class="col-sm-6">
                                <small style="font-size: 11px;" class=""><b><i class="fa fa-clock-" aria-hidden="true"></i> End Time</b><br> {{ \Carbon\Carbon::parse($event->end_datetime)->format('j F Y, g:i A') }} </small>
                            </div>
                        </div> --}}
                        <div class="row text-center">
                            <div class="col-sm-6">
                                <a href="{{ route('registrations.create', $event) }}" class="btn btn-outline-primary btn-sm btn-block">Register</a>
                            </div>
                            <div class="col-sm-6">  
                                <a href="{{ route('events.show', $event) }}" class="btn btn-outline-info btn-sm btn-block">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection