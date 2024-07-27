@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set An Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/setap.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .modal-content {
            color: black;
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
            
                <div id="id01" class="w3-modal">
                    <div class="w3-modal-content modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <p>These Terms and Conditions govern the agreement between [Your Photography Business Name] ("Photographer") and the client ("Client") for photography services. By booking a photography session or using our services, the Client agrees to the following terms:

                                Booking and Payment
                                
                                A non-refundable deposit of [amount] is required to secure the booking. The remaining balance is due on the day of the session.
                                Payments can be made via [payment methods].
                                Cancellation and Rescheduling
                                
                                If the Client needs to cancel or reschedule the session, they must provide at least [number] days’ notice. Failure to do so will result in the loss of the deposit.
                                The Photographer reserves the right to reschedule due to unforeseen circumstances such as illness, weather conditions, or equipment failure.
                                Services Provided
                                
                                The Photographer agrees to provide photography services at the agreed time and location.
                                The Photographer will deliver edited photos within [number] weeks after the session.
                                Client Responsibilities
                                
                                The Client is responsible for ensuring that all parties involved in the photography session comply with these Terms and Conditions.
                                The Client must arrive on time for the session. Late arrivals may result in a reduced session time or rescheduling.
                                Image Delivery and Usage
                                
                                The Client will receive high-resolution digital images in [format].
                                The Photographer retains copyright of all images. The Client is granted a personal use license to print and share the images.
                                The Client agrees not to edit or alter the images without the Photographer's permission.
                                Model Release
                                
                                The Client grants the Photographer the right to use images from the session for promotional purposes, including but not limited to the Photographer’s portfolio, website, social media, and marketing materials.
                                If the Client wishes to opt-out of this clause, they must notify the Photographer in writing before the session.
                                Liability
                                
                                The Photographer is not liable for any injury, loss, or damage to the Client or their property during the session.
                                The Photographer’s liability for any claims arising from the services is limited to the amount paid by the Client.
                                Force Majeure
                                
                                The Photographer is not liable for any failure to perform due to circumstances beyond their control, including but not limited to natural disasters, acts of terrorism, or government restrictions.
                                Governing Law
                                
                                These Terms and Conditions are governed by the laws of [Your State/Country]. Any disputes will be resolved in the courts of [Your State/Country].
                                Acceptance of Terms
                                
                                By booking a session with the Photographer, the Client acknowledges that they have read, understood, and agreed to these Terms and Conditions.
                            </p>
                            <input type="checkbox" id="termsCheckbox" onclick="toggleSubmitButton()"> I Agree</input>
                            <button id="modalSubmitButton" onclick="acceptTerms()" disabled>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showModal() {
            document.getElementById('id01').style.display = 'block';
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
