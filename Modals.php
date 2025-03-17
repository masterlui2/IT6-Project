<!--------------------------- Add Employee --------------------------->
<!--------------------------- Add Employee --------------------------->
<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="AddEmployeeQuery.php" method="POST">
                    
                    <!-- Success Message -->
                    <div id="successMessage" class="alert alert-success d-none">
                        Employee added successfully!
                    </div>
                            
                    <!-- Input Fields -->
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="HR">HR</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary (₱)</label>
                        <input type="number" class="form-control" id="salary" name="salary" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Add Employee</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<!--------------------------- Add Employee Script --------------------------->
<!--------------------------- Add Employee Script --------------------------->
<!--------------------------- Add Employee Script --------------------------->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const addEmployeeForm = document.getElementById("addEmployeeForm");
    const addEmployeeModalEl = document.getElementById("addEmployeeModal");
    const addEmployeeModal = new bootstrap.Modal(addEmployeeModalEl);

    addEmployeeForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(addEmployeeForm);

        fetch("AddEmployeeQuery.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                addEmployeeForm.reset();
                addEmployeeModal.hide();
                location.reload(); // Reload to update the employee list
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });
});
</script>

<!--------------------------- Edit Employee --------------------------->
<!--------------------------- Edit Employee --------------------------->
<!--------------------------- Edit Employee --------------------------->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" novalidate>
                    <input type="hidden" id="employeeId" name="employeeid">

                    <label for="editFullname">Full Name</label>
                    <input type="text" id="editFullname" name="fullname" class="form-control mb-2" required>

                    <label for="editPhone">Contact</label>
                    <input type="text" id="editPhone" name="contactno" class="form-control mb-2" required>

                    <label for="editEmail">Email</label>
                    <input type="email" id="editEmail" name="email" class="form-control mb-2" required>

                    <label for="editAddress">Address</label>
                    <input type="text" id="editAddress" name="address" class="form-control mb-2" required>

                    <label for="editRole">Role</label>
                    <input type="text" id="editRole" name="role" class="form-control mb-2" required>

                    <label for="editPassword">New Password (Leave blank to keep unchanged)</label>
                    <input type="password" id="editPassword" name="password" class="form-control mb-2">

                    <label for="editSalary">Salary (₱)</label>
                    <input type="number" step="0.01" id="editSalary" name="salary" class="form-control mb-2" required>

                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="Deactivated">
                        <input class="form-check-input" type="checkbox" id="editStatus" name="status" value="Active">
                        <label class="form-check-label" for="editStatus">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------------------- Edit Employee Script --------------------------->
<!--------------------------- Edit Employee Script --------------------------->
<!--------------------------- Edit Employee Script --------------------------->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const editEmployeeForm = document.getElementById("editEmployeeForm");
    const editEmployeeModalEl = document.getElementById("editEmployeeModal");
    const editEmployeeModal = new bootstrap.Modal(editEmployeeModalEl);

    // Submit form via AJAX
    editEmployeeForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(editEmployeeForm);
        formData.set("status", document.getElementById("editStatus").checked ? "Active" : "Deactivated");

        fetch("EditEmployeeQuery.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json().catch(() => response.text()))
        .then(data => {
            console.log("Server Response:", data);

            if (typeof data === "string") {
                alert("❌ Error: Received invalid JSON response. Check console.");
                console.error("Invalid JSON Response:", data);
                return;
            }

            alert(data.message);

            if (data.status === "success") {
                editEmployeeForm.reset();
                editEmployeeModal.hide();
                setTimeout(() => location.reload(), 500);
            }
        })
        .catch(error => {
            console.error("❌ Fetch Error:", error);
            alert("❌ Update failed. Check console for details.");
        });
    });

    // Function to load vehicle data into the modal
    window.loadEditEmployee = function(employee) {
        if (!employee || typeof employee !== "object") {
            console.error("❌ Invalid employee data received:", employee);
            alert("❌ Error loading employee data. Check console.");
            return;
        }

        document.getElementById("employeeId").value = employee.employeeid || "";
        document.getElementById("editFullname").value = employee.fullname || "";
        document.getElementById("editPhone").value = employee.contactno || "";
        document.getElementById("editEmail").value = employee.email || "";
        document.getElementById("editAddress").value = employee.address || "";
        document.getElementById("editRole").value = employee.role || "";
        document.getElementById("editSalary").value = employee.salary || "";

        document.getElementById("editStatus").checked = (employee.status || "").toLowerCase() === "active";

        editEmployeeModal.show();
    };
});
</script>

