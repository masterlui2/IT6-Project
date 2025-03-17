    <?php
    include 'db.php';

    $employee_result = $conn->query("SELECT * FROM employee");
    $driver_result = $conn->query("SELECT * FROM driver");

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Management System</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body {
                background-color: #f8f9fa;
                color: black;
            }
            .btn-group .btn {
                min-width: 150px;
            }
            .btn-primary {
                background-color: black;    
                border-color: black;
            }
            .btn-primary:hover {
                background-color: #333;
                border-color: #333;
            }
            .table-container {
                margin-left: -50px;

    margin: auto; /* Centering */
    padding-top: 20px;
}


            .table th {
                background-color: black;
                color: white;
                text-align: center;
                padding: 12px;
            }
            .table td {
                text-align: center;
                padding: 10px;
            }
            .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    .modal-body form {
        max-width: 500px; /* Set max width */
        margin: auto; /* Center the form */
    }

    .modal-body .form-control, 
    .modal-body .form-select {
        width: 100%; /* Make inputs take full width */
        max-width: 100%; /* Ensure they don't exceed container */
        border-radius: 8px; /* Keep rounded corners */
        padding: 10px;
    }

    .modal-header {
        border-bottom: 2px solid #ddd;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control, .form-select {
        border-radius: 8px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        font-size: 16px;
        padding: 10px;
    }

    .btn-success:hover {
        background-color: #218838;
    }
    .btn-dark:hover {
            background-color: #333; /* Slightly lighter black on hover */
            border-color: #333;
        }
        .btn-dark.active {
            background-color: #555; /* Highlight active button */
            border-color: #555;
        }
        </style>
    </head>
    <body>

    </div>
    <div class="mt-2 ms-auto" style="width: 80%;"> 
    <!-- Employees Section (Default Active) -->
            <div id="employees">
            <button id="btnEmployees" class="btn btn-primary mb-3" onclick="showContainer('employees', this)">Employees</button>
            <button id="btnDrivers" class="btn btn-primary mb-3" onclick="showContainer('drivers', this)">Drivers</button>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                Add Employee
                </button>
                <div class="container">
                <div class="table-container ms-10"> <!-- Adds left margin -->
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Salary</th>
                        <th>Added By</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $employee_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['employeeid']) ?></td>
                            <td><?= htmlspecialchars($row['fullname']) ?></td>
                            <td><?= htmlspecialchars($row['contactno']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['role']) ?></td>
                            <td>********</td> <!-- Hide Password -->
                            <td>₱<?= number_format($row['salary'], 2, '.', '') ?></td>
                            <td><?= htmlspecialchars($row['addedby']) ?></td>
                            <td><?= htmlspecialchars($row['dateadded']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Drivers Section (Hidden by Default) -->
        <div id="drivers" class="d-none">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDriverModal">
                Add Driver
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>License No</th>
                        <th>Years Exp</th>
                        <th>Commission Rate</th>
                        <th>Added By</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $driver_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['driverid']) ?></td>
                            <td><?= htmlspecialchars($row['fullname']) ?></td>
                            <td><?= htmlspecialchars($row['contactno']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['licenseno']) ?></td>
                            <td><?= htmlspecialchars($row['yrofexp']) ?></td>
                            <td>₱<?= number_format($row['comrate'], 2, '.', '') ?></td>
                            <td><?= htmlspecialchars($row['addedby']) ?></td>
                            <td><?= htmlspecialchars($row['dateadded']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'Modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function showContainer(section, btn) {
        // Hide both containers
        document.getElementById('employees').classList.add('d-none');
        document.getElementById('drivers').classList.add('d-none');

        // Show the selected container
        document.getElementById(section).classList.remove('d-none');

        // Reset button styles
        document.getElementById('btnEmployees').classList.remove('btn-primary', 'active');
        document.getElementById('btnEmployees').classList.add('btn-secondary');
        document.getElementById('btnDrivers').classList.remove('btn-primary', 'active');
        document.getElementById('btnDrivers').classList.add('btn-secondary');

        // Set active button style
        btn.classList.remove('btn-secondary');
        btn.classList.add('btn-primary', 'active');
    }
</script>

</body>
</html>
