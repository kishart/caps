<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>

<body>
    <div class="pdetail">
        <div class="payment-info">
            <p>Good day! Client, your downpayment is <strong>₱{{ number_format($appointment->downpayment ?? 0, 2) }}</strong>.</p>
            <p>Please choose your preferred payment method.</p>
        </div>
    </div>
    
    <div class="pmethod">
        <!-- Gcash -->
        <a href="#" id="gcash-btn" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="{{ asset('images/glogo.png') }}" alt="gcash logo" class="glogo">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Gcash</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">You can easily pay with us through Gcash</p>
        </a>

        <!-- Payment in Person -->
        <a href="#" id="in-person-btn" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="https://static.thenounproject.com/png/1530791-200.png" alt="pperson" class="pperson">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Payment in Person</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">If you prefer payment in person, you can ask for further details</p>
        </a>
    </div>

    <!-- Gcash Modal -->
    <div id="gcash-modal" class="hidden">
        <form action="{{ route('payment.store', $appointment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="payment_method" value="gcash">
            <div class="qr-container">
                <img src="{{ asset('images/qrsample.png') }}" class="qrsample" alt="qrsample">
            </div>
            <p class="text-center">Please Upload screenshot for proof of payment of your downpayment</p>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="gcash_image" name="gcash_image" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </form>
    </div>

    <!-- Payment in Person Modal -->
    <div id="in-person-modal" class="hidden">
        <form action="{{ route('payment.store', $appointment->id) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="in_person">
           
            <div class="details">
                <p>Details:</p>
                <input type="text" name="payment_details" placeholder="Enter details" required>
                
            
                
            </div>
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        // JavaScript to toggle the visibility of the modals
        document.getElementById("gcash-btn").addEventListener("click", function() {
            document.getElementById("gcash-modal").classList.remove("hidden");
            document.getElementById("in-person-modal").classList.add("hidden");
        });

        document.getElementById("in-person-btn").addEventListener("click", function() {
            document.getElementById("in-person-modal").classList.remove("hidden");
            document.getElementById("gcash-modal").classList.add("hidden");
        });
    </script>

</body>

</html>
