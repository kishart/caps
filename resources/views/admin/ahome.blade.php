@extends('layouts.asidebartesting')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@section('content')
<style>
    .containera {
        width: 70%;
        margin-top: 40px;
        margin-left: 20%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        border-color: #000;
        box-sizing: border-box;
    }

    .table {
        width: 100%; /* Set the table to use the full width of the container */
        border-collapse: collapse; /* Ensure borders collapse for a cleaner look */
    }

    th, td {
        padding: 10px 20px; /* Add padding to create space inside each cell */
        text-align: left;
        background-color: #fff;
        word-wrap: break-word; /* Allow content to wrap within the cells */
    }

    th {
        font-weight: bold;
        border-bottom: 2px solid black; /* Add a solid border to the bottom of the header */
   
    }

    th:last-child, td:last-child {
        text-align: center;
    }

    th + th {
        padding-left: 30px; /* Add extra space between adjacent <th> elements */
            
    }

    th:first-child, td:first-child {
        width: 50px;
        text-align: center;
        border-bottom: none;
        
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ccc; /* Add a border at the bottom of each row */
    }

    input[type="checkbox"] {
        cursor: pointer;
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

    .feedback.request {
        background-color: #ccc;
    }

    .feedback.view {
        background-color: #4CAF50;
        color: white;
    }

    .action.delete {
        background-color: #f44336;
        color: white;
    }

    .action.edit {
        background-color: #2196F3;
        color: white;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 120px;
        border-radius: 5px;
        z-index: 1;
    }

    .dropdown-menu button {
        color: black;
        padding: 8px 16px;
        text-decoration: none;
        display: block;
        width: 100%;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-menu button:hover {
        background-color: #f1f1f1;
    }

    tbody tr td {
        border-bottom: none;
       
    }
   

    .modal-content {
        padding: 20px;
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
    }

    /* Adjust the position of the checkbox */
    th:first-child input[type="checkbox"] {
        position: relative;
        top: 5px;
        height: 20px;
        width: 20px;
        border-radius: 5px;
    }

    /* Ensure the table doesn't exceed the container width */
    .table-container {
        overflow-x: auto; /* Add horizontal scrolling if the table overflows */
    }

    thead {
        display: table-header-group; /* Ensure thead is treated as a table header */
    }

    th {
        border-bottom: 1px solid #000; /* Apply a strong border to the bottom of the thead */
    }
    #actionSelect option {
        text-align: left;
    }

</style>


<div class="containera">
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <td>
                            <a href="#" class="open-modal" data-id="{{ $appointment->id }}">{{ $appointment->fname }}</a>
                        </td>

                        <!-- Modal Structure -->
                        <div id="modal-{{ $appointment->id }}" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container">
                                    <span class="close-modal w3-button w3-display-topright"
                                        data-modal-id="modal-{{ $appointment->id }}">&times;</span>
                                    <h5>Appointment Details</h5>
                                    <p>Name: <span id="modal-fname">{{ $appointment->fname }}</span></p>
                                    <p>Email: <span id="modal-email">{{ $appointment->email }}</span></p>
                                    <p>Phone: <span id="modal-phone">{{ $appointment->phone }}</span></p>
                                    <p>Details: <span id="modal-details">{{ $appointment->details }}</span></p>
                        
                                    <!-- Button to open the message modal -->
                                    <button class="w3-button w3-blue open-msg-modal" data-id="{{ $appointment->id }}">Send Message</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Message Modal -->
                       <!-- Message Modal in ahome.blade.php (Admin Side) -->
<div id="msg-modal-{{ $appointment->id }}" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span class="close-msg-modal w3-button w3-display-topright" data-modal-id="msg-modal-{{ $appointment->id }}">&times;</span>
            <h5>Send Message to {{ $appointment->fname }}</h5>

            <!-- Message Form -->
            <form action="{{ route('send.message', $appointment->id) }}" method="POST">
                @csrf
                <textarea name="message" rows="4" class="w3-input" placeholder="Type your message here"></textarea>
                <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                    <button type="submit" class="w3-button w3-green">Send</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

                        

                        <td>{{ $appointment->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>

                        <td>
                            <select id="actionSelect" class="custom-select" onchange="handleSelectChange(this)" style="height: 42.5px; width: 130px; border-radius: 15px; background-color: rgb(235, 229, 229); padding: 10px 15px; font-size: 16px; border: none; text-align: right;">
                                <option class="option" value="" disabled selected>{{ ucfirst($appointment->status) }}</option>
                                <option class="option" value="{{ url('admin/accepted/' . $appointment->id) }}">Approved</option>
                                <option class="option" value="{{ url('admin/declined/' . $appointment->id) }}">Declined</option>
                            </select>
                            
                            
                        </td>

                        <td>
                            @if ($appointment->feedback_requested)
                                <!-- View Feedback Button -->
                                <button type="button" class="btn btn-success open-feedback-modal" data-id="{{ $appointment->id }}" style=" width: 100px;border-radius: 15px; color:black; background-color: rgb(106, 233, 106); border: none; display: flex; align-items: center; justify-content: center; padding: 10px;">
                                    <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 18px;">
                                        visibility
                                    </span>
                                    View
                                </button>
                                
                                <!-- Modal Structure -->
                                <div id="feedback-modal-{{ $appointment->id }}" class="w3-modal">
                                    <div class="w3-modal-content">
                                        <div class="w3-container">
                                            <span class="close-feedback-modal w3-button w3-display-topright"
                                                  data-modal-id="feedback-modal-{{ $appointment->id }}">&times;</span>
                                            <h1>This is feedback from customer</h1>
                                            <p id="feedback-content-{{ $appointment->id }}"></p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('request.feedback', $appointment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="width: 100px;border-radius: 15px; color:black; background-color: rgb(235, 229, 229); border: none; display: flex; align-items: center; justify-content: center; padding: 10px;"> 
                                        <span class="material-symbols-outlined" style="font-size: 21px; margin-right: 8px;">
                                        today
                                    </span>Request </button>
                                </form>
                            @endif
                        </td>
                        

                        <td>
                            <div class="dropdown" >
                                <span style="display: inline-block; padding: 3px; border: 1px solid rgb(8, 8, 10); border-radius: 10px; cursor: pointer;" class="material-symbols-outlined" onclick="toggleMenu(this)">
                                    more_horiz
                                </span>
                                <div class="dropdown-menu" style="display: none; position: absolute; background-color: white;  border-radius: 10px; z-index: 1;border-color: black;">
                                    <a href="{{ url('admin/editappoint/' . $appointment->id) }}" class="action edit" style="padding: 10px; display: block; background-color:white; color: #000; text-decoration: none;">
                                        <span class="material-symbols-outlined">edit_note</span>
                                        Edit
                                    </a>
                                    <hr>
                                    <a href="{{ url('admin/delete-appointment/' . $appointment->id) }}" class="action delete" style="padding: 10px; display: block; background-color:white; color: #000; text-decoration: none;">
                                        <span class="material-symbols-outlined">delete</span> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
            </tbody>
        </table>
    </div>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
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

        function toggleMenu(element) {
            var dropdownMenu = element.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        }

        // Optional: Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.material-symbols-outlined')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        };



        document.addEventListener('DOMContentLoaded', function() {
            // Open modal
            document.querySelectorAll('.open-modal').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    var id = this.getAttribute('data-id');
                    var modal = document.getElementById(`modal-${id}`);

                    // Show the modal
                    if (modal) {
                        modal.style.display = 'block';
                    }
                });
            });

            // Close modal when clicking on the 'X' icon
            document.querySelectorAll('.close-modal').forEach(button => {
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

    document.addEventListener('DOMContentLoaded', function() {
    // Open message modal
    document.querySelectorAll('.open-msg-modal').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var modal = document.getElementById(`msg-modal-${id}`);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // Close message modal
    document.querySelectorAll('.close-msg-modal').forEach(button => {
        button.addEventListener('click', function() {
            var modalId = this.getAttribute('data-modal-id');
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Close modal when clicking outside modal content
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
