<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

   
</head>

<body>
    <nav>
        <img src="{{ asset('images/hplogo.jpg') }}" alt="logo" class="logo"
            style="width:75px; height:70px; margin-left:-50px;">
        <a href="#" class="brand-link font-bold" style="margin-top:5px;">Husnie Photography</a>
        <div class="hidden md:flex items-center space-x-8 rtl:space-x-reverse ml-auto"
            style="background-color: #A36361">
            <ul style="background-color:#A36361;" class="flex space-x-8 rtl:space-x-reverse font-medium">
                <li><a class="home" href="{{ asset('home') }}" style="   color:white;">Home</a></li>
                <li><a href="{{ asset('ucalen') }}" style="   color:white;">Calendar</a></li>
                <li><a href="{{ asset('show-photos') }}" style="   color:white;">Photos</a></li>
                <li><a href="{{ asset('contact') }}" style="   color:white;">Contact</a></li>
                <div class="dropdown">
                    <ion-icon name="person-circle-outline" class="icon"></ion-icon>
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

        <button id="hamburger" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:hidden" style="margin-top:60%;" id="navbar-sticky">
            <ul
                class="flex flex-col items-center border border-gray-100 rounded-lg md:flex-row md:border-0 md:bg-white ">
                <li style="margin-right:10%;"><a href="{{ asset('home') }}"
                        class="w-full block  text-black rounded md:bg-transparent" aria-current="page">Home</a></li>
                <li><a href="{{ asset('ucalen') }}" class="w-full block py-2 text-black rounded md:bg-transparent"
                        aria-current="page">Calendar</a></li>
                <li><a href="{{ asset('photos') }}" class="w-full block py-2 text-black rounded md:bg-transparent"
                        aria-current="page">Photos</a></li>
                <li><a href="#" class=" w-full block py-2 text-black rounded md:bg-transparent"
                        aria-current="page">Message</a></li>
            </ul>
        </div>

    </nav>

    <div class=" mx-auto py-12 mb-10">
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
