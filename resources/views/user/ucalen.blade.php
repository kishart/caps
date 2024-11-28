@extends('layouts.nav')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

</head>

<div class="contain">
    <div class="calendar-container">
       <div id="calendar"></div>
    </div>
    <div class="details-container">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
       
        <p style="margin-top: 30px; font-weight:bold;">Schedule Details</p>
        <div class="schedule-details">
            <p><strong>Start Time:</strong> <span id="start-time">N/A</span></p>
            <p><strong>End Time:</strong> <span id="end-time">N/A</span></p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var calendar = @json($events);

        calendar.forEach(function(event) {
            event.startTime = moment(event.start).format('hh:mm A'); // Format the start time (12-hour format with AM/PM)
            event.endTime = moment(event.end).format('hh:mm A'); // Format the end time (12-hour format with AM/PM)
        });

        $('#calendar').fullCalendar({
            height: 'parent',
            events: calendar,

            customButtons: {
                myCustomToday: {
                    text: 'Set Appointment',
                    click: function() {
                        window.location.href = '{{ route('setap') }}';
                    }
                }
            },

            header: {
                left: 'title',
                right: 'prev,next, myCustomToday'
            },

            viewRender: function(view, element) {
                var header = element.find('.fc-toolbar h2');
                header.text('Weekdays');
            },

            eventRender: function(event, element) {
                element.css('background-color', '#826C5F');
                if (event.available) {
                    element.find('.fc-title').append(event.available);
                }

                // Event click to show details on the right side
                element.on('click', function() {
                    $('#start-time').text(event.start_time);
                    $('#end-time').text(event.end_time);
                });
            },
        });
    });
</script>

<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

@endsection
