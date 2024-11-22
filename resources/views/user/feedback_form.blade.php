@extends('layouts.nav')

@section('content')
<div class="container">
    <h2>Feedback for Appointment on {{ $appointment->date }}</h2>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display error message if feedback already submitted -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Check if feedback already exists -->
    @if ($appointment->feedback)
        <div class="alert alert-info">
            You have already submitted feedback for this appointment.
        </div>
        <button class="btn btn-secondary mt-3" disabled>Feedback Submitted</button>
    @else
        <form action="{{ route('submit.feedback', $appointment->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="feedback">Your Feedback</label>
                <textarea name="feedback" id="feedback" rows="5" class="form-control" placeholder="Enter your feedback here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
        </form>
    @endif
</div>
@endsection

