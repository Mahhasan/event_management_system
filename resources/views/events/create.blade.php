@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Create Event</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
            @endif
            <form action="{{ route('events.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label for="title">Event Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Event Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control @error('start_datetime') is-invalid @enderror" value="{{ old('start_datetime') }}" required>
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date">End Date</label>
                        <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control @error('end_datetime') is-invalid @enderror" value="{{ old('end_datetime') }}" required>
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="location">Event Location</label>
                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                    @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Ticket Price</label>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="capacity">Seat Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" min="1" required>
                        @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type='file' id="inputImage" class="form-control-file" name="image"/>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection