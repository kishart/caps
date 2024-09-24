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
            <input type="text" id="fname" name="fname" placeholder="Full Name" value="{{ auth()->user()->name }}" readonly>
            
        

            <div class="row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" readonly>
            
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ auth()->user()->phone }}" readonly>
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
                    1. All transactions with Husnie Photography require full payment in advance before any goods or services are rendered.
                    <br> <br>2. A non-refundable down payment of 50% is required for all transactions. This down payment must be made upon booking or before the commencement of services.
                    <br> <br>3. Full payment, inclusive of the downpayment and any applicable transportation costs, can be received before or after the scheduled commencement of services.
                    <br> <br>4. Failure to adhere to the payment terms may result in the cancellation or delay of the transaction.

                    <br>  <br>5. Clients are responsible for covering or reimbursing Husnie Photography for any transportation costs associated with the delivery or provision of goods/services outside Ozamiz City. The transportation cost details will be communicated and agreed upon before finalizing the transaction.
                    <br>     <br>6. Husnie Photography operates on a <strong>"First Booking, First Serve"</strong>  basis. This means that service availability or product allocation is prioritized based on the order in which bookings are confirmed and payments are received.

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
            if (validateForm()) {
                document.getElementById('demo-modal').classList.add('show');
            }
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

        function validateForm() {
            var fname = document.getElementById('fname').value.trim();
            var email = document.getElementById('email').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var date = document.getElementById('date').value.trim();
            var time = document.getElementById('time').value.trim();
            var details = document.getElementById('details').value.trim();

            if (!fname || !email || !phone || !date || !time || !details) {
                alert('Please fill in all required fields.');
                return false;
            }

           
            return true;
        }
    </script>
</body>
@endsection