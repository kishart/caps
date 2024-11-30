@extends('layouts.adminsidebar')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Edit Schedule</h3>
    <form method="POST" action="{{ route('admin.updatecalendar', $schedule->id) }}">
        @csrf
        @method('PUT') <!-- This is the crucial part for spoofing the PUT method -->
        <div class="mb-3">
            <label class="form-label">Available:</label>
            <select name="available" class="form-select">
                <option value="Not Available" {{ $schedule->available == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                <option value="Holiday" {{ $schedule->available == 'Holiday' ? 'selected' : '' }}>Holiday</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Note:</label>
            <input type="text" class="form-control" name="note" value="{{ $schedule->note }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date:</label>
            <input type="date" class="form-control" name="start_date" value="{{ $schedule->start_date }}">
        </div>
        <div class="mb-3">
            <label class="form-label">End Date:</label>
            <input type="date" class="form-control" name="end_date" value="{{ $schedule->end_date }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Start Time:</label>
            <input type="time" class="form-control" name="start_time" value="{{ $schedule->start_time }}">
        </div>
        <div class="mb-3">
            <label class="form-label">End Time:</label>
            <input type="time" class="form-control" name="end_time" value="{{ $schedule->end_time }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
</div>
@endsection
