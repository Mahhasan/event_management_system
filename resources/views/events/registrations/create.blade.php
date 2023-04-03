@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Event Registration</h1>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Starts:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('F j, Y g:i A') }}</li>
                        <li class="list-group-item"><strong>Ends:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('F j, Y g:i A') }}</li>
                        <li class="list-group-item"><strong>Location:</strong> {{ $event->location }}</li>
                        <li class="list-group-item"><strong>Price:</strong> ${{ number_format($event->price, 2) }}</li>
                        <li class="list-group-item"><strong>Capacity:</strong> {{ $event->capacity }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('registrations.store', $event) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="1" max="{{ $event->available_spaces }}" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form> 
</div>
@endsection
