<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Husnie Photography</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
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
    <nav>

        <ul>
            <li>
               <a href="#"><span class="material-symbols-outlined">contract</span>Booking List</a>
            </li>

            <li>
               <a href="{{ asset('appointlist') }}"><span class="material-symbols-outlined">today</span>Calendar</a>
            </li>
            <li><a href="#"><span class="material-symbols-outlined">
               photo_library
               </span>Upload Photos</a>
            </li>
            <li><a href="#"><span class="material-symbols-outlined">
               mail
               </span>Message</a></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="material-symbols-outlined">
                     logout
                     </span>
                    {{ __('Logout') }}
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </ul>
    </nav>

    <!-- Content section placeholder -->
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>