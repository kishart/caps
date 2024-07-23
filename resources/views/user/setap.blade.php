@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/setap.css') }}">
</head>
<body>
    <div class="containera">
        <div class="left-column">
            <h1 class="set">Set An <br>Appointment</h1>
        </div>

        <div class="right-column">
            <label for="name">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Full Name">

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date">
                </div>
                <div>
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time">
                </div>
            </div>

            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" placeholder="Details"></textarea>
            <br>
            <div class="button-container">
                <button class="button-6" role="button">Submit</button>
            </div>
        </div>
    </div>
</body>
@endsection
