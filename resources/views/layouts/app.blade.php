<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav>
        <a href="#" style="font-size: 22px">Husnie Photography</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="#">Photos</a></li>
            <li><a href="#">Contact</a></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
