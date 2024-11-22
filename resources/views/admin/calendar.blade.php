@extends('layouts.adminsidebar')

@section('content')

<body>

    <div style="margin-top: 40px">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div class="container">
            <!-- Form Section -->
            <div class="input mb-5">
                <form method="post" action="{{ url('save-calendar') }}">
                    @csrf
                    <div class="d-inline-block me-3">
                        <label class="form-label">Available:</label>
                        <select id="available" name="available">
                            <option value="Not Available">Not Available</option>
                            <option value="Holiday">Holiday</option>
                        </select>
                        @error('available')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Note:</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                        @error('note')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Start Time:</label>
                        <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                        @error('start_time')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">End Time:</label>
                        <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                        @error('end_time')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

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
                        <p><strong>Start Date:</strong> <span id="modal-start-time"></span></p>
                        <p><strong>End Date:</strong> <span id="modal-end-time"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <script>
        $(document).ready(function() {
            var calendar = @json($events);
    
            // Convert event dates to include only the date portion
            calendar.forEach(function(event) {
                event.start = event.start.substr(0, 10); // Assuming start date is in YYYY-MM-DD format
                event.end = event.end.substr(0, 10); // Assuming end date is in YYYY-MM-DD format
            });
    
            $('#calendar').fullCalendar({
                events: calendar,
                viewRender: function(view, element) {
                    // Get the header element
                    var header = element.find('.fc-toolbar h2');
    
                    // Replace the header text with weekdays
                    header.text('Weekdays');
                },
                eventRender: function(event, element) {
                    element.css('background-color', '#826C5F'); // Change the background color of the event to brown
                    // Display the note in the event's title
                    if (event.available) {
                        element.find('.fc-title').append(event.available);
                    }
                },
                eventClick: function(event) {
                    // Populate the modal with event details
                    $('#modal-available').text(event.available);
                    $('#modal-note').text(event.note);
                    $('#modal-start').text(event.start);
                    $('#modal-end').text(event.end);
                    $('#modal-start-time').text(event.start_time);
                    $('#modal-end-time').text(event.end_time);
    
                    // Show the modal
                    $('#eventModal').modal('show');
                },
                eventAfterRender: function(event, element) {
                    // Reset styles when events are clicked to avoid issues when clicking multiple times
                    element.css('opacity', '1');  // Reset opacity
                    element.css('background-color', '#826C5F'); // Ensure color stays the same after click
                }
            });
        });
    </script>
    

</body>

@endsection
