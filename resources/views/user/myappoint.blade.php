@extends('layouts.nav')
@section('title', 'My Appointments')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/myappoint.css') }}">
<title>My Appointment</title>



<body>
    
<div align="center" style="padding: 70px;">
    <div>
        <table class="myAppointment-table text-black" id="appointmentTable">
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
                    <!-- Modal Header -->
                    <header class="modal-header">
                        <p style="color:black;">Message from Admin</p>
                        <span style="color:black;" class="close" id="closeBtn-{{ $appointment->id }}">&times;</span>
                    </header>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        @if($appointment->message)
                            <p>{{ $appointment->message->message }}</p>
                        @else
                            <p>No messages available</p>
                        @endif
                    </div>
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
