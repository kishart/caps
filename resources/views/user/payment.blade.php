@extends('layouts.nav')
@section('title', 'Payment')
@section('content')
<head>
    <title>Payment</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>

<body>
    @if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
@endif


    <div class="pdetail">
        <p>Good day! Client, your downpayment is <strong>₱{{ number_format($appointment->downpayment ?? 0, 2) }}</strong>.</p>
        <p>Please choose your preferred payment method.</p>
    </div>
   
    <div class="containera">
        <div class="column gcash" onclick="openModal('gcash')">
            <img src="{{ asset('images/glogo.png') }}" alt="logo">
            GCash
        </div>
        <div class="column payment-in-person" onclick="openModal('payment-in-person')">
            <img src="{{ asset('images/pInperson.png') }}" alt="logo">
            Payment in Person
        </div>
    </div>
  
    <!-- Modal -->
   <!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <div id="gcash-content" class="hidden">
            <form action="{{ route('payment.store', $appointment->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateImage()">
                @csrf
                <input type="hidden" name="payment_method" value="gcash">
                <h1>GCash</h1>
                <p>Make your payment using GCash. Please scan the QR code below or enter the account number.</p>
                <img src="{{ asset('images/qrsample.png') }}" alt="GCash QR Code" style="width:200px; height:auto;">
                
                <input 
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                    id="gcash_image" 
                    name="gcash_image" 
                    type="file" 
                    accept=".jpg,.jpeg,.png,.gif,.svg">
                <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG, or GIF (MAX. 800x400px).</p>
                
                <button type="submit" class="close-btn">Submit</button>
                <button type="button" class="close-danger" onclick="closeModal()">Close</button>
            </form>
            
        </div>
        <div id="payment-in-person-content" class="hidden">
            <h1>Payment in Person</h1>
            <form action="{{ route('payment.store', $appointment->id) }}" method="POST">
                @csrf
                <input type="hidden" name="payment_method" value="in_person">
                <p>Feel free to contact us through the following methods:</p>
                <div class="apps">
                    <a href="https://www.messenger.com/t/1892858274289569" target="_blank">
                        <ion-icon class="icon" name="logo-facebook"></ion-icon>
                    </a>
                    <a href="tel:+1234567890"><ion-icon class="icon" name="call"></ion-icon></a>
                    <a href="mailto:itshusnie@gmail.com"><ion-icon class="icon" name="mail"></ion-icon></a>
                </div>
            </form>
            <button class="close-danger" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>


    <script>
       function openModal(type) {
    const modal = document.getElementById('modal');
    const gcashContent = document.getElementById('gcash-content');
    const paymentContent = document.getElementById('payment-in-person-content');

    // Hide both sections initially
    gcashContent.classList.add('hidden');
    paymentContent.classList.add('hidden');

    // Display the relevant content
    if (type === 'gcash') {
        gcashContent.classList.remove('hidden');
    } else if (type === 'payment-in-person') {
        paymentContent.classList.remove('hidden');
    }

    // Show modal
    modal.style.display = 'flex';
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

function validateImage() {
        const fileInput = document.getElementById('gcash_image');
        const filePath = fileInput.value;
        const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.svg)$/i;

        if (!filePath) {
            alert("Please select an image file.");
            return false;
        }

        if (!allowedExtensions.exec(filePath)) {
            alert("Invalid file type. Please upload an image (JPG, PNG, GIF, SVG).");
            fileInput.value = '';
            return false;
        }

        return true;
    }
    </script>

 
</body>
@endsection
