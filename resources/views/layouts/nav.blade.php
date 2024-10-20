
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body>
    
<div class="header">
    <img src="{{ asset('images/hplogo.jpg') }}" alt="logo" class="logo">
    <nav class="navbar">
        <ul>
            <li><a class="home" href="{{ asset('home') }}" style="color:white;">Home</a></li>
            <li><a href="{{ asset('ucalen') }}" style="color:rgb(135, 135, 135);">Calendar</a></li>
            <li><a href="{{ asset('show-photos') }}" style="color:rgb(135, 135, 135);">Photos</a></li>
            <li><a href="{{ asset('contact') }}" style="color:rgb(135, 135, 135);">Contact</a></li>
            <div class="dropdown">
                <ion-icon name="person-circle-outline" class="icon"></ion-icon>
                <div class="dropdown-content">
                    <a href="{{ asset('profile') }}">Profile</a>
                    <a href="{{ asset('myappoint') }}">My Appointments</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        </ul>
    </nav>
</div>

<div class=" mx-auto py-12 mb-10">
    @yield('content')
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>