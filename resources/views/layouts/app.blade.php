<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 600,
  'GRAD' 0,
  'opsz' 48,
  
}
.material-symbols-outlined{
    font-size:40px;
}.dropdown {
      position: relative;
      display: inline-block;

      
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      margin-left: -70px; /* Adjust as needed */
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .material-symbols-outlined {
      cursor: pointer;
    }
</style>
</head>

<body>
    <nav>
        <a href="#" style="font-size: 22px">Husnie Photography</a>
        <ul>
            <li><a href="{{ asset('home') }}">Home</a></li>
            <li><a href="{{ asset('ucalen') }}">Calendar</a></li>
            <li><a href="{{ asset('photos') }}">Photos</a></li>
            <li><a href="#">Message</a></li>
            

            <div class="dropdown">
                <span class="material-symbols-outlined">account_circle</span>
                <div class="dropdown-content">
                  <a href="{{ asset('profile') }}">Profile</a>
                  <a href="{{ asset('myappoint') }}">My Appointments</a>
                  <a href="#" onclick="logout()">Logout</a>
                </div>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            
        </ul>
    </nav>

    <!-- Content section placeholder -->
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function logout() {
          document.getElementById('logout-form').submit();
        }
      </script>
</body>


</html>
