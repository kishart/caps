@extends('layouts.nav')
@section('title', 'Home')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
  

        <div class="text">
            <h1>HUSNIE</h1>
            <p class="phot"> PHOTOGRAPHY</p>
            <p class="quote">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, eveniet dolorem <br>
                omnis repellat quisquam voluptatum delectus aperiam corporis ipsam! Odit hic <br>
                tenetur nam delectus fugiat eligendi </p>
        </div>
        <div class="button">
            <button class="set">
                <ion-icon name="arrow-forward-circle"></ion-icon>
                <a href="{{ asset('setap') }}" style="color: black;">Set Appointment</a>
            </button>
            <button class="blur-button">
                <ion-icon name="calendar-clear-outline"></ion-icon>
                <a href="{{ asset('ucalen') }}" style="color: white;">Check Calendar</a>
            </button>
        </div>


        <div class="infophotog">
            <p> <span>The Photographer</span> <br><br>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, eveniet dolorem <br>
                omnis repellat quisquam voluptatum delectus aperiam corporis ipsam! Odit hic <br>
                tenetur nam delectus fugiat eligendi</p>

        </div>
        <img src="{{ asset('images/husnie.png') }}" alt="husnie" class="husnie">


        <div class="apps">
            <a href="https://www.facebook.com/HusniePhotography" target="_blank">
                <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <ion-icon name="logo-instagram"><a href=""></a></ion-icon>
            <a href="mailto:itshusnie@gmail.com">
                <ion-icon name="mail"></ion-icon>
            </a>
        </div>


    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

@endsection
