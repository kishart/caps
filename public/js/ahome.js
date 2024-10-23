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


function toggleMenu(element) {
    // Hide any open dropdown menus
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    allDropdowns.forEach((dropdown) => {
        if (dropdown !== element.nextElementSibling) {
            dropdown.style.display = 'none';
        }
    });

    // Toggle the current dropdown
    const dropdownMenu = element.nextElementSibling;
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
}

// Call this function when clicking outside the dropdown to close it
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.dropdown-menu');
    dropdowns.forEach((dropdown) => {
        const toggleButton = dropdown.previousElementSibling;
        if (!toggleButton.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
});



function toggleMenu(element) {
    const menu = element.nextElementSibling;
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

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


function toggleMenu(element) {
    const menu = element.nextElementSibling;
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

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


//accepted

function handleAction(select, id) {
    if (select.value === 'approve') {
        document.getElementById('confirmApprovalModal-' + id).style.display = 'block';
    } else if (select.value === 'decline') {
        document.getElementById('confirmDeclineModal-' + id).style.display = 'block';
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}


//input money for downpayment
    function formatCurrency(input) {
        // Remove any non-digit characters, except for period (.)
        let value = input.value.replace(/[^0-9.]/g, '');

        // Split the input value into whole number and decimal parts
        let parts = value.split('.');

        // Format the whole number part with commas
        let wholePart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // If there's a decimal part, limit it to two decimal places
        let decimalPart = parts[1] ? parts[1].substring(0, 2) : '';

        // Combine the whole part and decimal part (if any)
        input.value = decimalPart ? wholePart + '.' + decimalPart : wholePart;
    }
