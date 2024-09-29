@extends('layouts.adminsidebar')

@section('content')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        .appointy {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .search-input {
            width: 350px;
            background-color: #E8B298;
            border: 2px solid #A36361;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .search-input::placeholder {
            color: #A36361;
        }

        .search-input:focus {
            border-color: black;
        }

        .search-btn {
            position: relative;
            right: 55px;
            border: none;
            background: none;
            cursor: pointer;
            outline: none;
        }

        .search-btn i {
            font-size: 20px;
            color: #A36361;
        }

        button.appoint-btn {
            padding: 10px 18px;
            border-radius: 10px;
            background-color: #A36361;
            color: white;
        }

        .appointment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            overflow: hidden;
        }

        .appointment-table th,
        .appointment-table td {
            padding: 12px;
            text-align: left;
        }

        .appointment-table th {
            background-color: #A36361;
            color: white;
        }

        .appointment-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .appointment-table tbody tr:nth-child(odd) {
            background-color: #EECC8C;
        }

        .appointment-table tbody tr:nth-child(even) {
            background-color: #E8B298;
        }

        .appointment-table th:first-child,
        .appointment-table td:first-child {
            border-top-left-radius: 22px;
            /* Top left corner */
            border-bottom-left-radius: 22px;
            /* Bottom left corner */
        }

        .appointment-table th:last-child,
        .appointment-table td:last-child {
            border-top-right-radius: 22px;
            /* Top right corner */
            border-bottom-right-radius: 22px;
            /* Bottom right corner */
        }

        .status,
        .feedback,
        .action {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .status.in-progress {
            background-color: #ccc;
        }

        .status.completed {
            background-color: #4CAF50;
            color: white;
        }

        #actionSelect {
            border-radius: 15px;
            padding-left: 15px;
            padding-right: 45px;
            background-color: rgb(235, 229, 229);
        }

        #actionSelect option {
            border-radius: 15px;
            padding: 10px;
            background-color: #ffffff;
            color: #333;
            text-align: left;
        }

        .custom-select {
            height: 42.5px;
            width: 130px;
            border-radius: 15px;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            text-align: right;
            /* Align text to the right */
            appearance: none;
            /* Remove default select styling */
            background-color: rgb(235, 229, 229);
            /* Default background for select */
        }

        
    .feedback.request {
        background-color: #ccc;
    }

    .feedback.view {
        background-color: #4CAF50;
        color: white;
    }
    </style>

    <div class="appointy">
        <p class="text-left text-3xl text-black font-bold">Appointment List</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search..." class="search-input">
            <button class="search-btn" onclick="filterTable()">
                <i class="material-icons">search</i>
            </button>
        </div>
        <button class="appoint-btn">Set Appointment</button>
    </div>

    <!-- Table outside the loop -->
    <div>
        <table class="appointment-table text-black" id="appointmentTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Feedback</th>
                    <th>More</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->fname }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>
                            <label for="actionSelect" style="border-radius: 30%; " class="sr-only">Action</label>
                            <select id="actionSelect" class="custom-select" onchange="handleSelectChange(this)"
                                style="height: 42.5px; width: 130px; padding: 10px 15px;  font-size: 16px; border: none; text-align: right; background-color: rgb(235, 229, 229);">
                                <option class="option" value="" disabled selected
                                    style="background-color: rgb(235, 229, 229); border-radius: 10%;">
                                    {{ ucfirst($appointment->status) }}</option>
                                <option class="option" value="{{ url('admin/accepted/' . $appointment->id) }}"
                                    style="background-color: green; color: white; border-radius: 10%;">Approved</option>
                                <option class="option" value="{{ url('admin/declined/' . $appointment->id) }}"
                                    style="background-color: red; color: white; border-radius: 10%;">Declined</option>
                            </select>

                        </td>

                        <td>
                            <p><b><a href="default.asp" target="_blank">Send a Message</a></b></p>
                        </td>
                        <td>
                            @if ($appointment->feedback_requested)
                                <!-- View Feedback Button -->
                                <button data-modal-target="feedback-modal-{{ $appointment->id }}" data-modal-toggle="feedback-modal-{{ $appointment->id }}" style="background-color: #4DA167; color:white; width: 100px;border-radius: 15px;  border: none; display: flex; align-items: center; justify-content: center; padding: 10px; " type="button">
                                    <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 18px;">
                                        visibility
                                    </span>
                                    View
                                </button>
                        
                                <!-- Feedback Modal Structure -->
                                <div id="feedback-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Feedback from {{ $appointment->fname }}
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="feedback-modal-{{ $appointment->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                          <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        @if ($appointment->feedback)
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                {{ $appointment->feedback }}
                            </p>
                        @else
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                No feedback provided yet.
                            </p>
                        @endif
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="feedback-modal-{{ $appointment->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Request Feedback Form -->
        <form action="{{ route('request.feedback', $appointment->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" style="width: 100px;border-radius: 15px; color:black; background-color: rgb(235, 229, 229); border: none; display: flex; align-items: center; justify-content: center; padding: 10px;"> 
                <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 8px;">
                    today
                </span>
                Request 
            </button>
        </form>
    @endif
</td>
                        
                        <td><a href="#">More</a></td>
                        
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function filterTable() {
            const searchInput = document.getElementById('searchInput');
            const filter = searchInput.value.toLowerCase().trim();
            const table = document.getElementById('appointmentTable');
            const rows = table.getElementsByTagName('tr');

            // Clear existing row visibility
            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header
                rows[i].style.display = ""; // Reset all rows
            }

            // If the search input is empty, return
            if (!filter) return;

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header
                const cells = rows[i].getElementsByTagName('td');
                const nameCell = cells[0]; // Assuming Name is the first column

                if (nameCell) {
                    const nameValue = nameCell.textContent || nameCell.innerText;
                    // Show row if name matches the search input
                    if (nameValue.toLowerCase().includes(filter)) {
                        rows[i].style.display = ""; // Show row
                    } else {
                        rows[i].style.display = "none"; // Hide row
                    }
                }
            }
        }


        function handleSelectChange(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedValue = selectedOption.value;

            if (selectedValue) {
                // Update the text of the selected option
                selectElement.options[0].text = selectedOption.text;
                selectElement.options[0].disabled = false;

                // Redirect to the selected URL
                window.location.href = selectedValue;
            }
        }

        
//modal sa feedback
document.addEventListener('DOMContentLoaded', function() {
        // Open feedback modal
        document.querySelectorAll('.open-feedback-modal').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var modal = document.getElementById(`feedback-modal-${id}`);

                // Fetch feedback via AJAX
                fetch(`{{ url('/admin/get-feedback/') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.feedback) {
                            document.getElementById(`feedback-content-${id}`).textContent = data.feedback;
                        }
                    });

                // Show the modal
                if (modal) {
                    modal.style.display = 'block';
                }
            });
        });

        // Close feedback modal
        document.querySelectorAll('.close-feedback-modal').forEach(button => {
            button.addEventListener('click', function() {
                var modalId = this.getAttribute('data-modal-id');
                var modal = document.getElementById(modalId);

                if (modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Close modal when clicking outside of modal content
        window.addEventListener('click', function(event) {
            document.querySelectorAll('.w3-modal').forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });
    </script>

    


@endsection