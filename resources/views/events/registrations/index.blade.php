@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Event Registrations</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ticket Quantity</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($registrations as $registration)
                                    <tr>
                                        <th scope="row">{{ $registration->id }}</th>
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
