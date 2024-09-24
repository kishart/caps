<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            font-variation-settings: 'FILL' 0, 'wght' 600, 'GRAD' 0, 'opsz' 48;
            font-size: 40px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            margin-left: -70px; /* Adjust as needed */
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .material-symbols-outlined {
            cursor: pointer;
        }

        /* Ensure navbar stays on top */
        nav {
            position: fixed; /* Fixed position */
            top: 0; /* Stay at the top */
            left: 0; /* Align with the left */
            right: 0; /* Align with the right */
            z-index: 1000; /* High z-index to stay on top */
            background-color: white; /* Background color */
        }

        body {
            padding-top: 80px; /* Adjust based on navbar height */
        }
        #hamburger {
            position: absolute;
            top: 20px; /* Adjust vertical position */
            right: 10%; /* Adjust horizontal position */
            margin-left: auto; /* Align to the right */
        }
        .brand-link {
            position: absolute; 
            top: 20px; 
            left: 10%; 
            font-size: 22px;
        }
      .home{
          margin-left: 58%;
        }
    </style>
</head>

<body>
    <nav>
      <a href="#" class="brand-link">Husnie Photography</a>
        <div class="hidden md:flex items-center space-x-8 rtl:space-x-reverse ml-auto">
            <ul class="flex space-x-8 rtl:space-x-reverse font-medium">
                <li><a class="home" href="{{ asset('home') }}">Home</a></li>
                <li><a href="{{ asset('ucalen') }}">Calendar</a></li>
                <li><a href="{{ asset('photos') }}">Photos</a></li>
                <li><a href="{{ asset('contact') }}">Contact</a></li>
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

        <div class="hidden w-full md:hidden" style="margin-top:60%;" id="navbar-sticky">
          <ul class="flex flex-col items-center border border-gray-100 rounded-lg md:flex-row md:border-0 md:bg-white ">
              <li style="margin-right:10%;"><a href="{{ asset('home') }}" class="w-full block  text-black rounded md:bg-transparent" aria-current="page">Home</a></li>
              <li ><a href="{{ asset('ucalen') }}" class="w-full block py-2 text-black rounded md:bg-transparent" aria-current="page">Calendar</a></li>
              <li ><a href="{{ asset('photos') }}" class="w-full block py-2 text-black rounded md:bg-transparent" aria-current="page">Photos</a></li>
              <li ><a href="#" class=" w-full block py-2 text-black rounded md:bg-transparent" aria-current="page">Message</a></li>
          </ul>
      </div>
      
    </nav>

    <div class="container mx-auto py-12">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            const navbar = document.getElementById('navbar-sticky');
            navbar.classList.toggle('hidden');
        });

        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
