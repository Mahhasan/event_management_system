@extends('layouts.master')

@section('content')
    <div class="container">
    <small class="text-left ml-1"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Get Back</a></small>

        @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $registration->name }}'s Registration</div>

                    <div class="card-body">
                        <p><strong>Event Name:</strong> {{ $event->title }}</p>
                        <p><strong>Name:</strong> {{ $registration->name }}</p>
                        <p><strong>Email:</strong> {{ $registration->email }}</p>
                        <p><strong>Phone:</strong> {{ $registration->phone }}</p>
                        <p><strong>Ticket Quantity:</strong> {{ $registration->ticket_quantity }}</p>
                        <p><strong>Single Ticket Price:</strong> {{ $event->price }}</p>
                        <p><strong>Total Ticket Price:</strong> {{ $registration->total_amount }}</p>
                        <p><strong>Payment Status:</strong>
                            @if($registration->is_paid)
                                <span class="badge badge-success">Paid</span>
                            @else
                                <span class="badge badge-warning">Unpaid</span>
                            @endif
                        </p>

                        <a href="{{ route('registrations.edit', [$event, $registration]) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('registrations.destroy', [$event, $registration]) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this registration?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
