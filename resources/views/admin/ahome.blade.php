@extends('layouts.adminsidebar')

@section('content')
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="{{ asset('css/ahome.css') }}">
    @section('title', 'Appointment List')
</head>
    <div class="appointy">
        <p class="text-left text-3xl text-black font-bold">Appointment List</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search..." class="search-input">
            <button class="search-btn" onclick="filterTable()">

                <i class="material-icons">search</i>
            </button>
        </div>
     
        <button class="appoint-btn">
            <a href="{{ asset('setap') }}" style="color: white;">Set Appointment</a></button>
            <button class="appoint-btn" id="toggleArchivedButton" style="color: white;">
                Archived
            </button>
    </div>

<!-- Alert message for no results -->
<div id="noResultAlert" class="no-result-alert" style="display: none;">
    No results found.
</div>

    <!-- Table outside the loop -->
    <div>
        <table class="appointment-table text-black" id="appointmentTable">
            <thead>
                <tr>
                    <th class="select-column" style="display: none;">Select</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Payment</th>
                    <th>More</th>
                </tr>
            </thead>

            <tbody>
         
                @foreach ($appointments as $appointment)
                <tr>
                    <td class="select-column" style="display: none;">
                        <input type="checkbox" class="archive-checkbox" value="{{ $appointment->id }}">
                    </td>
                        <td>
                            <a href="#" class="open-modal"
                                data-id="{{ $appointment->id }}">{{ $appointment->fname }}</a>
                        </td>
                        <div id="modal-{{ $appointment->id }}" class="w3-modal">
                            <div class="w3-modal-content" style="border-radius:20px; padding:20px; width:40%;">
                                <div class="w3-container">
                                    <span class="close-modal w3-button w3-display-topright"
                                        data-modal-id="modal-{{ $appointment->id }}">&times;</span>
                                    <h1 class="text-center font-bold">Appointment Details</h1>
                                    <p style="display: flex; align-items: center;padding-block: 10px;">
                                        <ion-icon name="person-circle"
                                            style="width: 40px; height: 50px; flex-shrink: 0;"></ion-icon>
                                        <input id="modal-fname" type="text" value="{{ $appointment->fname }}" readonly
                                            style="flex-grow: 1; font-size: 20px; margin-left: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; cursor: default; width: 100%;" />
                                    </p>

                                    <p style="display: flex; align-items: center; padding-block: 10px;">
                                        <ion-icon name="mail"
                                            style="width: 40px; height: 50px; flex-shrink: 0;"></ion-icon>
                                        <input id="modal-fname" type="text" value="{{ $appointment->email }}" readonly
                                            style="flex-grow: 1; font-size: 20px; margin-left: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; cursor: default; width: 100%;" />
                                    </p>
                                    <p style="display: flex; align-items: center; padding-block: 10px;">
                                        <ion-icon name="call"
                                            style="width: 40px; height: 50px; flex-shrink: 0;"></ion-icon>
                                        <input id="modal-fname" type="text" value="{{ $appointment->phone }}" readonly
                                            style="flex-grow: 1; font-size: 20px; margin-left: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; cursor: default; width: 100%;" />
                                    </p>
                                    <p style="display: flex; align-items: center; padding-block: 10px;">
                                        <ion-icon name="newspaper"
                                            style="width: 40px; height: 50px; flex-shrink: 0;"></ion-icon>
                                        <textarea id="modal-details" readonly
                                            style="flex-grow: 1; resize:none; font-size: 20px; margin-left: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; cursor: default; width: 100%; height: 150px; resize: none;">{{ $appointment->details }}</textarea>
                                    </p>


                                </div>
                            </div>
                        </div>

                        <!-- Message Modal in ahome.blade.php (Admin Side) -->
                        <div id="msg-modal-{{ $appointment->id }}" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container">
                                    <span class="close-msg-modal w3-button w3-display-topright"
                                        data-modal-id="msg-modal-{{ $appointment->id }}">&times;</span>
                                    <h5>Send Message to {{ $appointment->fname }}</h5>

                                    <!-- Message Form -->
                                    <form action="{{ route('send.message', $appointment->id) }}" method="POST">
                                        @csrf
                                        <textarea style="resize:none;" name="message" rows="4" class="w3-input" placeholder="Type your message here"></textarea>
                                        <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                                            <button type="submit" class="w3-button w3-green">Send</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <td>{{ $appointment->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</td>

                        <td>
                            <label for="actionSelect{{ $appointment->id }}" style="border-radius: 30%;"
                                class="sr-only">Action</label>
                            <!-- Select dropdown -->
                            <select id="actionSelect{{ $appointment->id }}" class="custom-select"
                                onchange="handleSelectChange(this, {{ $appointment->id }})"
                                style="height: 42.5px; width: 130px; padding: 10px 15px; font-size: 16px; border: none; text-align: right; background-color: rgb(235, 229, 229);">
                                <option class="option" value="" disabled selected
                                    style="background-color: rgb(235, 229, 229); border-radius: 10%;">
                                    {{ ucfirst($appointment->status) }}
                                </option>
                                <option class="option" value="approved"
                                    style="background-color: green; color: white; border-radius: 10%;">Approved</option>
                                    <option class="option" value="{{ url('admin/declined/' . $appointment->id) }}"
                                        style="background-color: red; color: white; border-radius: 10%;">Declined</option>
                                <option class="option" value="{{ url('admin/paid/' . $appointment->id) }}"
                                    style="background-color: rgb(255, 174, 0); color: white; border-radius: 10%;">Paid</option>
                            </select>

                            <!-- Modal for Down Payment -->
                            <div id="downPaymentModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true"
                                style="display: none; overflow-y:auto; overflow-x:hidden; position: fixed; top: 0; right: 0; left: 0; z-index: 50; justify-content: center; align-items: center; width: 100%; height: calc(100% - 1rem); max-height: 100%;">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Enter Down
                                                Payment</h2>
                                            <button type="button" onclick="closeModal({{ $appointment->id }})"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form id="downPaymentForm{{ $appointment->id }}"
                                                action="{{ url('admin/accepted/' . $appointment->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-4">

                                                    <div class="flex items-center">
                                                        <!-- Peso Symbol -->
                                                        <span class="text-gray-900 font-bold text-lg mr-2">?</span>

                                                        <!-- Input Field -->
                                                        <input type="number" id="downpayment{{ $appointment->id }}"
                                                            name="downpayment" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                            placeholder="Enter amount"
                                                            value="{{ old('downpayment', $appointment->downpayment ?? '') }}"
                                                            min="0" step="0.01" autofocus>
                                                    </div>

                                                </div>

                                                <button type="submit"
                                                    class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal Background -->
                            <div id="modalBackdrop{{ $appointment->id }}"
                                style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
                            </div>
                        </td>


                        <td>
                            <button style="background-color: #A36361;" data-modal-target="message-modal-{{ $appointment->id }}"
                                data-modal-toggle="message-modal-{{ $appointment->id }}"
                                class="bg-[#4496c8] text-white font-medium rounded-lg px-5 py-2.5 text-center hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                type="button">
                                Message
                            </button>

                            <!-- Main modal -->
                            <div id="message-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Send a Message to {{ $appointment->fname }}
                                            </h3>
                                            <button type="button"
                                                data-modal-target="message-modal-{{ $appointment->id }}"
                                                data-modal-toggle="message-modal-{{ $appointment->id }}"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form class="space-y-4"
                                                action="{{ route('send.message', $appointment->id) }}" method="POST">
                                                @csrf
                                                <div>
                                                    <label for="message"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                                        Message</label>
                                                    <textarea name="message" id="message" rows="4" style="resize:none;"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Type your message here..." required></textarea>
                                                </div>
                                                <button  type="submit"
                                                    class="submit w-full text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
                                                    Message</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>


                        <td>

                            <button data-modal-target="feedback-modal-{{ $appointment->id }}"
                                data-modal-toggle="feedback-modal-{{ $appointment->id }}"
                                style="background-color: #4DA167; color:white; width: 100px;border-radius: 15px;  border: none; display: flex; align-items: center; justify-content: center; padding: 10px; "
                                type="button">
                                <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 18px;">
                                    visibility
                                </span>
                                View
                            </button>

                            <!-- Downpayment Modal Structure -->
                            <div id="feedback-modal-{{ $appointment->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <p>Payment</p>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <h1>Payment</h1>

                                            <p>Proof of Payment:</p>
                                            @if ($appointment->gcash_image)
                                                <img src="{{ asset('storage/' . $appointment->gcash_image) }}"
                                                    alt="Proof of Payment"
                                                    style="max-width: 800px; max-height: 300px; cursor: pointer; transition: transform 0.3s ease;"
                                                    onclick="showZoomed(this)">
                                            @else
                                                <p>No proof of payment uploaded.</p>
                                            @endif

                                            <!-- Zoom Modal -->
                                            <div id="zoom-modal"
                                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 1000; justify-content: center; align-items: center; flex-direction: column;">
                                                <button onclick="closeZoom()"
                                                    style="position: absolute; top: 20px; right: 20px; background: red; color: white; border: none; padding: 10px 15px; font-size: 16px; cursor: pointer; border-radius: 5px;">
                                                    X
                                                </button>
                                                <img id="zoomed-image"
                                                    style="cursor: pointer; max-width: 90%; max-height: 90%; transition: transform 0.3s ease;">
                                            </div>


                                            <!-- Zoom Modal -->
                                            <div id="zoom-modal"
                                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 1000; justify-content: center; align-items: center; flex-direction: column;">
                                                <button onclick="closeZoom()"
                                                    style="position: absolute; top: 20px; right: 20px; background: red; color: white; border: none; padding: 10px 15px; font-size: 16px; cursor: pointer; border-radius: 5px;">
                                                    Exit
                                                </button>
                                                <img id="zoomed-image"
                                                    style="cursor: pointer; max-width: 90%; max-height: 90%; transition: transform 0.3s ease;"
                                                    onclick="toggleZoom(this)">
                                            </div>



                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="feedback-modal-{{ $appointment->id }}"
                                                    type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </td>
                        <td>
                            <div class="dropdown" style="position: relative;">
                                <span
                                    style="background-color: #D9D9D9; display: inline-block; padding: 3px; border: 1px solid rgb(8, 8, 10); border-radius: 10px; cursor: pointer;"
                                    class="material-symbols-outlined" onclick="toggleMenu(this)">
                                    more_horiz
                                </span>
                                <div class="dropdown-menu" style="display: none; position: absolute; z-index: 1;">



                                    <!-- Edit Link with Blue Background -->
                                    <a href="{{ url('admin/editappoint/' . $appointment->id) }}" class="action-edit">
                                        <ion-icon name="create"></ion-icon> Edit
                                    </a>



                                    <!-- Delete Link with Red Background -->
                                    <a href="{{ url('admin/delete-appointment/' . $appointment->id) }}"
                                        class="action-delete">
                                        <ion-icon name="trash"></ion-icon> Delete
                                    </a>
                                </div>
                @endforeach
                <div class="no-results-container"style="margin-top:50px">
                    <p id="noResultsMessage" style="display: none; color: red;">No results found</p>
                </div>
            </tbody>
            
        </table>
       
        

    </div>
    <button class="appoint-btn"  id="moveToArchivedButton" disabled>
        Move it to archived
    </button>
    <div class="pagination-controls">
        <button id="prevPage" onclick="prevPage()" disabled>Previous</button>
        <span id="pageInfo">Page 1</span>
        <button id="nextPage" onclick="nextPage()">Next</button>
    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="{{ asset('js/ahome.js') }}"></script>
    <script>
        const rowsPerPage = 6; 
let currentPage = 1;

function displayTableRows() {
    const table = document.getElementById('appointmentTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    // Hide all rows initially
    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = 'none';
    }

    // Show only rows for the current page
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    for (let i = start; i < end && i < rows.length; i++) {
        rows[i].style.display = '';
    }

    // Update pagination controls
    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = currentPage === totalPages;
    document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`;
}

function nextPage() {
    currentPage++;
    displayTableRows();
}

function prevPage() {
    currentPage--;
    displayTableRows();
}

// Initialize the table display on page load
document.addEventListener('DOMContentLoaded', () => {
    displayTableRows();
});




        function showZoomed(image) {
            const modal = document.getElementById("zoom-modal");
            const zoomedImage = document.getElementById("zoomed-image");

            zoomedImage.src = image.src; // Use the source of the clicked image
            zoomedImage.style.transform = "scale(5)"; // Automatically zoom the image on load

            modal.style.display = "flex"; // Show the modal
        }

        function closeZoom() {
            const modal = document.getElementById("zoom-modal");
            modal.style.display = "none"; // Hide the modal
        }


        function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const table = document.getElementById('appointmentTable');
    const rows = table.getElementsByTagName('tr');
    let found = false;

    // Loop through all table rows (except the header row)
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let rowMatches = false;

        // Check if any cell in the row matches the search query
        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(input)) {
                rowMatches = true;
                break;
            }
        }

        // Show or hide the row based on the search result
        rows[i].style.display = rowMatches ? '' : 'none';
        if (rowMatches) found = true;
    }

    // Show the "No results found" alert if no rows are visible
    const noResultAlert = document.getElementById('noResultAlert');
    noResultAlert.style.display = found ? 'none' : 'block';
}









document.getElementById('toggleArchivedButton').addEventListener('click', function () {
        const selectColumns = document.querySelectorAll('.select-column');
        const moveToArchivedButton = document.getElementById('moveToArchivedButton');

        // Toggle visibility of the select column
        selectColumns.forEach(column => {
            column.style.display = column.style.display === 'none' ? '' : 'none';
        });

        // Toggle visibility of the "Move it to archived" button
        moveToArchivedButton.style.display = moveToArchivedButton.style.display === 'none' ? 'inline-block' : 'none';
    });

    // Enable/Disable "Move it to archived" button
    document.querySelectorAll('.archive-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const checkedBoxes = document.querySelectorAll('.archive-checkbox:checked');
            const moveToArchivedButton = document.getElementById('moveToArchivedButton');

            // Enable the button if at least one checkbox is selected
            moveToArchivedButton.disabled = checkedBoxes.length === 0;
        });
    });

    // Move to Archived Functionality
    document.getElementById('moveToArchivedButton').addEventListener('click', function () {
        const checkedBoxes = document.querySelectorAll('.archive-checkbox:checked');
        const selectedIds = Array.from(checkedBoxes).map(box => box.value);

        if (selectedIds.length > 0) {
            // Send the selected IDs to the server
            fetch('/move-to-archived', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove checked rows from the table
                    checkedBoxes.forEach(box => box.closest('tr').remove());
                } else {
                    alert('Failed to archive items.');
                }
            });
        } else {
            alert('Please select at least one item to archive.');
        }
    });
    </script>
@endsection