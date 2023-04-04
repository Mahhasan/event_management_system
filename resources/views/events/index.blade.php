@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Events</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>
    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
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
    </table>
    {{ $events->links() }}
</div>
@endsection