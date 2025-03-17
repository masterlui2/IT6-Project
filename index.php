<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Booking</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>
<div class="sidebar">
    <img src="image/bg.jpg" alt="Car Rental Logo" class="logo">
    <button class="active" onclick="loadPage('index.php')">
        <i class="fa-solid fa-calendar-days"></i>&nbsp;Booking
    </button>
    <button onclick="loadPage('payment.php')"><i class="fa-solid fa-credit-card"></i>&nbsp;Payment</button>
    <button onclick="loadPage('maintenance.php')"><i class="fa-solid fa-wrench"></i>&nbsp;Maintenance</button>
    <button onclick="loadPage('register.php')"><i class="fa-solid fa-user-plus"></i>&nbsp;Register</button>
    <button class="logout-btn" onclick="logout()">
        <i class="fa-solid fa-sign-out-alt"></i>&nbsp;Logout
    </button>
</div>

<script>
  
// Function to load pages dynamically and update the active button
function loadPage(page, button) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", page, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("content").innerHTML = xhr.responseText;
            attachBookNowListeners(); // Reattach event listeners after loading content
        }
    };
    xhr.send();

    // Remove 'active' class from all sidebar buttons
    document.querySelectorAll(".sidebar button").forEach((btn) => {
        btn.classList.remove("active");
    });

    // Add 'active' class to the clicked button
    if (button) {
        button.classList.add("active");
    }
}

// Attach event listeners to all sidebar buttons
function attachSidebarListeners() {
    document.querySelectorAll(".sidebar button").forEach((button) => {
        button.addEventListener("click", function () {
            const page = this.getAttribute("onclick").match(/'([^']+)'/)[1]; // Extract the page name
            loadPage(page, this);
        });
    });
}

window.onload = function () {
    const bookingButton = document.querySelector(".sidebar button.active");
    loadPage("index.php", bookingButton); // Load default page
    attachSidebarListeners(); // Attach sidebar button listeners
};

</script>

<div class="container" id="content">
    <div class="car-card">
        <img src="image/c1.png" alt="Car">
        <div class="car-details">
            <h2>Honda City</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 5 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱2,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>

    <div class="car-card">
        <img src="image/c4.png" alt="Car">
        <div class="car-details">
            <h2>Toyota Land Cruiser</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 5 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱2,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>

    <div class="car-card">
        <img src="image/c3.png" alt="Car">
        <div class="car-details">
            <h2>Toyota Fortuner</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 8 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱3,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>

    <div class="car-card">
        <img src="image/c5.png" alt="Car">
        <div class="car-details">
            <h2>Toyota Hiace</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 8 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱3,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>

    <div class="car-card">
        <img src="image/c6.png" alt="Car">
        <div class="car-details">
            <h2>Hilux Conquest</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 8 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱2,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>

    <div class="car-card">
        <img src="image/c7.png" alt="Car">
        <div class="car-details">
            <h2>Suzuki Jimny</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 8 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price" id="car_price">
            <h3>₱3,500/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>
</div> <!-- CLOSES .container properly -->

<!-- Booknow modal -->
<div class="popup-overlay" id="popup-overlay"></div>
<div class="popup" id="popup">
    <h2>Book This Car</h2>
    <input type="hidden" id="car_name">
    <input type="hidden" id="car_price">

    <label>Pick-up Date</label>
    <input type="date" id="pickup_date" required>

    <label>Drop-off Date</label>
    <input type="date" id="dropoff_date" required>

    <label for="drive_option">Choose an option:</label>
    <select id="drive_option">
        <option value="self_drive">Self Drive</option>
        <option value="with_driver">With Driver</option>
    </select>

    <!-- Calendar Container -->
    <div id="calendar-container">
        <h3>Available Dates</h3>
        <div id="calendar"></div> <!-- Calendar will be rendered here -->
    </div>

    <p>Rental Duration: <span id="rental_duration">0</span> days</p>
    <p>Total Price: <strong id="total_price">₱0</strong></p>

    <button type="submit" id="confirm_booking">Confirm Booking</button>
    <button type="button" id="cancelButton">Cancel</button>
