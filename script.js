function openPopup() {
  document.getElementById("popup").style.display = "block";
  document.getElementById("popup-overlay").style.display = "block";
}

function closePopup() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("popup-overlay").style.display = "none";
}

// Function to attach event listeners to Book Now buttons
function attachBookNowListeners() {
  document.querySelectorAll(".book-now").forEach((button) => {
    button.addEventListener("click", openPopup);
  });
}

// Load pages dynamically
function loadPage(page) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", page, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("content").innerHTML = xhr.responseText;
      attachBookNowListeners(); // Reattach event listeners after loading content
    }
  };
  xhr.send();
}

// Load index.php as default
window.onload = function () {
  loadPage("index.php");
};
function openPopup() {
  document.getElementById("popup").style.display = "block";
  document.getElementById("popup-overlay").style.display = "block";
}

function closePopup() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("popup-overlay").style.display = "none";
}

// Function to attach event listeners to "Book Now" buttons
function attachBookNowListeners() {
  document.querySelectorAll(".book-now").forEach((button) => {
    button.addEventListener("click", openPopup);
  });
}

// Load pages dynamically and update active button
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

  // Remove 'active' class from all buttons
  document.querySelectorAll(".sidebar button").forEach((btn) => {
    btn.classList.remove("active");
  });

  // Add 'active' class to the clicked button
  button.classList.add("active");
}

// Attach event listeners to all sidebar buttons
document.querySelectorAll(".sidebar button").forEach((button) => {
  button.addEventListener("click", function () {
    const page = this.getAttribute("onclick").match(/'([^']+)'/)[1]; // Extract the page name
    loadPage(page, this);
  });
});

// Load index.php as default and set Booking button active
window.onload = function () {
  const bookingButton = document.querySelector(".sidebar button.active");
  loadPage("index.php", bookingButton);
};
function logout() {
  if (confirm("Are you sure you want to log out?")) {
    window.location.href = "logout.php"; // Redirect to logout script
  }
}
