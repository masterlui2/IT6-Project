<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Components</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .card h3 {
            margin: 15px 0 10px;
        }
        .details {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .price {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .book-btn {
            background: black;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .modal input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .modal button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .booked-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .booked-table th, .booked-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>


    <h2>Currently Booked</h2>
    <table class="booked-table">
        <tr>
            <th>Booking ID</th>
            <th>Customer Name</th>
            <th>Car</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Cost</th>
        </tr>
        <tbody id="bookedList"></tbody>
    </table>

    <script>
        document.querySelectorAll(".book-btn").forEach(button => {
            button.addEventListener("click", function () {
                let card = this.parentElement;
                document.getElementById("bookingModal").style.display = "block";
                document.getElementById("bookingModal").dataset.car = card.dataset.car;
                document.getElementById("bookingModal").dataset.price = card.dataset.price;
            });
        });
        
        document.getElementById("confirmBooking").addEventListener("click", function () {
            let name = document.getElementById("fullName").value;
            let pickup = document.getElementById("pickupDate").value;
            let dropoff = document.getElementById("dropoffDate").value;
            let car = document.getElementById("bookingModal").dataset.car;
            let price = document.getElementById("bookingModal").dataset.price;
            
            if (!name || !pickup || !dropoff) {
                alert("Please fill all fields");
                return;
            }
            
            let startDate = new Date(pickup);
            let endDate = new Date(dropoff);
            let days = (endDate - startDate) / (1000 * 60 * 60 * 24);
            let totalCost = days * price;
            
            let table = document.getElementById("bookedList");
            let row = table.insertRow();
            row.insertCell(0).innerText = Math.floor(Math.random() * 1000);
            row.insertCell(1).innerText = name;
            row.insertCell(2).innerText = car;
            row.insertCell(3).innerText = pickup;
            row.insertCell(4).innerText = dropoff;
            row.insertCell(5).innerText = `₱${totalCost}`;
            
            document.getElementById("bookingModal").style.display = "none";
        });
        
        document.getElementById("cancelBooking").addEventListener("click", function () {
            document.getElementById("bookingModal").style.display = "none";
        });
    </script>
</body>
</html>
