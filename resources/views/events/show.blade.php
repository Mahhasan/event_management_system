@extends('layouts.master')

@section('content')
<small class="text-left ml-1"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Get Back</a></small>
<div class="card text-center">
    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card-header">
      {{ $event->title }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img id="blah" src="/img/{{ $event->image}}" width="240" height="240" class="rounded" alt="your image" />
                <div class="mt-3">
                    <strong><i class="fa fa-map-marker" aria-hidden="true"></i> Event Location:</strong> {{ $event->location }}
                </div>
                <a href="{{ route('registrations.create', $event) }}" class="btn btn-outline-primary btn-sm btn-block">Get Register</a>
            </div>
            <div class="col-md-8 text-left">
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
        </div>
    </div>
</div>

<br><br>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Event Participants</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ticket Quantity</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($registrations as $key=> $registration)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $registration->name }}</td>
                                        <td>{{ $registration->email }}</td>
                                        <td>{{ $registration-> ticket_quantity }}</td>
                                        <td>
                                            @if($registration->is_paid)
                                                <span class="badge badge-success">Paid</span>
                                            @else
                                                <span class="badge badge-warning">Unpaid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('registrations.show', [$event, $registration]) }}" class="btn btn-sm btn-primary mr-1">View</a>
                                                <a href="{{ route('registrations.edit', [$event, $registration]) }}" class="btn btn-sm btn-secondary mr-1">Edit</a>
                                                <form action="{{ route('registrations.destroy', [$event, $registration]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection