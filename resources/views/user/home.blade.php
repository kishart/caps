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
    <title>Home Page</title>
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
                <a href="{{ asset('ucalen') }}" style="color: black;">Set Appointment</a>
            </button>
            <button class="blur-button">
                <ion-icon name="image"></ion-icon>
                <a href="{{ asset('show-photos') }}" style="color: white;">Check Photos</a>
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
            <a href="https://www.instagram.com/husnie_photography?igsh=NzF0eXQxZG1uOG0=" target="_blank">
                <ion-icon name="logo-instagram"></ion-icon>
            </a>
           
            <a href="mailto:itshusnie@gmail.com">
                <ion-icon name="mail"></ion-icon>
            </a>
        </div>
<div class="steps">
        <h1 style="font-size: 30px;text-align:center;">Steps to set an Appointment</h1>
            
        <div class="step-container">
           <div class="left">
                <img src="{{ asset('images/step1.png') }}" alt="Step 1">
            </div>
            <div class="right">
                <p>Click on the "Set Appointment" button</p>
            </div>
        </div>
        <div class="step-container">
            <div class="left">
                 <img src="{{ asset('images/step2.png') }}" alt="Step 1">
             </div>
             <div class="right">
                 <p>View all the appointment details of the photographer to aware of all his schedule and know if your preference date to appointment is available or not.</p>
             </div>
         </div>
         <div class="step-container">
            <div class="left">
                 <img src="{{ asset('images/step3.png') }}" alt="Step 1">
             </div>
             <div class="right">
                 <p>Double check if you information is correct such as name, email, and phone number. Then fill up for your chosen date and time. Also include the details for the event that you are having</p>
             </div>
         </div>
         <div class="step-container">
            <div class="left">
                 <img src="{{ asset('images/step5.png') }}" alt="Step 1">
             </div>
             <div class="right">
                 <p>After submit your appointment, go to "My Appointment" for your appointment details.</p>
             </div>
         </div>
         <div class="step-container">
            <div class="left">
                 <img src="{{ asset('images/step6.png') }}" alt="Step 1">
             </div>
             <div class="right">
                 <p>In the appointment details this will show if your appointment is accepted or decline. </p>
             </div>
         </div>
    </div>     

</div>

@include('layouts.footer')

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

@endsection
