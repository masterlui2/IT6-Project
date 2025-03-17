// 📌 LOGOUT FUNCTION (DEFINED IN GLOBAL SCOPE)
function logout() {
  if (confirm("Are you sure you want to log out?")) {
    window.location.href = "logout.php"; // Redirect to logout script
  }
}

document.addEventListener("DOMContentLoaded", function () {
  console.log("JavaScript Loaded ✅");

  const carBag = document.getElementById("car-bag");
  const carCount = document.getElementById("car-count");
  const selectedCarsPopup = document.getElementById("selected-cars-popup");
  const selectedCarsList = document.getElementById("selected-cars-list");
  const confirmBookingBtn = document.getElementById("confirm_booking");
  const popup = document.getElementById("popup");
  const popupOverlay = document.getElementById("popup-overlay");

  const carNameInput = document.getElementById("car_name");
  const carPriceInput = document.getElementById("car_price");
  const totalPriceDisplay = document.getElementById("total_price");
  const popupTotalPriceDisplay = document.getElementById("popup_total_price");
  const partialAmountDisplay = document.getElementById("partial_amount");

  const pickupDate = document.getElementById("pickup_date");
  const dropoffDate = document.getElementById("dropoff_date");
  const rentalDuration = document.getElementById("rental_duration");
  const driveOption = document.getElementById("drive_option");

  let selectedCars = [];

  // 📌 FUNCTION TO HANDLE "BOOK NOW" BUTTON CLICK
  function handleBookNowClick(event) {
    const carCard = event.target.closest(".car-card");
    if (!carCard) return;

    const carName = carCard.querySelector("h2").innerText;
    const carPriceText = carCard.querySelector(".car-price h3").innerText;
    const carImageSrc = carCard.querySelector("img").src;

    const carPrice = parseInt(carPriceText.replace(/\D/g, ""), 10);
    if (isNaN(carPrice)) {
      console.error("❌ Error: Unable to extract price for", carName);
      return;
    }

    // Set car details in the popup
    carNameInput.value = carName;
    carPriceInput.value = carPrice;
    carNameInput.setAttribute("data-image", carImageSrc);

    // Reset rental duration & total price
    rentalDuration.innerText = "0";
    totalPriceDisplay.innerText = `₱0`;

    // Show the popup
    popup.style.display = "block";
    popupOverlay.style.display = "block";
  }

  // 📌 EVENT DELEGATION FOR "BOOK NOW" BUTTONS
  document.body.addEventListener("click", function (event) {
    if (event.target.classList.contains("book-now")) {
      handleBookNowClick(event);
    }
  });

  function closePopup() {
    console.log("Closing popup...");
    popup.style.display = "none";
    popupOverlay.style.display = "none";
  }

  // 📌 FUNCTION TO CALCULATE RENTAL DURATION
  function calculateRentalDuration(start, end) {
    const startDate = new Date(start);
    const endDate = new Date(end);

    if (isNaN(startDate) || isNaN(endDate) || endDate <= startDate) {
      return 0;
    }

    const diffTime = Math.abs(endDate - startDate);
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
  }

  // 📌 UPDATE TOTAL PRICE WHEN PICKUP/DROPOFF DATE CHANGES
  function updateTotalPrice() {
    const start = pickupDate.value;
    const end = dropoffDate.value;
    const carPrice = parseInt(carPriceInput.value, 10);

    const rentalDays = calculateRentalDuration(start, end);
    rentalDuration.innerText = rentalDays;

    const finalPrice = rentalDays * carPrice;
    totalPriceDisplay.innerText = `₱${finalPrice.toLocaleString()}`;
  }

  // Attach event listeners to update price on date change
  pickupDate.addEventListener("change", updateTotalPrice);
  dropoffDate.addEventListener("change", updateTotalPrice);

  function updateTransactionDetails() {
    // Calculate the total price of all selected cars
    let totalPrice = selectedCars.reduce((sum, car) => sum + car.totalPrice, 0);

    // Calculate the partial amount (50% of the total price)
    let partialAmount = totalPrice * 0.5;

    console.log("Total Price:", totalPrice);
    console.log("Partial Amount:", partialAmount);

    // Update the main total and partial price
    if (totalPriceDisplay) {
      totalPriceDisplay.innerText = `₱${totalPrice.toLocaleString()}`;
    }
    if (partialAmountDisplay) {
      partialAmountDisplay.innerText = `₱${partialAmount.toLocaleString()}`;
    }

    // Update the popup total and partial price
    if (popupTotalPriceDisplay) {
      popupTotalPriceDisplay.innerText = `₱${totalPrice.toLocaleString()}`;
    }
    if (popupPartialAmountDisplay) {
      popupPartialAmountDisplay.innerText = `₱${partialAmount.toLocaleString()}`;
    }
  }
  // 📌 FUNCTION TO UPDATE SELECTED CARS IN THE CAR BAG
  function updateSelectedCars() {
    selectedCarsList.innerHTML = "";
    let totalPrice = 0;

    selectedCars.forEach((car, index) => {
      totalPrice += car.totalPrice;

      let carItem = document.createElement("div");
      carItem.classList.add("selected-car-item");
      carItem.innerHTML = `
        <div class='car-detailss'>
          <img src="${car.image}" alt="${car.name}" class="selected-car-image">
          <div class="car-details-vertical">
            <strong>${car.name}</strong> - ₱${car.price}/day
            <div>Pickup: ${car.pickupDate}</div>
            <div>Dropoff: ${car.dropoffDate}</div>
            <div>Drive Option: ${car.driveOption}</div>
            <div>Duration: ${car.rentalDuration} days</div>
            <div>Total Price: <strong>₱${car.totalPrice.toLocaleString()}</strong></div>
          </div>
        </div>
<div class='car-actions' style="display: flex; justify-content: flex-end; gap:10px;">
            <button class="edit-car" data-index="${index}">✏️ Edit</button>
            <button class="remove-car" data-index="${index}">🗑️ Remove</button>
        </div>
        <hr>
        `;
      selectedCarsList.appendChild(carItem);
    });

    // Update the car count
    carCount.innerText = selectedCars.length;
    updateTransactionDetails(); // 🔹 Ensure this is called
  }

  // 📌 EVENT LISTENER FOR REMOVE BUTTONS
  document.body.addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-car")) {
      const index = event.target.dataset.index;
      selectedCars.splice(index, 1);
      updateSelectedCars();
      updateTransactionDetails(); // ✅ Update totals after removing
    }
  });

  // 📌 EVENT LISTENER FOR EDIT BUTTONS
  document.body.addEventListener("click", function (event) {
    if (event.target.classList.contains("edit-car")) {
      const index = event.target.dataset.index;
      const car = selectedCars[index];

      // Populate Edit Booking Modal with car details
      document.getElementById("edit_car_name").value = car.name;
      document.getElementById("edit_car_price").value = car.price;
      document.getElementById("edit_pickup_date").value = car.pickupDate;
      document.getElementById("edit_dropoff_date").value = car.dropoffDate;
      document.getElementById("edit_drive_option").value = car.driveOption;

      // Call updateTotalPrice() to reflect changes dynamically in edit modal
      updateTotalPrice();

      // Show the Edit Booking Modal
      document.getElementById("editBookingModal").style.display = "block";

      // 📌 UPDATE TOTAL PRICE WHEN PICKUP/DROPOFF DATE CHANGES
      function updateEditTotalPrice() {
        const start = document.getElementById("edit_pickup_date").value;
        const end = document.getElementById("edit_dropoff_date").value;
        const carPrice = parseInt(
          document.getElementById("edit_car_price").value,
          10
        );

        const rentalDays = calculateRentalDuration(start, end);
        document.getElementById("edit_rental_duration").innerText = rentalDays;

        const finalPrice = rentalDays * carPrice;
        document.getElementById(
          "edit_total_price"
        ).innerText = `₱${finalPrice.toLocaleString()}`;
      }

      // Attach event listeners to update price on date change inside edit modal
      document
        .getElementById("edit_pickup_date")
        .addEventListener("change", updateEditTotalPrice);
      document
        .getElementById("edit_dropoff_date")
        .addEventListener("change", updateEditTotalPrice);

      // 📌 CONFIRM EDIT BUTTON FUNCTIONALITY
      document
        .getElementById("confirmEditBtn")
        .replaceWith(document.getElementById("confirmEditBtn").cloneNode(true));
      document.getElementById("confirmEditBtn").onclick = function () {
        updateEditTotalPrice();

        const updatedRentalDays = calculateRentalDuration(
          document.getElementById("edit_pickup_date").value,
          document.getElementById("edit_dropoff_date").value
        );
        const updatedTotalPrice =
          updatedRentalDays *
          parseFloat(document.getElementById("edit_car_price").value);

        selectedCars[index] = {
          name: document.getElementById("edit_car_name").value,
          price: parseFloat(document.getElementById("edit_car_price").value),
          pickupDate: document.getElementById("edit_pickup_date").value,
          dropoffDate: document.getElementById("edit_dropoff_date").value,
          driveOption: document.getElementById("edit_drive_option").value,
          rentalDuration: updatedRentalDays,
          totalPrice: updatedTotalPrice,
          image: car.image,
        };
        alert("Changes successfully saved! ✅");

        updateSelectedCars();
        updateTransactionDetails();
        closeEditModal();
      };
    }
    document
      .getElementById("editBookingModal")
      .addEventListener("click", function (event) {
        if (event.target === this) {
          closeEditModal();
        }
      });
  });

  // 📌 FUNCTION TO CLOSE EDIT MODAL
  function closeEditModal() {
    document.getElementById("editBookingModal").style.display = "none";
  }

  // 📌 EVENT LISTENER FOR "ADD CAR" BUTTON
  confirmBookingBtn.addEventListener("click", function (event) {
    event.preventDefault(); // Prevents page reload if inside a form
    const carName = carNameInput.value;
    const carPrice = parseInt(carPriceInput.value, 10);
    const pickup = pickupDate.value;
    const dropoff = dropoffDate.value;
    const selectedDriveOption = driveOption.value;
    const carImage = carNameInput.getAttribute("data-image");

    if (!carName || !pickup || !dropoff) {
      alert("⚠️ Maintenance schedule !!!");
      return;
    }

    const rentalDays = calculateRentalDuration(pickup, dropoff);
    const finalPrice = rentalDays * carPrice;

    selectedCars.push({
      name: carName,
      price: carPrice,
      pickupDate: pickup,
      dropoffDate: dropoff,
      driveOption: selectedDriveOption,
      rentalDuration: rentalDays,
      totalPrice: finalPrice,
      image: carImage,
    });

    updateSelectedCars();
    updateTransactionDetails(); // 🔹 Update total and partial amounts before closing

    // ✅ Ensure `transactionModal` is properly referenced
    const transactionModal = document.getElementById("transaction-modal");
    setTimeout(() => {
      closePopup();
      if (transactionModal) {
        transactionModal.style.display = "none";
      }
    }, 500); // Delays closing by 500ms
  });

  // 📌 FUNCTION TO TOGGLE SELECTED CARS POPUP
  function toggleSelectedCarsPopup() {
    if (selectedCars.length === 0) {
      alert("🚗 Your bag is empty! Please select a car to book.");
      return;
    }

    // Toggle the display of the popup
    if (selectedCarsPopup.style.display === "block") {
      selectedCarsPopup.style.display = "none"; // Close the popup if it's open
    } else {
      selectedCarsPopup.style.display = "block"; // Open the popup if it's closed
    }
  }

  // 📌 EVENT LISTENER FOR CAR BAG ICON
  carBag.addEventListener("click", function (event) {
    toggleSelectedCarsPopup();
    event.stopPropagation(); // Prevent the click event from bubbling up
  });

  // 📌 CLOSE POPUP WHEN CLICKING OUTSIDE
  popupOverlay.addEventListener("click", closePopup);

  popup.addEventListener("click", function (event) {
    if (event.target === this) {
      // Only close when clicking the background
      console.log("Popup background clicked, closing...");
      closePopup();
    }
  });

  selectedCarsPopup.addEventListener("click", function (event) {
    if (event.target === selectedCarsPopup) {
      event.stopPropagation();
    }
  });
  document.getElementById("cancelButton").addEventListener("click", closePopup);

  document.addEventListener("DOMContentLoaded", function () {
    const proceedTransactionBtn = document.getElementById(
      "proceed-transaction-btn"
    );
    const transactionModal = document.getElementById("transaction-modal");

    if (proceedTransactionBtn && transactionModal) {
      proceedTransactionBtn.addEventListener("click", function () {
        console.log("Proceed Transaction button clicked!");
        transactionModal.style.display = "block";
      });
    } else {
      console.error("❌ ERROR: Proceed button or modal not found!");
    }
  });
  let currentCardId = null;

  function openModal(modalId, cardId = null) {
    document.getElementById(modalId).style.display = "flex";
    if (cardId) {
      currentCardId = cardId;
    }
  }

  function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
  }

  // 📌 TRANSACTION MODAL FUNCTIONALITY
  const proceedTransactionBtn = document.getElementById(
    "proceed-transaction-btn"
  );
  const transactionModal = document.getElementById("transaction-modal");
  const closeBtn = document.querySelector(".close-btn");
  const transactionForm = document.getElementById("transaction-form");

  function updatePartialPayment() {
    const totalAmountText =
      document.getElementById("popup_total_price").textContent;
    const totalAmount =
      parseFloat(totalAmountText.replace(/[^0-9.]/g, "")) || 0;

    const partialPayment = totalAmount * 0.5; // Calculate 50%

    // Update form fields
    document.getElementById("total-amount").value = totalAmount.toFixed(2);
    document.getElementById("customer-payment").value =
      partialPayment.toFixed(2);
    document.getElementById(
      "partial_amount"
    ).textContent = `₱${partialPayment.toLocaleString("en-US", {
      minimumFractionDigits: 2,
    })}`;
  }
});
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
  // Handle edit button click
  document.addEventListener("click", function (event) {
    let button = event.target.closest(".edit-btn"); // Ensure we get the correct button
    if (button) {
      console.log("Edit button clicked!"); // Debugging line

      // Populate modal fields with dataset values
      document.getElementById("payment-editId").value = button.dataset.id;
      document.getElementById("payment-editName").value = button.dataset.name;
      document.getElementById("payment-editBirthdate").value =
        button.dataset.birthdate;
      document.getElementById("payment-editEmail").value = button.dataset.email;
      document.getElementById("payment-editMethod").value =
        button.dataset.method;
      document.getElementById("payment-editPayment").value =
        button.dataset.payment;

      const balanceField = document.getElementById("payment-editBalance");
      balanceField.value = button.dataset.balance;
      balanceField.dataset.original = button.dataset.balance; // Store original balance

      // Reset checkbox
      const markAsPaidCheckbox = document.getElementById("mark-as-paid");
      markAsPaidCheckbox.checked = false;

      // Display the modal
      document.getElementById("payment-editModal").style.display = "block";
    }
  });

  // Handle "Mark as Paid" checkbox
  document
    .getElementById("mark-as-paid")
    .addEventListener("change", function () {
      const balanceField = document.getElementById("payment-editBalance");
      if (this.checked) {
        balanceField.value = "Paid";
      } else {
        balanceField.value = balanceField.dataset.original || "";
      }
    });

  // Close Modal
  // Close modal when clicking on close button
  if (close) {
    closeBtn.addEventListener("click", function () {
      transactionModal.style.display = "none";
    });
  }

  // Close modal when clicking outside of it
  window.addEventListener("click", function (event) {
    const modal = document.getElementById("payment-editModal");
    if (event.target === modal) {
      console.log("Clicked outside the modal!");
      modal.style.display = "none";
    }
  });

  // Handle form submission
  document
    .getElementById("editForm")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      // Collect form data
      const formData = new FormData(this);

      // Find the table row for the updated entry
      const editId = document.getElementById("payment-editId").value;
      const updatedBalance = document.getElementById(
        "payment-editBalance"
      ).value;
      const row = document
        .querySelector(`button[data-id="${editId}"]`)
        .closest("tr");

      if (row) {
        row.querySelector("td:nth-child(7)").textContent = updatedBalance;
      }

      // Send form data via AJAX
      fetch(this.action, {
        method: this.method,
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Form submitted successfully:", data);
          // Optionally, you can close the modal or show a success message here
          document.getElementById("payment-editModal").style.display = "none";
        })
        .catch((error) => {
          console.error("Error submitting form:", error);
        });
    });
});
