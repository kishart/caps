@extends('layouts.nav')

@section('content')

<head>
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

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #EFE6DD;
        }

        .contain {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
        }

        .calendar-container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #calendar {
            width: 90%;
            height: 90%;
        }

        .fc-view-container {
            height: 100%;
        }

        /* Custom styles for FullCalendar */
        .fc td, .fc th {
            border-color: #ecb176 !important; /* Change grid lines to white */
        }

        .fc-day, .fc-widget-content {
            background-color: #fdead6 !important; /* Change day background color to white */
        }
    </style>
</head>

<div class="contain">
    <div class="calendar-container">
        <h3 class="text-center mt-5 font-bold text-xl">Husnie's Appointment Schedule</h3>
        <div id="calendar"></div>
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
            height: 'parent', // Make calendar take the full height of its parent
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
        });
    });
</script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
@endsection