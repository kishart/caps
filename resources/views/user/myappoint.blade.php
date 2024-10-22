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
            <th>Feedback</th>
        </tr>

        @foreach($appointments as $appointment)
        <tr style="text-align: center;">
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
            
            <!-- Main modal -->
            {{-- <div id="message-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true" 
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Message</h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                                    onclick="hideMessageModal({{ $appointment->id }})">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
            
                        <!-- Modal body with message -->
                        <div class="p-6 space-y-6">
                            @if($appointment->message)
                                <p>{{ $appointment->message->message }}</p>
                            @else
                                <p>No messages available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
             --}}
               
           
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
