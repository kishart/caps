@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Feedbacks</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Feedback</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                @foreach ($appointment->feedbacks as $feedback)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $feedback->feedback }}</td>
                        <td>{{ $appointment->date }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
