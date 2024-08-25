<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Husnie Photography</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    


</head>

<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 40
    }
</style>

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
                <a href="{{ asset('home') }}"
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

    <!-- Content section placeholder -->
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>