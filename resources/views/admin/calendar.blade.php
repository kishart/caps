
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css"  rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


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
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

</head>

<style>
    <style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 40

  
}
.bg {
  background-color: #efe6dd;
}
.logo-size {
  height: 50px;
  width: 50px;
}

body {
  color: #ac6f53;
}
/* Define the hover text color class */
.group-hover-custom:hover {
    color: #f7f0e8 !important;
    background-color: #ac6f53;
}
/* Define the font color class */
.font-color-custom {
    color: #ac6f53;
}
.color-custom:hover{
    color: #f7f0e8;

}
</style>
<body>

    
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
    
 </button>
 
 <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="bg h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
       <a href="#ahome" class="flex items-center ps-2.5 mb-5">
        <img src="{{ asset('images/hplogo.png') }}" class="h-15 w-15 me-3" alt="logo">
       </a>
       <ul class="space-y-2 font-medium">
        
          <li class="hover-color-custom" >
             <a href="{{ asset('booklist') }}" class="flex items-center p-2 font-color-custom  group group-hover-custom ">
                <span class="material-symbols-rounded color-custom  group group-hover-custom" aria-hidden="true">
                    today
                </span>
                <span class="flex-1 ms-3 whitespace-nowrap ">Booking List</span>
             </a>
          </li>
         
          <li>
            <a href="{{ asset('uphotos') }}" class="flex items-center p-2 font-color-custom  group group-hover-custom">
                <span class="material-symbols-rounded  color-custom  group group-hover-custom" aria-hidden="true">
                    publish
                </span>
                <span class="flex-1 ms-3 whitespace-nowrap">Upload Photos</span>
            </a>
          </li>
          
          <li>
            <a href="{{ asset('calendar') }}" class="flex items-center p-2 font-color-custom  group group-hover-custom">
                <span class="material-symbols-rounded  color-custom  group group-hover-custom" aria-hidden="true">
                    calendar_month
                </span>
                <span class="flex-1 ms-3 whitespace-nowrap">Calendar</span>
             </a>
          </li>
          
          <li>
            <a href="{{ asset('msg') }}" class="flex items-center p-2 font-color-custom  group group-hover-custom">
                <span class="material-symbols-rounded  color-custom  group group-hover-custom" aria-hidden="true">
                    sms
                </span>
                <span class="flex-1 ms-3 whitespace-nowrap">Message</span>
            </a>
         </li>
         
         <li>
            <a href="{{ asset('msg') }}" class="flex items-center p-2 font-color-custom  group group-hover-custom">
                <span class="material-symbols-rounded  color-custom  group group-hover-custom" aria-hidden="true">
                    logout
                </span>
                <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
            </a>
         </li>
       </ul>
    </div>
 </aside>

 
 <div class="p-4 sm:ml-64">
    <h3 class="text-center mt-5 font-bold text-xl"> Husnie's Appointment Schedule</h3>
    <div class="container">
    <div class="input">
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
                <label class="form-label">End Date:</label>
                <input type="date" class="form-control" name="end_date" 
                    value="{{old('end_date')}}">
                @error('end_date')
                <div class="alert alert-danger" role="alert">
                    {{($message)}}
                </div>
                @enderror
            </div>
            <br>
            <button type="submit"class="button-18" role="button">Submit</button>
        </form>
    </div>
        <div class="row">
            <div class="col-12">
              
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </div>

   
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
                viewRender: function(view, element) {
                    // Get the header element
                    var header = element.find('.fc-toolbar h2');

                    // Replace the header text with weekdays
                    header.text('Weekdays');
                },
                eventRender: function(event, element) {
                    element.css('background-color', '#826C5F'); // Change the background color of the event to red
                }
            });
        });
    </script>
 </div>

  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>