@extends('layouts.adminsidebar')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
    
.container {
  width: 90%;
  margin-left: 20%;
  margin-right: 20%;
  margin-top: 25px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #fff;
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

</style>



<div class="container">
    <table>
      <thead>
        <tr>
            <th><input type="checkbox"></th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Date/Time</th>
          <th>Status</th>
          <th>Feedback</th>
          <th>More</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td><input type="checkbox"></td>
          <td>Sylus Loloves</td>
          <td>sylusloloves@gmail.com</td>
          <td>09143143143</td>
          <td>23/08/2024 11:59am</td>
          <td><button class="status in-progress">In progress</button></td>
          <td><button class="feedback request">Request</button></td>
          <td>
            <div class="dropdown">
              <span style="display: inline; padding: 5px; border: 1px solid rgb(8, 8, 10); border-radius: 10px;" class="material-symbols-outlined" onclick="toggleMenu(this)">
                more_horiz
              </span>
              <div class="dropdown-menu">
                <button class="action delete">Delete</button>
                <button class="action edit">Edit</button>
              </div>
            </div>
          </td>
          
        </tr>
        <tr>
            <td><input type="checkbox"></td>
          <td>Rafayel Biot</td>
          <td>rafayelbayot@gmail.com</td>
          <td>096969696</td>
          <td>23/08/2024 12:37pm</td>
          <td><button class="status completed">Completed</button></td>
          <td><button class="feedback view">View</button></td>
          <td>
            <div class="dropdown">
              <span style="display: inline; padding: 5px; border: 1px solid rgb(8, 8, 10); border-radius: 10px;" class="material-symbols-outlined" onclick="toggleMenu(this)">
                more_horiz
              </span>
              <div class="dropdown-menu">
                <button class="action delete">Delete</button>
                <button class="action edit">Edit</button>
              </div>
            </div>
          </td>
          
        </tr>
      </tbody>
    </table>
  </div>
  
  

  <script>
    function toggleMenu(element) {
  var dropdownMenu = element.nextElementSibling;
  dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
}

// Close the dropdown if the user clicks outside of it
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
}

  </script>
@endsection
