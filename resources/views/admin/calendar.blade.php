@extends('layouts.adminsidebar')

@section('content')
<body>
    <div style="margin-top: 40px">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div class="container">
            <!-- Form Section -->
            <div class="input mb-5">
                <form method="POST" action="{{ url('save-calendar') }}">
                    @csrf
                    <div class="d-inline-block me-3">
                        <label class="form-label">Available:</label>
                        <select id="available" name="available" class="form-select">
                            <option value="Not Available">Not Available</option>
                            <option value="Holiday">Holiday</option>
                        </select>
                        @error('available')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Note:</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                        @error('note')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">Start Time:</label>
                        <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                        @error('start_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-inline-block me-3">
                        <label class="form-label">End Time:</label>
                        <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                        @error('end_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
