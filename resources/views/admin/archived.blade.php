@extends('layouts.adminsidebar')

@section('content')


<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        @section('title', 'Archived')
    </head>

<style>

 

.archived-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    overflow: hidden;
    
}

.archived-table th,
.archived-table td {
    padding: 12px;
    text-align: left;
}

.archived-table th {
    background-color: #A36361;
    color: white;
}

.archived-table tbody tr:hover {
    background-color: #f1f1f1;
}

.archived-table tbody tr:nth-child(odd) {
    background-color: #d4cbc6;
}

.archived-table tbody tr:nth-child(even) {
    background-color: #e4bfad;
}

.archived-table th:first-child,
.archived-table td:first-child {
    border-top-left-radius:15px;
    /* Top left corner */
    border-bottom-left-radius: 15px;
    /* Bottom left corner */
}

.archived-table th:last-child,
.archived-table td:last-child {
    border-top-right-radius: 22px;
    /* Top right corner */
    border-bottom-right-radius: 22px;
    /* Bottom right corner */
}

    #zoom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #zoomed-image {
        cursor: pointer;
        max-width: 100%;
        max-height: 90%;
        transition: transform 0.3s ease;
    }

    #zoom-modal button {
        position: absolute;
        top: 20px;
        right: 20px;
        background: red;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .appointy {
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* margin-bottom: 50px; */
    background-color: white;
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
.submit{
    background-color: #E8B298;
}
.submit:hover{
    background-color: #A36361;
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


.pagination-controls {
    margin-top: 10px;
    display: flex;
    justify-content: flex-end;
    position: fixed;
    right: 20px;
    bottom: 20px;
    padding: 15px;
}


.pagination-controls button {
    margin: 0 5px;
    padding: 10px 15px;
    background-color: #A36361;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


.pagination-controls button:disabled {
    background-color: #E8B298;
    color:black;
    cursor: not-allowed;
}

.pagination-controls span {
    font-weight: bold;
    font-size: 16px;
    text-align: center;
    margin-top: 10px;
}

.no-result-alert {
    text-align: center;
    margin-top: 10px;
    padding: 10px;
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    font-size: 16px;
}



</style>

<div class="appointy">
    <p class="text-left text-3xl text-black font-bold">Archived List</p>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." class="search-input">
        <button class="search-btn" onclick="filterTable()">

            <i class="material-icons">search</i>
        </button>
    </div>
 
  
</div>

<!-- Alert message for no results -->
<div id="noResultAlert" class="no-result-alert" style="display: none;">
No results found.
</div>

<table class="archived-table" id="archivedTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Message</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($archivedAppointments as $appointment)
        <tr>
            <td>{{ $appointment->fname }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            <td>{{ $appointment->status }}</td>
            <td>  
                @if($appointment->message)
                    <p>{{ $appointment->message->message }}</p>
                @else
                    <p>No messages available</p>
                @endif
            </td>
            <td>

                            <p><b>Proof of Payment:</b></p>
                            @if ($appointment->gcash_image)
                            <img src="{{ asset('storage/' . $appointment->gcash_image) }}" alt="Proof of Payment"
                                style="max-width: 20%; cursor: pointer;" onclick="showZoomed(this)">
                            @else
                            <p>No proof of payment uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Zoom Modal -->
                <div id="zoom-modal">
                    <button onclick="closeZoom()">X</button>
                    <img id="zoomed-image">
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-controls">
    <button id="prevPage" onclick="prevPage()" disabled>Previous</button>
    <span id="pageInfo"  >Page 1</span>
    <button id="nextPage" onclick="nextPage()">Next</button>
</div>


<script>
    function showZoomed(image) {
        const zoomModal = document.getElementById('zoom-modal');
        const zoomedImage = document.getElementById('zoomed-image');
        zoomedImage.src = image.src;
        zoomModal.style.display = 'flex';
    }

    function closeZoom() {
        const zoomModal = document.getElementById('zoom-modal');
        zoomModal.style.display = 'none';
    }
    
    function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const table = document.getElementById('archivedTable');
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

const rowsPerPage = 4; 
let currentPage = 1;

function displayTableRows() {
    const table = document.getElementById('archivedTable');
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




</script>


@endsection