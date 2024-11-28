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

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        position: relative;
    }

    /* The Close Button (X) */
    .close {
        color: #aaa;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    /* Button to trigger modal */
    .trigger-btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .trigger-btn:hover {
        background-color: #45a049;
    }
</style>

<body>
    
<div align="center" style="padding: 70px;">
    <table>
        <tr align="center">
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Message</th>
        </tr>

        @foreach($appointments as $appointment)
        <tr align="center">
            <td>{{ $appointment->details }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
            <td>
                @if(strtolower($appointment->status) == 'approved')
                    <a href="{{ route('user.payment', ['id' => $appointment->id]) }}" 
                       class="text-green-500 font-bold underline">
                        {{ ucfirst($appointment->status) }}
                    </a>
                @else
                    {{ ucfirst($appointment->status) }}
                @endif
            </td>

            <td>
                <button class="trigger-btn" id="myBtn-{{ $appointment->id }}">Open Message</button>
            </td>

            <!-- Modal Structure -->
            <div id="myModal-{{ $appointment->id }}" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" id="closeBtn-{{ $appointment->id }}">&times;</span>
                    @if($appointment->message)
                        <p>{{ $appointment->message->message }}</p>
                    @else
                        <p>No messages available</p>
                    @endif
                </div>
            </div>

        </tr>
        @endforeach
    </table>
</div>

<script>
    // Get all buttons and modals
    const modalButtons = document.querySelectorAll('.trigger-btn');
    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close');

    // Add event listeners to open modals
    modalButtons.forEach(button => {
        button.onclick = function() {
            const modalId = button.id.replace('myBtn-', 'myModal-');
            document.getElementById(modalId).style.display = 'block';
        }
    });

    // Add event listeners to close modals
    closeButtons.forEach(button => {
        button.onclick = function() {
            const modalId = button.id.replace('closeBtn-', 'myModal-');
            document.getElementById(modalId).style.display = 'none';
        }
    });

    // Close modal if clicked outside the modal content
    window.onclick = function(event) {
        modals.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
</script>

@endsection
