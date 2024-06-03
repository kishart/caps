<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5"> calendar</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </div>




      <form method="post" action="{{url('save-booking')}}">
                    @csrf
                    <div class="md-3">
                        <label class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" 
                        value="{{old('title')}}">
                        @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                        
                    </div>

                    <div class="md-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" 
                        value="{{old('start_date')}}">
                        @error('start_date')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                        
                    </div>

                    <div class="md-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" class="form-control" name="end_date" 
                        value="{{old('end_date')}}">
                        @error('end_date')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                        
                    </div>
                    <br>
                    <button type="submit"class="button-28" role="button">Submit</button>
                </form>










    <script>
 $(document).ready(function() {
    var booking = @json($events);

    // Convert event dates to include only the date portion
    booking.forEach(function(event) {
        event.start = event.start.substr(0, 10); // Assuming start date is in YYYY-MM-DD format
        event.end = event.end.substr(0, 10); // Assuming end date is in YYYY-MM-DD format
    });

    $('#calendar').fullCalendar({
        events: booking,
        eventRender: function(event, element) {
            element.css('background-color', 'red'); // Change the background color of the event to red
            
        }
    });
});




    </script>

    
</body>

</html>
