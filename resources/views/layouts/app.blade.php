

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <style>
           * {
            padding: 0;
            margin-left: 20px;
            margin-right: 10px;
            box-sizing: border-box;
        }
body{
    
    background-color: #EFE6DD;
}
        /* Navbar styles */
        nav {
            background-color: #ffffff;
            color: #826c5f; /* Changed color to match the navbar list */
            padding: 20px;
            height: 80px;
            font-family: 'playfair display';
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #826c5f; /* Matched color to the navbar list */
            font-size: 20px;
            transition: color 0.3s ease;
        }

   

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 10px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #826c5f;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #AC6F53;
        }
    </style>
</head>
<body>

<nav>
    <a href="#" style="
    font-size: 22px" >Husnie Photography</a>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Calendar</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a></li>
            
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </ul>
</nav>

</body>
</html>
