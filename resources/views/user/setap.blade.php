@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/setap.css') }}">
    <style>
        .modal-content {
            color: black;
        }
        .taa{
            margin: 5px;
        }

        .wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: -webkit-linear-gradient(to right, #834d9b, #d04ed6);
            background: linear-gradient(to right, #834d9b, #d04ed6);
        }

        .wrapper a {
            display: inline-block;
            text-decoration: none;
            padding: 15px;
            background-color: #fff;
            border-radius: 3px;
            text-transform: uppercase;
            color: #585858;
            font-family: 'Roboto', sans-serif;
        }

        .modal {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(77, 77, 77, .7);
            transition: all .4s;
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        .modal__content {
            border-radius: 4px;
            position: relative;
            width: 500px;
            max-width: 90%;
            background: #fff;
            padding: 1em 2em;
        }

        .modal__footer {
            text-align: right;
        }

        .modal__close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #585858;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="containera">
        <div class="left-column">
            <h1 class="set">Set An <br>Appointment</h1>
        </div>

        <form class="right-column" id="appointmentForm" method="post" action="{{url('save-appoint')}}">
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
                <button type="button" class="button-6" role="button" onclick="showModal()">Submit</button>
            </div>
        </form>

        <div id="demo-modal" class="modal">
            <div class="modal__content">
                <h1>Terms and Conditions</h1>
                <p>These Terms and Conditions govern the agreement between [Your Photography Business Name] ("Photographer") and the client ("Client") for photography services. By booking a photography session or using our services, the Client agrees to the following terms:
                    <!-- Terms content here -->
                </p>
                <input type="checkbox" id="termsCheckbox" onclick="toggleSubmitButton()"> I Agree</input>
                <button id="modalSubmitButton" onclick="acceptTerms()" disabled>Submit</button>
                <span class="modal__close" onclick="closeModal()">&times;</span>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            document.getElementById('demo-modal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('demo-modal').classList.remove('show');
        }

        function toggleSubmitButton() {
            var checkbox = document.getElementById('termsCheckbox');
            var submitButton = document.getElementById('modalSubmitButton');
            submitButton.disabled = !checkbox.checked;
        }

        function acceptTerms() {
            var checkbox = document.getElementById('termsCheckbox');
            if (checkbox.checked) {
                document.getElementById('appointmentForm').submit();
            }
        }
    </script>
</body>
@endsection