<!--------------------------- Add Driver --------------------------->
<!--------------------------- Add Driver --------------------------->
<!--------------------------- Add Driver --------------------------->
<div class="modal fade" id="addDriverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addDriverForm">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" class="form-control mb-2" required>

                    <label for="contactno">Contact Number</label>
                    <input type="text" id="contactno" name="contactno" class="form-control mb-2">

                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control mb-2" required>

                    <label for="licenseno">License Number</label>
                    <input type="text" id="licenseno" name="licenseno" class="form-control mb-2" required>

                    <label for="yrofexp">Years of Experience</label>
                    <input type="number" id="yrofexp" name="yrofexp" class="form-control mb-2" required>

                    <label for="comrate">Commission Rate (₱)</label>
                    <input type="number" step="0.01" id="comrate" name="comrate" class="form-control mb-2" required>

                    <input type="hidden" name="dateadded" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="status" value="Active">

                    <button type="submit" class="btn btn-success">Add Driver</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------------------- Add Driver Script --------------------------->
<!--------------------------- Add Driver Script --------------------------->
<!--------------------------- Add Driver Script --------------------------->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const addDriverForm = document.getElementById("addDriverForm");
    const addDriverModalEl = document.getElementById("addDriverModal");
    const addDriverModal = new bootstrap.Modal(addDriverModalEl);

    addDriverForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(addDriverForm);

        fetch("AddDriverQuery.php", { // Updated endpoint
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Driver added successfully!");
                addDriverForm.reset();
                addDriverModal.hide();
                location.reload(); // Reload to update the driver list
            } else {
                alert("Failed to add driver: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });
});
</script>

<!--------------------------- Edit Driver --------------------------->
<!--------------------------- Edit Driver --------------------------->
<!--------------------------- Edit Driver --------------------------->
<div class="modal fade" id="editDriverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editDriverForm" novalidate>
                    <input type="hidden" id="driverId" name="driverid">

                    <label for="editFullname">Full Name</label>
                    <input type="text" id="editFullname" name="fullname" class="form-control mb-2" required>

                    <label for="editContactno">Contact Number</label>
                    <input type="text" id="editContactno" name="contactno" class="form-control mb-2">

                    <label for="editAddress">Address</label>
                    <input type="text" id="editAddress" name="address" class="form-control mb-2" required>

                    <label for="editLicenseno">License Number</label>
                    <input type="text" id="editLicenseno" name="licenseno" class="form-control mb-2" required>

                    <label for="editYrofexp">Years of Experience</label>
                    <input type="number" id="editYrofexp" name="yrofexp" class="form-control mb-2" required>

                    <label for="editComrate">Commission Rate (₱)</label>
                    <input type="number" step="0.01" id="editComrate" name="comrate" class="form-control mb-2" required>

                    <input type="hidden" name="dateadded" value="<?php echo date('Y-m-d H:i:s'); ?>">

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="editStatus" name="status">
                        <label class="form-check-label" for="editStatus">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Update Driver</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--------------------------- Edit Driver Script --------------------------->
<!--------------------------- Edit Driver Script --------------------------->
<!--------------------------- Edit Driver Script --------------------------->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editDriverForm = document.getElementById("editDriverForm");
        const editDriverModalEl = document.getElementById("editDriverModal");

        // Submit form via AJAX
        editDriverForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(editDriverForm);
            formData.set("status", document.getElementById("editStatus").checked ? "Active" : "Deactivated");

            fetch("EditDriverQuery.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json().catch(() => response.text()))
            .then(data => {
                console.log("Server Response:", data);

                if (typeof data === "string") {
                    alert("❌ Error: Received invalid JSON response. Check console.");
                    console.error("Invalid JSON Response:", data);
                    return;
                }

                alert(data.message);

                if (data.status === "success") {
                    editDriverForm.reset();
                    const editDriverModal = bootstrap.Modal.getInstance(editDriverModalEl);
                    editDriverModal.hide();
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(error => {
                console.error("❌ Fetch Error:", error);
                alert("❌ Update failed. Check console for details.");
            });
        });

        // Function to load driver data into the modal
        window.loadEditDriver = function(driver) {
            if (!driver || typeof driver !== "object") {
                console.error("❌ Invalid driver data received:", driver);
                alert("❌ Error loading driver data. Check console.");
                return;
            }

            // Populate fields safely
            document.getElementById("driverId").value = driver.driverid || "";
            document.getElementById("editFullname").value = driver.fullname || "";
            document.getElementById("editContactno").value = driver.contactno || "";
            document.getElementById("editAddress").value = driver.address || "";
            document.getElementById("editLicenseno").value = driver.licenseno || "";
            document.getElementById("editYrofexp").value = driver.yrofexp || "";
            document.getElementById("editComrate").value = driver.comrate || "";

            // Fix status switch
            const editStatus = document.getElementById("editStatus");
            editStatus.checked = (driver.status && driver.status.toLowerCase() === "active");

            // Ensure modal is properly initialized and displayed
            const editDriverModal = bootstrap.Modal.getOrCreateInstance(editDriverModalEl);
            editDriverModal.show();
        };
    });
</script>