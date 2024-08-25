<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 " style="background-color: #efe6dd;"
        aria-label="Sidebar">
        <div class="bg h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
            <a href="#ahome" class="flex items-center ps-2.5 mb-5">
                <img src="{{ asset('images/hplogo.jpg') }}" class="h-15 w-15 me-3" alt="logo">
            </a>
            <ul class="space-y-2 font-medium">
                <li class="hover-color-custom">
                    <a href="{{ asset('ahome') }}"
                        class="flex items-center p-2 font-color-custom group group-hover-custom">
                        <span class="material-symbols-rounded color-custom group group-hover-custom"
                            aria-hidden="true">today</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Appointment List</span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('uphotos') }}"
                        class="flex items-center p-2 font-color-custom group group-hover-custom">
                        <span class="material-symbols-rounded color-custom group group-hover-custom"
                            aria-hidden="true">publish</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Photos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('calendar') }}"
                        class="flex items-center p-2 font-color-custom group group-hover-custom">
                        <span class="material-symbols-rounded color-custom group group-hover-custom"
                            aria-hidden="true">calendar_month</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('msg') }}"
                        class="flex items-center p-2 font-color-custom group group-hover-custom">
                        <span class="material-symbols-rounded color-custom group group-hover-custom"
                            aria-hidden="true">sms</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Message</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center p-2 font-color-custom group group-hover-custom">

                        <span class="material-symbols-rounded color-custom group group-hover-custom"
                            aria-hidden="true">logout</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </aside>


    <div class="p-4 sm:ml-64">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div class="container">
            <div class="input">
                <form method="post" action="{{ url('save-calendar') }}">
                    @csrf
                    <div class="md-3">
                        <label class="form-label">Available:</label>
                        <select id="available" name="available">
                            <option value="Not Available">Not Available</option>
                            <option value="Holiday">Holiday</option>
                        </select>
                        @error('available')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md-3">
                        <label class="form-label">Note:</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                        @error('note')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="button-18" role="button">Submit</button>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-md-11 offset-1 mt-5 mb-5">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Available:</strong> <span id="modal-available"></span></p>
                    <p><strong>Note:</strong> <span id="modal-note"></span></p>
                    <p><strong>Start Date:</strong> <span id="modal-start"></span></p>
                    <p><strong>End Date:</strong> <span id="modal-end"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                    element.css('background-color',
                    '#826C5F'); // Change the background color of the event to brown
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

                    // Show the modal
                    $('#eventModal').modal('show');
                }
            });
        });
    </script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
