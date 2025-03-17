<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
          display: grid;
  grid-template-columns: repeat(3, 1fr); /* 3 columns per row */
  gap: 30px;
  padding: 20px;
  margin-left: 140px;
        }

        .maintenance-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 330px;
        }

        .maintenance-card img {
            width: 100%;
            max-height: 150px;
            object-fit: contain;
        }

        .maintenance-details {
            text-align: center;
        }

        .maintenance-details h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #333;
        }

        .maintenance-status {
            text-align: center;
        }

        .maintenance-status h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #333;
        }

        .schedule-maintenance, .edit-btn, .delete-btn {
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%;
            gap: 20px;
            margin-bottom: 10px; /* Add space below each button */

        }

        .schedule-maintenance {
            background: #000;
            color: white;
        }

        .schedule-maintenance:hover {
            background: #333;
        }

        .edit-btn {
            background: #007bff;
            color: white;
        }

        .edit-btn:hover {
            background: #0056b3;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .modal-header {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .modal-footer .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }

        .modal-footer .btn-primary:hover {
            background-color: #0056b3;
        }
        .maintenance-scheduled {
    border: 2px solid red; /* Add a red border */
    background-color: #ffe6e6; /* Light red background */
}
    </style>
</head>
<body>
<div class="container" id="content">
    <!-- Maintenance Card 1 -->
    <div class="maintenance-card" id="carCard1">
        <img src="image/c3.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Toyota Fortuner</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: Jan 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 45,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 5,000 km)<br>
                - Tire Rotation (Every 10,000 km)<br>
                - Brake Inspection (Every 15,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 30 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard1')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard1')">DELETE</button>
        </div>
    </div>

    <!-- Maintenance Card 2 -->
    <div class="maintenance-card" id="carCard2">
        <img src="image/c4.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Land Cruiser</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: Mar 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 30,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 7,000 km)<br>
                - Air Filter Replacement (Every 15,000 km)<br>
                - Spark Plug Replacement (Every 30,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 45 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard2')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard2')">DELETE</button>
        </div>
    </div>

    <!-- Maintenance Card 3 -->
    <div class="maintenance-card" id="carCard3">
        <img src="image/c5.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Toyota Hiace</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: Feb 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 25,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 8,000 km)<br>
                - Brake Pad Replacement (Every 20,000 km)<br>
                - Coolant Flush (Every 40,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 60 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard3')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard3')">DELETE</button>
        </div>
    </div>

    <!-- Maintenance Card 4 -->
    <div class="maintenance-card" id="carCard4">
        <img src="image/c6.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Hilux Conquest</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: Apr 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 50,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 6,000 km)<br>
                - Transmission Fluid Change (Every 50,000 km)<br>
                - Suspension Check (Every 25,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 15 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard4')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard4')">DELETE</button>
        </div>
    </div>

    <!-- Maintenance Card 5 -->
    <div class="maintenance-card" id="carCard5">
        <img src="image/c7.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Suzuki Jimny</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: May 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 35,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 10,000 km)<br>
                - Brake Fluid Replacement (Every 30,000 km)<br>
                - Battery Check (Every 20,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 10 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard5')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard5')">DELETE</button>
        </div>
    </div>

    <!-- Maintenance Card 6 -->
    <div class="maintenance-card" id="carCard6">
        <img src="image/c1.png" alt="Equipment">
        <div class="maintenance-details">
            <h2>Honda City</h2>
            <div class="features">
                <div class="feature-item">
                    <i class="fa-solid fa-calendar"></i> Last Serviced: Jun 2025
                </div>
                <div class="feature-item scheduled-date">
                    <i class="fa-solid fa-tools"></i> 
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-exclamation-triangle"></i> Status: Operational
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-clock"></i> Mileage: 40,000 km
                </div>
            </div>
            <p>
                <strong>Maintenance Tasks:</strong><br>
                - Oil Change (Every 7,500 km)<br>
                - Tire Alignment (Every 15,000 km)<br>
                - Engine Tune-Up (Every 25,000 km)
            </p>
        </div>
        <div class="maintenance-status">
            <h3>Due in: 20 Days</h3>
            <button class="schedule-maintenance" onclick="openModal('calendarModal', 'carCard6')">SCHEDULE NOW</button>
            <button class="edit-btn" onclick="openModal('editModal')">EDIT</button>
            <button class="delete-btn" onclick="deleteCard('carCard6')">DELETE</button>
        </div>
    </div>
</div>
</body>
    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Edit Maintenance Details</div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="lastServiced">Last Serviced:</label>
                        <input type="date" id="lastServiced" name="lastServiced" required>
                    </div>
                    <div class="mb-3">
                        <label for="nextMaintenance">Next Maintenance:</label>
                        <input type="date" id="nextMaintenance" name="nextMaintenance" required>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status:</label>
                        <select id="status" name="status">
                            <option value="Operational">Operational</option>
                            <option value="Needs Service">Needs Service</option>
                            <option value="Needs Inspection">Needs Inspection</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mileage">Mileage:</label>
                        <input type="number" id="mileage" name="mileage" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal('editModal')">Close</button>
                <button class="btn-primary" type="submit" form="editForm">Save changes</button>
            </div>
        </div>
    </div>

    <!-- Calendar Modal -->
    <div id="calendarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Schedule Maintenance</div>
            <div class="modal-body">
                <input type="date" id="sched" name="sched" required>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal('calendarModal')">Close</button>
                <button class="btn-primary" onclick="confirmSchedule()">Confirm</button>
            </div>
        </div>
    </div>

   
</body>
</html>