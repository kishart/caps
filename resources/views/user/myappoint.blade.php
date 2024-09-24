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
            
            <th>Message</th>
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
        
                
                <td>
                    @if($appointment->message)
                        <!-- Link to open the modal -->
                        {{-- <a href="javascript:void(0)" onclick="document.getElementById('message-modal-{{ $appointment->id }}').style.display='block'">
                            You have a message
                        </a>
                
                        <!-- Message Modal using W3.CSS -->
                        <div id="message-modal-{{ $appointment->id }}" class="w3-modal" style="display:none;">
                            <div class="w3-modal-content w3-animate-opacity">
                                <div class="w3-container">
                                    <span onclick="document.getElementById('message-modal-{{ $appointment->id }}').style.display='none'" 
                                          class="w3-button w3-display-topright">&times;</span>
                                    <h5>Message</h5>
                                    <!-- Display the message content -->
                                    <p>{{ $appointment->message->message }}</p> 
                                </div>
                            </div>
                        </div> --}}


                        

<!-- Modal toggle -->


  <button type="button" onclick="showMessageModal({{ $appointment->id }})" data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"> You have a message</button>
  
  <!-- Main modal -->
  <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Message
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <div id="message-modal-{{ $appointment->id }}" class="w3-modal" style="display:none;">
               
                      
                        <p>{{ $appointment->message->message }}</p> 
                  
            </div>
              
  
                    @else
                        <p>No messages</p>
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

<script>

function showMessageModal(appointmentId) {
    var modal = document.getElementById('message-modal-' + appointmentId);
    modal.style.display = 'block'; // Show the modal
}

// Function to close the message modal
function closeMessageModal(appointmentId) {
    var modal = document.getElementById('message-modal-' + appointmentId);
    modal.style.display = 'none'; // Hide the modal
}


</script>
