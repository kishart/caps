@extends('layouts.nav')
@section('title', 'My Appointments')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/myappoint.css') }}">
<title>My Appointment</title>



<body>
    
<div class="table" align="center" style="padding: 10px;">
    <div >
        <table class="myAppointment-table text-black" id="appointmentTable">
            <thead>
        <tr align="center">
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Message</th>
            <th>Payment</th>
        </tr>
    </thead>

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
            



           
            <td>
                <button class="trigger-btna" id="viewPaymentBtn-{{ $appointment->id }}">View Payment Details</button>
            </td>
            
            <!-- Modal Structure -->
            <div id="paymentModal-{{ $appointment->id }}" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <header class="modal-header">
                        <p style="color:black;">Payment Details</p>
                        <span style="color:black;" class="close-payment" id="closePaymentBtn-{{ $appointment->id }}">&times;</span>
                    </header>
            
                    <!-- Modal Body -->
                    <div class="modal-body">
                        @if ($appointment->gcash_image)
                            <img src="{{ asset('storage/' . $appointment->gcash_image) }}"
                                 alt="Proof of Payment"
                                 style="max-width: 800px; max-height: 300px; cursor: pointer; transition: transform 0.3s ease;"
                                 onclick="showZoomed(this)">
                                 <p style="color: black; margin-top: 10px;">
                                    <p><strong>Payment Details</strong>   </p>
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->updated_at)->format('F j, Y') }} <br>
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->updated_at)->format('g:i A') }}
                                </p>
                        @else
                            <p>No proof of payment uploaded.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            
        </tr>
        @endforeach
    </table>
</div>

<button style="background-color: black; color:white; display: none;" id="moveToArchivedButton" disabled>
    Move it to archived
</button>
<div class="pagination-controls">
    <button id="prevPage" onclick="prevPage()" disabled>Previous</button>
    <span id="pageInfo">Page 1</span>
    <button id="nextPage" onclick="nextPage()">Next</button>
</div>


</body>

<script src="{{ asset('js/myappoint.js') }}"></script>
   

@endsection
