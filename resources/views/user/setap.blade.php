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

        <form class="right-column" method="post" action="{{url('save-appoint')}}">
            @csrf

            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Full Name" value="{{old('fname')}}">
            @error('fname')
            <div class="alert alert-danger" role="alert">
                {{($message)}}
            </div>
            @enderror

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{($message)}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                    @error('phone')
                    <div class="alert alert-danger" role="alert">
                        {{($message)}}
                    </div>
                    @enderror 
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{old('date')}}">
                    @error('date')
                    <div class="alert alert-danger" role="alert">
                        {{($message)}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time" value="{{old('time')}}">
                    @error('time')
                    <div class="alert alert-danger" role="alert">
                        {{($message)}}
                    </div>
                    @enderror
                </div>
            </div>

            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" placeholder="Details">{{old('details')}}</textarea>
            @error('details')
            <div class="alert alert-danger" role="alert">
                {{($message)}}
            </div>
            @enderror
            <br>
            <div class="button-container">
                <button type="submit" class="button-6" role="button">Submit</button>
            </div>
        </form>
    </div>
</body>
@endsection
