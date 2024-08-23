@extends('layouts.adminsidebar')

@section('content')
    <style>
.containera {
  width: 90%;
  margin-left: 20%;
  margin-right: 20%;
  margin-top: 25px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #fff;
}

.material-symbols-outlined {
  font-size: 35px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid black;
  background-color: #fff;
}

th:last-child {
  color: white;
  text-align: center;
}

td {
  padding: 10px;
  text-align: left;
}

th {
  font-weight: bold;
}

td:first-child, th:first-child {
  width: 50px; /* Adjust width to fit checkboxes */
  text-align: center;
}

input[type="checkbox"] {
  cursor: pointer;
}

.status, .feedback, .action {
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

/* Remove the border bottom of the last row in tbody */
tbody tr:last-child td {
  border-bottom: none;
}

    </style>

    <div class="containera">

                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                           
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date/Time</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->fname }}</td>
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                <td>{{ ucfirst($appointment->status) }}

                                    <select id="actionSelect" class="custom-select" onchange="handleSelectChange(this)">
                                        <option value="" disabled selected>Select Action</option>
                                        <option value="{{ url('admin/accepted/' . $appointment->id) }}">Approve</option>
                                        <option value="{{ url('admin/declined/' . $appointment->id) }}">Decline</option>
                                    </select>
                                </td>
                                <td>
                                    <form action="{{ route('request.feedback', $appointment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Request Feedback</button>
                                    </form>
                                </td>
                                
                                
                                <td>
                                    <div class="dropdown">
                                        <span style="display: inline-block; padding: 5px; border: 1px solid rgb(8, 8, 10); border-radius: 10px; cursor: pointer;" class="material-symbols-outlined" onclick="toggleMenu(this)">
                                            more_horiz
                                        </span>
                                        <div class="dropdown-menu" style="display: none; position: absolute; background-color: white; box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); border-radius: 5px; z-index: 1;">
                                            <a href="{{ url('admin/editappoint/' . $appointment->id) }}" class="action edit" style="padding: 10px; display: block; color: #000; text-decoration: none;">
                                                <span class="material-symbols-outlined" style="color: #ac6f53;">edit_note</span> Edit
                                            </a>
                                            <a href="{{ url('admin/delete-appointment/' . $appointment->id) }}" class="action delete" style="padding: 10px; display: block; color: red; text-decoration: none;">
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

    </script>
@endsection
