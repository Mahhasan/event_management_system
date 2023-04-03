@extends('layouts.master')

@section('content')
<div class="container">
    <h1>{{ $event->title }}</h1>
    <div class="mb-3">
        <strong>Image:</strong><img id="blah" src="/img/{{ $event->image}}" width="240" height="240" class="rounded-circle" alt="your image" /> <br>
    </div>
    <div class="mb-3">
        <strong>Description:</strong> {{ $event->description }}
    </div>
    <div class="mb-3">
        <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y g:i A') }}
    </div>
    <div class="mb-3">
        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('F j, Y g:i A') }}
    </div>
    <div class="mb-3">
        <strong>Location:</strong> {{ $event->location }}
    </div>
    <div class="mb-3">
        <strong>Price:</strong> {{ $event->price }}
    </div>
    <div class="mb-3">
        <strong>Capacity:</strong> {{ $event->capacity }}
    </div>
    <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection