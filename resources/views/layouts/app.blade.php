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
    
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    

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
    
    <div class="hidden md:flex items-center space-x-8 rtl:space-x-reverse ml-auto">
        <ul class="flex space-x-8 rtl:space-x-reverse font-medium">
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
    </div>

    <button id="hamburger" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>

    <div class="hidden w-full md:hidden" id="navbar-sticky">
        <ul class="flex flex-col items-center p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800">
            <li>
                <a href="{{ asset('home') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Home</a>
            </li>
            <li>
                <a href="{{ asset('ucalen') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Calendar</a>
            </li>
            <li>
                <a href="{{ asset('photos') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Photos</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Message</a>
            </li>
        </ul>
    </div>
</nav>



    <!-- Content section placeholder -->
    @yield('content')
    

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function logout() {
          document.getElementById('logout-form').submit();
        }

        
    document.getElementById('hamburger').addEventListener('click', function() {
        const navbar = document.getElementById('navbar-sticky');
        navbar.classList.toggle('hidden');
    });

    function logout() {
        document.getElementById('logout-form').submit();
    }
</script>

   
</body>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</html>
