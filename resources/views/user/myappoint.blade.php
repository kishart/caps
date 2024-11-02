@extends('layouts.nav')

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

<div style="padding: 70px; text-align: center;">
    <table style="margin: 0 auto;">
        <tr style="text-align: center;">
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Message</th>
        
        </tr>

        @foreach($appointments as $appointment)
        <tr style="text-align: center;">
            <td>{{ $appointment->details }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
            <td>
                @if(strtolower($appointment->status) == 'approved')
                    <a href="{{ route('payment.show', $appointment->id) }}" style="color: green; font-weight:bold; text-decoration: underline;">
                        {{ ucfirst($appointment->status) }}
                    </a>
                @else
                    {{ ucfirst($appointment->status) }}
                @endif
            </td>
            

            <td>
                @if($appointment->message)
                    <!-- Button to show the modal if a message exists -->
                    <button type="button" onclick="showMessageModal({{ $appointment->id }})" 
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        You have a message
                    </button>
                @else
                    <!-- Display this if no message exists -->
                    <p>No messages</p>
                @endif
            </td>
            
           
            
        </tr>
        @endforeach
    </table>
</div>

@endsection

<script>

function showMessageModal(appointmentId) {
        const modal = document.getElementById('message-modal-' + appointmentId);
        modal.classList.remove('hidden');
    }

    function hideMessageModal(appointmentId) {
        const modal = document.getElementById('message-modal-' + appointmentId);
        modal.classList.add('hidden');
    }


</script>
