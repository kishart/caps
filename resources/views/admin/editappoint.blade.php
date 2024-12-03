@extends('layouts.adminsidebar')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/editappoint.css') }}">
    @section('title', 'Edit Apppointment')
</head>
<div class="containerp">
    <p class="title">Edit Booking</p>

    @if (Session::has('success'))
        <div class="alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form method="POST" action="{{ url('admin/editappoint') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        
        <div class="form-group">
            <label for="fname">Name:</label>
            <input type="text" id="fname" name="fname" class="form-control" 
                   placeholder="Enter Name" value="{{ $data->fname }}" required>
            @error('fname')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" 
                   placeholder="Enter Email" value="{{ $data->email }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" 
                   placeholder="Enter Phone Number" value="{{ $data->phone }}" 
                   pattern="^09\d{9}$" title="Phone number must start with 09 and be followed by 9 digits" required>
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" 
                       value="{{ $data->date }}" required>
                @error('date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="text" id="time" name="time" class="form-control" 
                       placeholder="Enter your chosen time" value="{{ $data->time }}" required>
                @error('time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>
        

        <div class="form-group">
            <label for="details">Message:</label>
            <textarea id="details" name="details" class="form-control" 
                      placeholder="Enter your message for another detail" required>{{ $data->details }}</textarea>
            @error('details')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