</div>
<div id="car-bag" onclick="showSelectedCars()">
    <i class="fa-solid fa-car"></i>
    <span id="car-count">0</span>
</div>



<!-- Selected Cars Sidebar -->
<div id="selected-cars-popup">
    <div class="popup-header">
        <h2>Selected Cars</h2>
    </div>
    <div id="selected-cars-list"></div>
    <div class="popup-footer">
        <!-- Total and Partial Amount Display -->
        <p><strong>Total Amount:</strong> <span id="popup_total_price">₱0</span></p>
        <p><strong>Booking Amount (50%):</strong> <span id="partial_amount">₱0</span></p>
        <button id="proceed-transaction-btn">Proceed to Transaction</button>
    </div>
</div>

<!-- Edit Booking Modal -->
<div id="editBookingModal" class="modal">
    <div class="modal-content">
        <h2>Edit Booking</h2>
        <div class="form-group">
            <label for="edit_car_name">Car Name:</label>
            <input type="text" id="edit_car_name" disabled>
        </div>
        <div class="form-group">
            <label for="edit_car_price">Price Per Day (₱):</label>
            <input type="text" id="edit_car_price" disabled>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="edit_pickup_date">Pick-up Date:</label>
                <input type="date" id="edit_pickup_date" required>
            </div>
            <div class="form-group">
                <label for="edit_dropoff_date">Drop-off Date:</label>
                <input type="date" id="edit_dropoff_date" required>
            </div>
        </div>
        <div class="form-group">
            <label for="edit_drive_option">Drive Option:</label>
            <select id="edit_drive_option">
                <option value="self_drive">Self Drive</option>
                <option value="with_driver">With Driver</option>
            </select>
        </div>
        <div class="summary-box">
            <p><strong>Rental Duration:</strong> <span id="edit_rental_duration">0</span> days</p>
            <p><strong>Total Price:</strong> <span id="edit_total_price">₱0</span></p>
        </div>
        <button id="confirmEditBtn" class="btn-primary">Confirm Changes</button>
    </div>
</div>

