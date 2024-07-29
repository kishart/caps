@extends('layouts.app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/setap.css') }}">

</head>

<body @if(session('success')) class="success-background" @endif>
    @if(session('success'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>{{ session('success') }}</strong> 
    </div>
    @endif

    <div class="containera">
        <div class="left-column">
            <h1 class="set">Set An <br>Appointment</h1>
        </div>

        <form class="right-column" id="appointmentForm" method="post" action="{{ url('save-appoint') }}">
            @csrf

            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Full Name" value="{{ old('fname') }}">
            @error('fname')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}">
                    @error('date')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="time">Time</label>
                    <input type="time" id="time" name="time" value="{{ old('time') }}">
                    @error('time')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" placeholder="Details">{{ old('details') }}</textarea>
            @error('details')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <br>

            <div class="button-container">
                <button type="button" class="button-6" role="button" onclick="showModal()">Submit</button>
            </div>
        </form>

        <div id="demo-modal" class="modal">
            <div class="modal__content">
                <h1>Husnie Photography Services Terms and Conditions</h1>
                <p style="padding:20px; color:#826c5f;">
                    <b>1. Booking Deposit and Payment:</b> The client shall make a booking fee as per contract to retain the
                    studio to perform the services specified in the contract.
                    <br><b>2. Cancellation:</b> If the client cancels this agreement more than six (6) calendar days before the photo
                    shooting day, any booking fee paid to the photographer shall be refunded in full if the photographer
                    is able to rebook the same date. If the photographer is not able to secure another client for the
                    date, or if the cancellation occurs less than six (6) calendar days before the portrait date, the
                    client forfeits the booking fee.
                    <br><b>3. Photographic Materials and Copyright:</b> All photographic materials, such as original negatives,
                    photos, or slides, shall be the exclusive property of the photographer. The photographer shall own
                    the copyright to all images created and may use the work for samples, contests, exhibitions,
                    advertising, and self-promotion. Usage outside the bounds of this agreement will require the
                    client’s consent.
                    <br><b>4. Client’s Usage:</b> The client is obtaining prints for personal use only and shall not sell said prints
                    or authorize any reproductions thereof by parties other than the photographer.
                    <br><b>5. Social Media:</b> This clause applies to all social media, including Facebook and blogs. When published
                    online, it is required that a citation of the photographer be made. The client agrees that they will
                    under no circumstances alter any photographs that are placed in public on the internet. The client
                    agrees to be responsible for any family member or friend who posts our photographs online and agrees
                    that they cannot be cropped (with the exception of the forced cropping for Facebook’s timeline),
                    altered in color, or edited in any way.
                </p>
                <div class="inpuch">
                    <input type="checkbox" id="termsCheckbox" onclick="toggleSubmitButton()"> I Agree</input>
                </div>

                <div class="button-containera">
                    <button id="modalSubmitButton" onclick="acceptTerms()" class="buttona" disabled>Submit</button>
                </div>

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