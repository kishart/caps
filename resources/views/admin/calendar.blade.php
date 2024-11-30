@extends('layouts.adminsidebar')

@section('content')
<body>
    <div style="margin-top: 40px">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div class="container">
            <a href="{{ url('add-calendar') }}" class="btn btn-success">Add New Event</a>


            <!-- Calendar and Details Section -->
            <div class="row mt-5">
                <!-- Left Side: Calendar -->
                <div class="col-md-8">
                    <div id="calendar"></div>
                </div>
                <!-- Right Side: Event Details -->
                <div class="col-md-4">
                    <div id="eventDetails" class="border p-3">
                        <h5>Event Details</h5>
                        <p><strong>Available:</strong> <span id="modal-available"></span></p>
                        <p><strong>Note:</strong> <span id="modal-note"></span></p>
                        <p><strong>Start Date:</strong> <span id="modal-start"></span></p>
                        <p><strong>End Date:</strong> <span id="modal-end"></span></p>
                        <p><strong>Start Time:</strong> <span id="modal-start-time"></span></p>
                        <p><strong>End Time:</strong> <span id="modal-end-time"></span></p>
                        <form action="{{ route('admin.schedulelist') }}" method="GET" class="mt-4">
                            <button type="submit" 
                                    class="font-semibold flex items-center p-2 text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <ion-icon name="images" style="font-size: 30px;"></ion-icon>
                                <span class="flex-1 ms-3 whitespace-nowrap">edit</span>
                            </button>
                        </form>
                       
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
                        element.find('.fc-title').append(' - ' + event.available);
                    }
                },
                eventClick: function(event) {
                    $('#modal-available').text(event.available || 'N/A');
                    $('#modal-note').text(event.note || 'N/A');
                    $('#modal-start').text(event.start || 'N/A');
                    $('#modal-end').text(event.end || 'N/A');
                    $('#modal-start-time').text(event.start_time || 'N/A');
                    $('#modal-end-time').text(event.end_time || 'N/A');
                }
            });
        });
    </script>
</body>
@endsection