<!-- Transaction Modal -->
<div id="transaction-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Transaction Details</h2>
        <form id="transaction-form">
            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" name="fullname" required>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="payment-method">Payment Method:</label>
            <select id="payment-method" name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit-card">Credit Card</option>
                <option value="gcash">GCash</option>
            </select>

            <!-- Reference Number Field (Hidden by Default) -->
            <div id="reference-number-container" style="display: none;">
                <label for="reference-number">Reference Number:</label>
                <input type="text" id="reference-number" name="reference_number" placeholder="Enter reference number">
            </div>

            <label for="customer-payment">Customer Payment (50% of Total):</label>
            <input type="number" id="customer-payment" name="partial_payment" readonly>

            <!-- Hidden input for total_amount -->
            <input type="hidden" id="total-amount" name="total_amount">
            <button type="submit" class="confirm-transaction">Confirm Transaction</button>
        </form>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="scriptv2.js?v=<?= time(); ?>"></script> <!-- For PHP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
  const addModal = document.getElementById("payment-addModal");
  const addButton = document.getElementById("openAddModal");
  const closeButtons = document.querySelectorAll(".close");
  const addForm = document.getElementById("payment-addForm");

  // Open Add Modal & Clear Fields
  addButton.addEventListener("click", function () {
    console.log("Add button clicked!"); // Debugging line
    addForm.reset(); // Clear fields
    addModal.style.display = "block";
  });

  // Close Modal
  closeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      addModal.style.display = "none";
    });
  });

  // Handle Form Submission via AJAX
  addForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent page reload

    const formData = new FormData(addForm);

    fetch("add.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json()) // Expect JSON response
      .then((data) => {
        if (data.success) {
          // Append new row to table
          const tbody = document.querySelector("tbody");
          const newRow = document.createElement("tr");

          newRow.innerHTML = `
                  <td>${data.id}</td>
                  <td>${data.fullname}</td>
                  <td>${data.birthdate}</td>
                  <td>${data.email}</td>
                  <td>${data.payment_method}</td>
                  <td>₱${parseFloat(data.partial_payment).toFixed(2)}</td>
                  <td>₱${parseFloat(data.balance).toFixed(2)}</td>
                  <td class="actions">
                      <button class="edit-btn" data-id="${data.id}" 
                          data-name="${data.fullname}" 
                          data-birthdate="${data.birthdate}" 
                          data-email="${data.email}" 
                          data-method="${data.payment_method}" 
                          data-payment="${data.partial_payment}" 
                          data-balance="${data.balance}">
                          <i class="fa-solid fa-user-pen"></i>
                      </button>
                      <a href="delete.php?id=${
                        data.id
                      }" class="delete" title="Delete" onclick="return confirm('Are you sure?')">
                          <i class="fa-solid fa-trash-can"></i>
                      </a>
                  </td>
              `;
          tbody.appendChild(newRow);
          addModal.style.display = "none"; // Close modal
        } else {
          alert("Error adding record!");
        }
      })
      .catch((error) => console.error("Error:", error));
  });
});


  document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded and parsed."); // First debug point

    const addModal = document.getElementById("addRecordModal");
    const openAddBtn = document.getElementById("openAddModal");
    const closeAddBtn = addModal?.querySelector(".payment-close");

    if (!openAddBtn) {
        console.error("ERROR: Add Record button (openAddModal) not found.");
        return;
    } else {
        console.log("Add Record button found.");
    }

    if (!addModal) {
        console.error("ERROR: Add Record modal (addRecordModal) not found.");
        return;
    } else {
        console.log("Add Record modal found.");
    }

    // Open modal
    openAddBtn.addEventListener("click", function () {
        console.log("Add Record button clicked!"); // Debug check
        addModal.style.display = "flex";
    });

    // Close modal
    if (!closeAddBtn) {
        console.error("ERROR: Close button inside modal not found.");
        return;
    }

    closeAddBtn.addEventListener("click", function () {
        console.log("Close button clicked!"); // Debug check
        addModal.style.display = "none";
    });

    // Close modal when clicking outside
    window.addEventListener("click", function (event) {
        if (event.target === addModal) {
            console.log("Clicked outside modal, closing it.");
            addModal.style.display = "none";
        }
    });
});
  // Function to open the modal
  function openModal(modalId, cardId = null) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                if (cardId) {
                    // Store the card ID in a data attribute for later use
                    modal.setAttribute('data-card-id', cardId);
                }
            } else {
                console.error(`Modal with ID ${modalId} not found.`);
            }
        }

        // Function to close the modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            } else {
                console.error(`Modal with ID ${modalId} not found.`);
            }
        }

      // Function to confirm the schedule and update the card
