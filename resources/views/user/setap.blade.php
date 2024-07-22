@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <style>
        body {
            background-image: url("https://scontent-mnl1-1.xx.fbcdn.net/v/t39.30808-6/333866174_960299868293739_8480097625234585032_n.jpg?stp=dst-jpg_s960x960&_nc_cat=109&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=PkKShFm9mk8Q7kNvgEjw2Os&_nc_ht=scontent-mnl1-1.xx&oh=00_AYA8K41oaPSJC2mFjZHeU3QAeKAY-5jNrjHEroW5NKsBbw&oe=66A440EE");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'playfair display';
        }
        .box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: left; /* Center text horizontally */
            height: 100vh; /* Full height to center vertically */
        }
        form {
            display: flex;
            flex-direction: column;
            width: 650px; /* Adjust as needed */
            padding: 40px;
            margin-top: 10px;
            background-color: #ecb176;
            color: white;
            border-radius: 18px;
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
        .button-container {
            display: flex;
            justify-content: flex-start; /* Align the button to the left */
        }
        .button-6 {
            align-items: center;
            background-color: #ac6f53;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
            box-sizing: border-box;
            color: rgba(0, 0, 0, 0.85);
            cursor: pointer;
            display: inline-flex;
            font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 1.25;
            margin: 0;
            min-height: 3rem;
            padding: calc(.875rem - 1px) calc(1.5rem - 1px);
            position: relative;
            text-decoration: none;
            transition: all 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            width: 150px; /* Adjust width as needed */
        }
        .button-6:hover,
        .button-6:focus {
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
            color: rgba(0, 0, 0, 0.65);
        }
        .button-6:hover {
            transform: translateY(-1px);
        }
        .button-6:active {
            background-color: #ac6f53;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
            color: rgba(0, 0, 0, 0.65);
            transform: translateY(0);
        }
        .set {
            font-size: 2.5rem; /* Adjust as needed */
            margin: 0;
            font-size: bold;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1 class="set">Set An Appointment</h1>
        <form>
            <label for="name">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Full Name">

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone"placeholder="Phone Number">
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="email">Date</label>
                    <input type="date" id="date" name="date" placeholder="Date">
                </div>
                <div>
                    <label for="email">Time</label>
                    <input type="time" id="time" name="time" placeholder="Time">
                </div>
            </div>

            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" placeholder="Details"></textarea>
            <br>
            <div class="button-container">
                <button class="button-6" role="button">Submit</button>
            </div>
        </form>
    </div>
</body>
@endsection
