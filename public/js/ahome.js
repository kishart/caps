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
                        document.getElementById(`feedback-content-${id}`).textContent =
                            data.feedback;
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


function showMessageModal(appointmentId) {
    const modal = document.getElementById(`message-modal-${appointmentId}`);
    modal.classList.remove('hidden');
}

function hideMessageModal(appointmentId) {
    const modal = document.getElementById(`message-modal-${appointmentId}`);
    modal.classList.add('hidden');
}
