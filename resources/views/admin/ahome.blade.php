@extends('layouts.adminsidebar')

@section('content')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                        <td>{{ $appointment->feedback }}</td>
                        <td><a href="#">More</a></td>
                    </tr>
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
    </script>
@endsection
