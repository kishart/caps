@extends('layouts.adminsidebar')

@section('content')
<div class="container">
    <h3 class="text-center font-bold text-xl">Husnie's Appointment Schedule</h3>
    <div class="input">
        <form method="post" action="{{ url('save-calendar') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Available:</label>
                <select id="available" name="available" class="form-control">
                    <option value="Not Available">Not Available</option>
                    <option value="Holiday">Holiday</option>
                </select>
                @error('available')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Note:</label>
                <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                @error('note')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Start Date:</label>
                <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Start Time:</label>
                <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                @error('start_time')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">End Time:</label>
                <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                @error('end_time')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">End Date (Optional):</label>
                <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-11 offset-md-1 mt-5 mb-5">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="modal-title"></h4>
                <p><strong>Start Date:</strong> <span id="modal-start"></span></p>
                <p><strong>End Date:</strong> <span id="modal-end"></span></p>
                <p><strong>Available:</strong> <span id="modal-available"></span></p>
                <p><strong>Note:</strong> <span id="modal-note"></span></p>
                <p><strong>Time:</strong> <span id="modal-time"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function() {
        var calendar = @json($events);

        // Convert event dates to include only the date portion
        calendar.forEach(function(event) {
            event.start = event.start.substr(0, 10); // Assuming start date is in YYYY-MM-DD format
            event.end = event.end ? event.end.substr(0, 10) : ''; // Handle optional end date
        });

        $('#calendar').fullCalendar({
            events: calendar,
            viewRender: function(view, element) {
                var header = element.find('.fc-toolbar h2');
                header.text('Weekdays');
            },
            eventRender: function(event, element) {
                element.css('background-color', '#826C5F');
                if (event.available) {
                    element.find('.fc-title').append(event.available);
                }
            },
            eventClick: function(event) {
                $('#modal-title').text(event.title); // Event title
                $('#modal-available').text(event.available); 
                $('#modal-note').text(event.note);
                $('#modal-start').text(event.start);
                $('#modal-end').text(event.end || 'N/A'); // Show 'N/A' if end date is not set
                $('#modal-time').text(event.start_time + ' - ' + event.end_time); // Display time in the modal
                $('#eventModal').modal('show');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
@endsection
