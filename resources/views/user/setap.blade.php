@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <style>
        body {
            background-color: #f7f0e8;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'playfair display';
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
            justify-content: flex-start;
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
            width: 150px;
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
            font-size: 2.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 20%;
            text-align: center;
            margin: 0;
            color: #ac6f53;
        }

        .containera {
            display: flex;
            justify-content: space-between;
            width: 70%;
            margin: auto;
            margin-top: 60px;
            margin-bottom: 50px;
            border: 1px solid;
            box-shadow: 15px 20px #826c5f;
        }

        .left-column {
            width: 50%;
            background-image: url('https://scontent-mnl1-1.xx.fbcdn.net/v/t39.30808-6/449309776_934028685402570_4304378336231725441_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=f727a1&_nc_ohc=Rc5o-1ODafoQ7kNvgF3vCGW&_nc_ht=scontent-mnl1-1.xx&oh=00_AYBSvqi3APCX7D5EbhoItEXZF--9XGTD96_8iSPCRq1M8A&oe=66A4D922'); /* Replace with your image URL */
            background-size: cover;
            opacity: 0.9;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .right-column {
            width: 50%;
            background-color: #ecb176;
            color: white;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }
    </style>
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
