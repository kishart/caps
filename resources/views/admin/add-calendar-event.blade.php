@extends('layouts.adminsidebar')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/editappoint.css') }}">
</head>

<div class="containerp">
    <p class="title">Add Husnie's Appointment Schedule</p>

    @if (Session::has('success'))
        <div class="alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form method="POST" action="{{ url('save-calendar') }}">
        @csrf
        <div class="form-group">
            <label for="available">Available:</label>
            <select id="available" name="available" class="form-control">
                <option value="Not Available">Not Available</option>
                <option value="Holiday">Holiday</option>
            </select>
            @error('available')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">Note:</label>
            <input type="text" id="note" name="note" class="form-control" placeholder="Enter note" value="{{ old('note') }}" required>
            @error('note')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" min="<?= date('Y-m-d') ?>" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" min="<?= date('Y-m-d') ?>" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
                @error('start_time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
                @error('end_time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-primary">Submit</button>
    </form>
</div>

@endsection

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
