@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<title>My Appointment</title>
<style>
    tr {
        background-color: #854836;
    }
    th {
        padding: 10px;
        font-size: 20px;
        color: white;
    }
    td {
        padding: 10px;
        background-color: #dba594;
        color: black;
    }
    /* Increase table width */
    table {
        width: 80%; /* Adjust the width as needed */
        margin: 0 auto; /* Center the table */
    }
</style>

<div align="center" style="padding: 70px;">
    <table>
        <tr align="center">
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Feedback</th>
        </tr>

        @foreach($appointments as $appointment)
        <tr align="center">
            <td>{{ $appointment->details }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
            <td>
                @if(strtolower($appointment->status) == 'approved')
                    <a href="{{ url('payment') }}" style="color: green; font-weight:bold; text-decoration: underline;">
                        {{ ucfirst($appointment->status) }}
                    </a>
                @else
                    {{ ucfirst($appointment->status) }}
                @endif
            </td>
            <td>
                @if($appointment->feedback_requested)
                    @if(!$appointment->feedback_given)
                        <a href="{{ route('feedback.form', $appointment->id) }}" class="btn btn-success">Give Feedback</a>
                    @else
                        <span>Done send feedback</span>
                    @endif
                @else
                    <span>Feedback not requested</span>
                @endif
            </td>
            
        </tr>
        @endforeach
    </table>
</div>

@endsection