function confirmSchedule() {
    const dateInput = document.getElementById('sched');
    const selectedDate = dateInput.value;

    if (!selectedDate) {
        alert('Please select a date.');
        return;
    }

    // Get the card ID from the modal's data attribute
    const modal = document.getElementById('calendarModal');
    const cardId = modal.getAttribute('data-card-id');

    if (cardId) {
        // Find the maintenance card by ID
        const maintenanceCard = document.getElementById(cardId);
        
        if (maintenanceCard) {
            // Check if there's an existing maintenance date field
            let maintenanceDateField = maintenanceCard.querySelector('.scheduled-date');

            if (!maintenanceDateField) {
                // If it doesn't exist, create one dynamically
                maintenanceDateField = document.createElement('div');
                maintenanceDateField.className = 'feature-item';
                maintenanceCard.querySelector('.features').appendChild(maintenanceDateField);
            }

            // Update the maintenance date field
            maintenanceDateField.innerHTML = `<i class="fa-solid fa-calendar-check"></i> <span style="color: red;">Maintenance Date: ${selectedDate}</span>`;  
           console.log(`Maintenance scheduled for ${selectedDate} on card: ${cardId}`);
        } else {
            console.error(`Card not found: ${cardId}`);
        }
    } else {
        console.error('Card ID not found in modal.');
    }

    // Close the modal
    closeModal('calendarModal');
}

        // Function to delete a card
        function deleteCard(cardId) {
            const card = document.getElementById(cardId);
            if (card) {
                card.remove();
                console.log(`Deleted card: ${cardId}`);
            } else {
                console.error(`Card with ID ${cardId} not found.`);
            }
        }
  document.addEventListener("DOMContentLoaded", function () {
    let bookedCars = {}; // Object to store booked cars and their date ranges

    // Elements
    const pickupDateInput = document.getElementById("pickup_date");
    const dropoffDateInput = document.getElementById("dropoff_date");
    const confirmBookingBtn = document.getElementById("confirm_booking");
    const rentalDurationDisplay = document.getElementById("rental_duration");
    const totalPriceDisplay = document.getElementById("total_price");
    const calendarContainer = document.getElementById("calendar");
    const carNameInput = document.getElementById("car_name");
    const carPriceInput = document.getElementById("car_price");

    // Initialize Flatpickr
    const calendar = flatpickr(calendarContainer, {
      inline: true, // Display the calendar inline
      mode: "range", // Allow selecting a date range
      disable: [], // Initially, no dates are disabled
      onChange: function (selectedDates) {
        // Handle date selection (if needed)
      },
    });

    // Function to calculate rental duration
    function calculateRentalDuration() {
      const pickupDate = new Date(pickupDateInput.value);
      const dropoffDate = new Date(dropoffDateInput.value);
      const timeDiff = dropoffDate - pickupDate;
      const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
      return daysDiff;
    }

    // Function to calculate total price
    function calculateTotalPrice() {
      const days = calculateRentalDuration();
      const carPrice = parseFloat(carPriceInput.value);
      const totalPrice = carPrice * days;
      return totalPrice;
    }

    // Function to update rental duration and total price
    function updateRentalDetails() {
      const days = calculateRentalDuration();
      const totalPrice = calculateTotalPrice();

      // Update the rental duration display
      rentalDurationDisplay.textContent = days;

      // Update the total price display
      totalPriceDisplay.textContent = `₱${totalPrice.toLocaleString()}`;
    }

    // Event listeners for date inputs
    pickupDateInput.addEventListener("change", function () {
      dropoffDateInput.min = this.value; // Set drop-off date to be after pick-up date
      updateRentalDetails(); // Update rental details
      updateCalendar(); // Update the calendar after selecting pick-up date
    });

    dropoffDateInput.addEventListener("change", function () {
      pickupDateInput.max = this.value; // Set pick-up date to be before drop-off date
      updateRentalDetails(); // Update rental details
      updateCalendar(); // Update the calendar after selecting drop-off date
    });

    // Event listener for car selection
    carNameInput.addEventListener("change", function () {
      // Reset the calendar when a new car is selected
      updateCalendar();
      updateRentalDetails(); // Update rental details for the new car
    });

    // Function to generate a date range
    function generateDateRange(startDate, endDate) {
      const dates = [];
      let currentDate = new Date(startDate);
      const end = new Date(endDate);

      while (currentDate <= end) {
        dates.push(currentDate.toISOString().split("T")[0]); // Format as YYYY-MM-DD
        currentDate.setDate(currentDate.getDate() + 1);
      }

      return dates;
    }

    // Function to update the calendar
    function updateCalendar() {
      const carName = carNameInput.value;
      const bookedRanges = bookedCars[carName] || [];

      // Generate all booked dates from the ranges
      const allBookedDates = bookedRanges.flatMap(range =>
        generateDateRange(range.pickupDate, range.dropoffDate)
      );

      // Disable booked dates in the calendar
      calendar.set("disable", allBookedDates);

      // Mark booked dates in red
      const calendarDays = document.querySelectorAll(".flatpickr-day");
      calendarDays.forEach(day => {
        const date = day.getAttribute("aria-label");
        if (allBookedDates.includes(date)) {
          day.style.backgroundColor = "#007bff"; // Light red for booked dates
        } else {
          day.style.backgroundColor = ""; // Reset for available dates
        }
      });
    }

    // Event listener for confirm booking button
    confirmBookingBtn.addEventListener("click", function () {
      const carName = carNameInput.value;
      const pickupDate = pickupDateInput.value;
      const dropoffDate = dropoffDateInput.value;

      if (!bookedCars[carName]) {
        bookedCars[carName] = [];
      }

      // Mark the date range as booked for the selected car
      bookedCars[carName].push({ pickupDate, dropoffDate });

      // Mark the car as booked
      alert(`Car "${carName}" booked from ${pickupDate} to ${dropoffDate}`);

      // Update the calendar after booking
      updateCalendar();
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    // Elements
    const popupTotalPriceDisplay = document.getElementById("popup_total_price");
    const totalAmountInput = document.getElementById("total-amount");
    const partialAmountDisplay = document.getElementById("partial_amount");
    const customerPaymentInput = document.getElementById("customer-payment");
    const paymentMethodSelect = document.getElementById("payment-method");
    const referenceNumberContainer = document.getElementById("reference-number-container");
    const transactionModal = document.getElementById("transaction-modal");
    const closeBtn = document.querySelector(".close-btn");
    const transactionForm = document.getElementById("transaction-form");
    const proceedTransactionBtn = document.getElementById("proceed-transaction-btn");

    // Ensure the button exists before adding an event listener
    if (proceedTransactionBtn) {
      proceedTransactionBtn.addEventListener("click", function () {
        let totalAmount =
          parseFloat(
            popupTotalPriceDisplay?.textContent.replace(/[₱,]/g, "")
          ) || 0; // Remove ₱ and commas

        if (totalAmount > 0) {
          totalAmountInput.value = totalAmount.toFixed(2); // Store numeric value
          let bookingAmount = totalAmount * 0.5; // Calculate 50%

          // Show formatted booking amount
          partialAmountDisplay.textContent = `₱${bookingAmount.toLocaleString()}`;

          // Store raw numeric value for backend
          customerPaymentInput.value = bookingAmount;
          customerPaymentInput.setAttribute("data-raw", bookingAmount);

          // Open the transaction modal
          transactionModal.style.display = "block";
        } else {
          alert("Invalid total amount. Please check the transaction details.");
        }
      });
    }

    // Close modal when clicking on close button
    if (closeBtn) {
      closeBtn.addEventListener("click", function () {
        transactionModal.style.display = "none";
      });
    }

    // Close modal when clicking outside the content
    window.addEventListener("click", function (e) {
      if (e.target === transactionModal) {
        transactionModal.style.display = "none";
      }
    });

    // Show reference number field for GCash & Credit Card
    paymentMethodSelect.addEventListener("change", function () {
      referenceNumberContainer.style.display =
        this.value === "gcash" || this.value === "credit-card"
          ? "block"
          : "none";
    });

    // Submit the form via AJAX
    transactionForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent page reload

      // Ensure the numeric value is submitted
      customerPaymentInput.value =
        customerPaymentInput.getAttribute("data-raw");

      let formData = new FormData(this);

      fetch("submit.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json()) // Expect JSON response
        .then((data) => {
          if (data.success) {
            alert("Transaction saved successfully!");
            transactionForm.reset();
            referenceNumberContainer.style.display = "none"; // Hide reference field
            transactionModal.style.display = "none"; // Close modal
          } else {
            alert("Error: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("An error occurred while processing the transaction.");
        });
    });
  });
</script>
</body>
</html>