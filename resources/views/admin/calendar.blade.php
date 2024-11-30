@extends('layouts.adminsidebar')

@section('content')
<head>
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
<title>Appointment Schedule</title>
</head>

<body>
    <div style="margin-top: 40px">
        <h3 class="text-start mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div class="containera">
          
            <!-- Calendar and Details Section -->
            <div class="row mt-5">
                <!-- Left Side: Calendar -->
                <div class="col-md-8">
                    <div id="calendar"></div>
                </div>
                <!-- Right Side: Event Details -->
                <div class="col-md-4">
                    <div id="eventDetails" class="border p-3">
                        <h5 class="text-center mb-3"><strong>Event Details</strong></h5>
                        <p><strong>Available:</strong> <span id="modal-available"></span></p>
                        <p><strong>Note:</strong> <span id="modal-note"></span></p>
                        <p><strong>Start Date:</strong> <span id="modal-start"></span></p>
                        <p><strong>End Date:</strong> <span id="modal-end"></span></p>
                        <p><strong>Start Time:</strong> <span id="modal-start-time"></span></p>
                        <p><strong>End Time:</strong> <span id="modal-end-time"></span></p>
                        
                        <div class="action-buttons">
                            <a href="{{ url('add-calendar') }}" class="btn-edit">
                                <ion-icon name="add-circle-sharp"></ion-icon> Add New Event
                            </a>
                            <form action="{{ route('admin.schedulelist') }}" method="GET" class="btn-edit-form">
                                <button type="submit" class="btn-edit">
                                    <ion-icon name="images"></ion-icon> Edit
                                </button>
                            </form>
                        
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Script -->
    <script>
        $(document).ready(function() {
            var calendarEvents = @json($events);
    
            $('#calendar').fullCalendar({
                events: calendarEvents,
                eventRender: function(event, element) {
                    element.css('background-color', '#826C5F');
                    if (event.available) {
                        element.find('.fc-title').append(event.available);
                    }
                },
                eventClick: function(event) {
                    // Format the date to only show the date part (e.g., "YYYY-MM-DD")
                    var startDate = new Date(event.start).toLocaleDateString('en-GB'); // You can change the locale if needed
                    var endDate = new Date(event.end).toLocaleDateString('en-GB'); // Same here
    
                    // Update the modal with formatted start and end dates
                    $('#modal-available').text(event.available || 'N/A');
                    $('#modal-note').text(event.note || 'N/A');
                    $('#modal-start').text(startDate || 'N/A');  // Display formatted start date
                    $('#modal-end').text(endDate || 'N/A');  // Display formatted end date
                    $('#modal-start-time').text(event.start_time || 'N/A');
                    $('#modal-end-time').text(event.end_time || 'N/A');
                }
            });
        });
    </script>
</body>

@endsection
