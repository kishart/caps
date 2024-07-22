@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form</title>
    <style>
        body{
            
            background-image: url("paper.gif");
           
        }
        .box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top:30px;
         
        }
        form {
            display: flex;
            flex-direction: column;
            width: 650px; /* Adjust as needed */
            padding: 40px;
            
            margin-top:10px;
            background-color: black;
            color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .row > div {
            flex: 1;
            margin-right: 10px;
        }
        .row > div:last-child {
            margin-right: 0;
        }
        input[type=text], input[type=email], input[type=date], input[type=time] {
            width: 100%;
            color: black;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="box">
        <form>
            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname">

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone">
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
            <input type="text" id="details" name="details">
        </form>
    </div>
</body>
@endsection
