@extends('layouts.adminsidebar')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/editappoint.css') }}">
</head>

<div class="containerp">
    <p class="title">Edit Schedule</p>

    @if (Session::has('success'))
        <div class="alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.updatecalendar', $schedule->id) }}">
        @csrf
        @method('PUT') <!-- This is the crucial part for spoofing the PUT method -->

        <div class="form-group">
            <label for="available">Available:</label>
            <select id="available" name="available" class="form-control">
                <option value="Not Available" {{ $schedule->available == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                <option value="Holiday" {{ $schedule->available == 'Holiday' ? 'selected' : '' }}>Holiday</option>
            </select>
            @error('available')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">Note:</label>
            <input type="text" id="note" name="note" class="form-control" placeholder="Enter note" value="{{ $schedule->note }}" required>
            @error('note')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $schedule->start_date }}" required>
                @error('start_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $schedule->end_date }}">
                @error('end_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                @error('start_time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
                @error('end_time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-primary">Update</button>
    </form>
</div>

@endsection

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
