<!-- layout.nav -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    @stack('styles') <!-- Allow additional styles to be added from child views -->
    <title>@yield('title', 'Husnie Photography')</title>
 
</head>
<body>
    <div class="header  {{ Request::is('ucalen') || Request::is('show-photos') || Request::is('contact') || Request::is('setap') || Request::is('profile') || Request::is('myappoint')  ? 'bg-brown' : '' }} ">
        <img src="{{ asset('images/hplogo.jpg') }}" alt="logo" class="logo">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active-link' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('ucalen') }}" class="{{ Request::is('ucalen') ? 'active-link' : '' }}">Calendar</a>
                </li>
                <li>
                    <a href="{{ url('show-photos') }}" class="{{ Request::is('show-photos') ? 'active-link' : '' }}">Photos</a>
                </li>
                <li>
                    <a href="{{ url('contact') }}" class="{{ Request::is('contact') ? 'active-link' : '' }}">Contact</a>
                </li>
                <div class="dropdown">
                    <ion-icon name="person-circle-outline" class="icon" style="color: #EECC8C;"></ion-icon>
                    <div class="dropdown-content">
                        <a href="{{ url('profile') }}">Profile</a>
                        <a href="{{ url('myappoint') }}">My Appointments</a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </div>
            </ul>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <main class="container mx-auto py-12" style="margin-bottom: 50p">
        @yield('content')
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('scripts') <!-- Allow additional scripts to be added from child views -->
</body>
</html>
