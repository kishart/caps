@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feedback for Appointment on {{ $appointment->date }}</h2>

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

    <form action="{{ route('submit.feedback', $appointment->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="feedback">Your Feedback</label>
            <textarea name="feedback" id="feedback" rows="5" class="form-control" placeholder="Enter your feedback here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
    </form>
</div>
@endsection
