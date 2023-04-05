@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Events</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>
    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <img src="img/{{ $event->image }}" height="240" class="card-img-top" alt="{{ $event->title }}">
                    <div class="row">
                        <div class="col-sm-7 text-center">
                            <small style="font-size: 11px; color: #ffae00;" class=""><i class="fa fa-clock" aria-hidden="true"></i><b>{{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y g:i A') }}</b></small>
                        </div>
                        <div class="col-sm-5 text-center">
                            <small class="text-info"><i class="fa fa-map-marker" aria-hidden="true"></i> <b>{{ $event->location }}</b></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
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