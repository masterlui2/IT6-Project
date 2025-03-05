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

</head>
<body>
<div class="sidebar">
        <img src="image/bg.jpg" alt="Car Rental Logo" class="logo">
        <button class="active" onclick="loadPage('index.php')">
            <i class="fa-solid fa-calendar-days"></i>&nbsp;Booking</button>
        <button onclick="loadPage('available.php')"><i class="fa-solid fa-car"></i>&nbsp;Available</button>
        <button onclick="loadPage('payment.php')"><i class="fa-solid fa-credit-card"></i>&nbsp;Payment</button>
        <button onclick="loadPage('vehicles.php')"><i class="fa-solid fa-truck-pickup"></i>&nbsp;Vehicles</button>
        <button onclick="loadPage('maintenance.php')"><i class="fa-solid fa-wrench"></i>&nbsp;Maintenance</button>
        <button onclick="loadPage('register.php')"><i class="fa-solid fa-user-plus"></i>&nbsp;Register</button>
        <button class="logout-btn" onclick="logout()">
        <i class="fa-solid fa-sign-out-alt"></i>&nbsp;Logout
    </button>
    </div>
    
</div>

        
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
            <h3>₱5,000/DAY</h3>
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
        <img src="image/c9.png" alt="Car">
        <div class="car-details">
            <h2>Mercedez Benz</h2>
            <div class="features">
                <i class="fa-solid fa-users"></i> 8 seats
                <i class="fa-solid fa-suitcase"></i> 2 bags
                <i class="fa-solid fa-car"></i> 5 doors
                <i class="fa-solid fa-fan"></i> A/C
            </div>
            <p>Unlimited Mileage | Roadside Assistance | Collision Damage Waiver</p>
        </div>
        <div class="car-price">
            <h3>₱5/DAY</h3>
            <button class="book-now">BOOK NOW</button>
        </div>
    </div>
    <div class="car-card">
        <img src="image/c2.png" alt="Car">
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
</div> <!-- CLOSES .container properly -->

       
    <div class="popup-overlay" id="popup-overlay"></div>
    <div class="popup" id="popup">
        <h2>Book This Car</h2>
        <input type="hidden" id="car_name">
        <input type="hidden" id="car_price">

        <label>Full Name</label>
        <input type="text" placeholder="Enter your full name" required>

        <label>Email</label>
        <input type="email" placeholder="Enter your email" required>

        <label>Pick-up Date</label>
        <input type="date" required>

        <label>Drop-off Date</label>
        <input type="date" required>

        <button type="submit">Confirm Booking</button>
        <button type="button" onclick="closePopup()">Cancel</button>
    </div>
    <script src="script.js?v=<?= time(); ?>" defer></script>

</body>
</html>