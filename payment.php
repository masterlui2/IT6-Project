<?php
// Database connection
$host = 'localhost';
$dbname = 'it6';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch all records from the payments table
$stmt = $conn->prepare("SELECT * FROM payments ORDER BY id DESC");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 10px;
            margin-top: -60px; /* Moves the body content upward */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-left: 400px;
            width: 125%;
        }
     
        .table-container {
            width: 200%;
            max-width: 1200px;
            overflow-x: auto;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-top: 100px;
            max-height: 400px;
            overflow-y: auto;
            margin-left: auto;
            margin-right: auto;
            transform: translateX(-230px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .add-record-btn {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.add-record-btn:hover {
    background-color: #218838;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Striped Rows */
tbody tr.even {
    background-color: #f9f9f9;
}

tbody tr.odd {
    background-color: #ffffff;
}

.no-records {
    text-align: center;
    font-style: italic;
    color: gray;
}
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}


        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .actions button, .actions a {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 21px;
            text-decoration: none;
            color: black !important;
        }
        .actions :hover {
            color: #666 !important;
        }
        /* Payment Modal Styles */
        .payment-modal {
    position: fixed;
    z-index: 1000;
    top:0;
    left: 40;
    width: 100vw;
    height: 50vh;
    margin-top:20px;
    display: none; /* Hidden by default */
    justify-content: center;
    align-items: center;
}
   
.payment-modal-content {
    background-color: #fefefe;
    position: relative; /* This allows absolute-positioned elements inside */
    padding: 20px;
    border: 1px ;
    width: 40%;
    max-width: 500px;
    border-radius: 8px;
    text-align: center;
}
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #000; /* Ensure it's visible */
    background: none;
    border: none;
}
.payment-modal-content h2 {
    margin-bottom: 20px;
    font-size: 22px;
}

.payment-modal-content label {
    display: block;
    text-align: center;
    margin: 10px 0 5px;
    font-weight: bold;
}

.payment-modal-content input,
.payment-modal-content select {
    width: 90%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.payment-modal-content button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.payment-modal-content button:hover {
    background-color: #218838;
}
    </style>
</head>
<body>

    <div class="table-container">
    <div class="table-header">
        <h2>Payment Records</h2>
        <button id="openAddModal"  class="add-record-btn" >
            + Add Record
        </button>
    </div>
    <!-- Add Payment Modal -->
<div id="payment-addModal" class="payment-modal">
    <div class="payment-modal-content">
        <span class="close">&times;</span>
        <h2>Add Payment</h2>
        <form id="payment-addForm" action="add.php" method="POST">
            <label>Full Name:</label>
            <input type="text" id="payment-addName" name="fullname" required><br>
            <label>Birthdate:</label>
            <input type="date" id="payment-addBirthdate" name="birthdate" required><br>
            <label>Email:</label>
            <input type="email" id="payment-addEmail" name="email" required><br>
            <label>Payment Method:</label>
            <input type="text" id="payment-addMethod" name="payment_method" required><br>
            <label>Partial Payment:</label>
            <input type="number" id="payment-addPayment" name="partial_payment" required step="0.01"><br>
            <label>Balance:</label>
            <input type="number" id="payment-addBalance" name="balance" required step="0.01"><br>
            <button type="submit">Add Record</button>
        </form>
    </div>
</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Birthdate</th>
                <th>Email</th>
                <th>Payment Method</th>
                <th>Partial Payment</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($payments)): ?>
                <tr>
                    <td colspan="8" class="no-records">No payment records found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($payments as $index => $payment): ?>
                    <tr class="<?= $index % 2 == 0 ? 'even' : 'odd' ?>">
                        <td><?= htmlspecialchars($payment['id']) ?></td>
                        <td><?= htmlspecialchars($payment['fullname']) ?></td>
                        <td><?= htmlspecialchars($payment['birthdate']) ?></td>
                        <td><?= htmlspecialchars($payment['email']) ?></td>
                        <td><?= htmlspecialchars($payment['payment_method']) ?></td>
                        <td>₱<?= number_format($payment['partial_payment'], 2) ?></td>
                        <td>₱<?= number_format($payment['balance'], 2) ?></td>
                        <td class="actions">
                            <button class="edit-btn" data-id="<?= htmlspecialchars($payment['id']) ?>" 
                                    data-name="<?= htmlspecialchars($payment['fullname']) ?>" 
                                    data-birthdate="<?= htmlspecialchars($payment['birthdate']) ?>" 
                                    data-email="<?= htmlspecialchars($payment['email']) ?>" 
                                    data-method="<?= htmlspecialchars($payment['payment_method']) ?>" 
                                    data-payment="<?= htmlspecialchars($payment['partial_payment']) ?>" 
                                    data-balance="<?= htmlspecialchars($payment['balance']) ?>">
                                <i class="fa-solid fa-user-pen"></i>
                            </button>
                            <a href="delete.php?id=<?= urlencode($payment['id']) ?>" class="delete" title="Delete" onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

    <!-- Payment Modal -->
    <div id="payment-editModal" class="payment-modal">
        <div class="payment-modal-content">
            <span class="close">&times;</span>
            <h2>Edit Payment</h2>
            <form id="payment-editForm" action="edit.php" method="POST">
                <input type="hidden" id="payment-editId" name="id">
                <label>Full Name:</label>
                <input type="text" id="payment-editName" name="fullname" required><br>
                <label>Birthdate:</label>
                <input type="date" id="payment-editBirthdate" name="birthdate" required><br>
                <label>Email:</label>
                <input type="email" id="payment-editEmail" name="email" required><br>
                <label>Payment Method:</label>
                <input type="text" id="payment-editMethod" name="payment_method" required><br>
                <label>Partial Payment:</label>
                <input type="number" id="payment-editPayment" name="partial_payment" required step="0.01"><br>
                <label>Balance:</label>
                <input type="number" id="payment-editBalance" name="balance" required step="0.01"><br>
                <label>Mark as Paid:  </label>
                <input type="checkbox" id="mark-as-paid" name="mark_as_paid" required>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
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


</script>

    <script src="script.js?v=<?= time(); ?>" defer></script>

</body>
</html>