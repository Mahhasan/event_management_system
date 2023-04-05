@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ $event->name }} Edit Registration</div>

                    <div class="card-body">
                        <form action="{{ route('registrations.update', [$event, $registration]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Participants Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $registration->name) }}" required>
                                 @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $registration->email) }}" readonly required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $registration->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Quantity">Ticket Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" readonly value="{{ old('quantity', $registration->ticket_quantity) }}" min="1" max="{{ $event->capacity }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="TicketPrice">Single Ticket Price</label>
                                <input type="number" class="form-control @error('ticket_price') is-invalid @enderror" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $event->price) }}" readonly required>
                                @error('ticket_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="TotalAmount">Total Amount</label>
                                <input type="number" class="form-control @error('total_amount') is-invalid @enderror" id="TotalAmount" name="total_amount" value="{{ old('total_amount', $registration->total_amount ) }}" readonly required>
                                @error('total_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p><strong>Payment Status:</strong>
                                    @if($registration->is_paid)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-warning">Unpaid</span>
                                    @endif
                                </p>
                                <!-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_paid" name="is_paid" readonly value="1" {{ old('is_paid', $registration->is_paid) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_paid">Paid</label>
                                </div>
                                @error('is_paid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('registrations.show', [$event, $registration]) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
