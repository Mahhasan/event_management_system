@extends('layouts.master')

@section('content')
<div class="container">
    <small class="text-left ml-1"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Get Back</a></small>
    <div class="card text-center">
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
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('registrations.store', $event) }}" method="POST">
                @csrf
                <input name="is_paid" type="hidden" value="0"> 
                <div class="form-group">
                    <label for="name">Participants Name</label>
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="quantity">Ticket Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="1" max="{{ $event->available_spaces }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="PaymentMethod">Payment Method</label>
                    <input type="text" name="payment_method" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="1" max="{{ $event->available_spaces }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> -->
                <div class="form-group">
                    <label for="card-element">Credit or Debit Card:</label>
                    <div id="card-element"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
