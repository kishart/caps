

    


  // Get all buttons and modals
  const messageButtons = document.querySelectorAll('.trigger-btn');
  const paymentButtons = document.querySelectorAll('.trigger-btna');
  const modals = document.querySelectorAll('.modal');
  const messageCloseButtons = document.querySelectorAll('.close');
  const paymentCloseButtons = document.querySelectorAll('.close-payment');
  
  // Add event listeners to open message modals
  messageButtons.forEach(button => {
      button.onclick = function () {
          const modalId = button.id.replace('myBtn-', 'myModal-');
          document.getElementById(modalId).style.display = 'block';
      }
  });
  
  // Add event listeners to open payment modals
  paymentButtons.forEach(button => {
      button.onclick = function () {
          const modalId = button.id.replace('viewPaymentBtn-', 'paymentModal-');
          document.getElementById(modalId).style.display = 'block';
      }
  });
  
  // Add event listeners to close message modals
  messageCloseButtons.forEach(button => {
      button.onclick = function () {
          const modalId = button.id.replace('closeBtn-', 'myModal-');
          document.getElementById(modalId).style.display = 'none';
      }
  });
  
  // Add event listeners to close payment modals
  paymentCloseButtons.forEach(button => {
      button.onclick = function () {
          const modalId = button.id.replace('closePaymentBtn-', 'paymentModal-');
          document.getElementById(modalId).style.display = 'none';
      }
  });
  
  // Close modal if clicked outside the modal content
  window.onclick = function (event) {
      modals.forEach(modal => {
          if (event.target === modal) {
              modal.style.display = "none";
          }
      });
  };
  
  
  const rowsPerPage = 4;
  let currentPage = 1;
  
  function displayTableRows() {
      const table = document.getElementById("appointmentTable");
      const rows = table
          .getElementsByTagName("tbody")[0]
          .getElementsByTagName("tr");
      const totalPages = Math.ceil(rows.length / rowsPerPage);
  
      // Hide all rows initially
      for (let i = 0; i < rows.length; i++) {
          rows[i].style.display = "none";
      }
  
      // Show only rows for the current page
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      for (let i = start; i < end && i < rows.length; i++) {
          rows[i].style.display = "";
      }
  
      // Update pagination controls
      document.getElementById("prevPage").disabled = currentPage === 1;
      document.getElementById("nextPage").disabled = currentPage === totalPages;
      document.getElementById(
          "pageInfo"
      ).textContent = `Page ${currentPage} of ${totalPages}`;
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
  document.addEventListener("DOMContentLoaded", () => {
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
      const input = document.getElementById("searchInput").value.toLowerCase();
      const table = document.getElementById("appointmentTable");
      const rows = table.getElementsByTagName("tr");
      let found = false;
  
      // Loop through all table rows (except the header row)
      for (let i = 1; i < rows.length; i++) {
          const cells = rows[i].getElementsByTagName("td");
          let rowMatches = false;
  
          // Check if any cell in the row matches the search query
          for (let cell of cells) {
              if (cell.textContent.toLowerCase().includes(input)) {
                  rowMatches = true;
                  break;
              }
          }
  
          // Show or hide the row based on the search result
          rows[i].style.display = rowMatches ? "" : "none";
          if (rowMatches) found = true;
      }
  
      // Show the "No results found" alert if no rows are visible
      const noResultAlert = document.getElementById("noResultAlert");
      noResultAlert.style.display = found ? "none" : "block";
  }
  
  document
      .getElementById("toggleArchivedButton")
      .addEventListener("click", function () {
          const selectColumns = document.querySelectorAll(".select-column");
          const moveToArchivedButton = document.getElementById(
              "moveToArchivedButton"
          );
  
          // Toggle visibility of the select column
          selectColumns.forEach((column) => {
              column.style.display =
                  column.style.display === "none" ? "" : "none";
          });
  
          // Toggle visibility of the "Move it to archived" button
          moveToArchivedButton.style.display =
              moveToArchivedButton.style.display === "none"
                  ? "inline-block"
                  : "none";
      });
  
  // Enable/Disable "Move it to archived" button
  document.querySelectorAll(".archive-checkbox").forEach((checkbox) => {
      checkbox.addEventListener("change", function () {
          const checkedBoxes = document.querySelectorAll(
              ".archive-checkbox:checked"
          );
          const moveToArchivedButton = document.getElementById(
              "moveToArchivedButton"
          );
  
          // Enable the button if at least one checkbox is selected
          moveToArchivedButton.disabled = checkedBoxes.length === 0;
      });
  });
  
  // Move to Archived Functionality
  document
      .getElementById("moveToArchivedButton")
      .addEventListener("click", function () {
          const checkedBoxes = document.querySelectorAll(
              ".archive-checkbox:checked"
          );
          const selectedIds = Array.from(checkedBoxes).map((box) => box.value);
  
          if (selectedIds.length > 0) {
              // Send the selected IDs to the server
              fetch("/move-to-archived", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
                  body: JSON.stringify({ ids: selectedIds }),
              })
                  .then((response) => response.json())
                  .then((data) => {
                      if (data.success) {
                          // Remove checked rows from the table
                          checkedBoxes.forEach((box) =>
                              box.closest("tr").remove()
                          );
                      } else {
                          alert("Failed to archive items.");
                      }
                  });
          } else {
              alert("Please select at least one item to archive.");
          }
      });
  
  