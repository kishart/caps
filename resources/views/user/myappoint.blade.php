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
        </tr>

        @foreach($appointments as $appointment)
        <tr align="center">
            <td>{{ $appointment->details }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            <td>{{ $appointment->status }}</td>
        </tr>
        @endforeach
       
    

    </table>
</div>

@endsection