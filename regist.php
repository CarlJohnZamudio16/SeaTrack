
<?php session_start(); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishing Boat Registration System</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sea<span class="track">Track</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index1.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="regist.php">Register Boat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="analytics.php">Analytics</a>
        </li>
      </ul>
      <form class="d-flex" role="search" id="searchForm">
        <input class="form-control me-2" type="search" placeholder="Search by name, registration, or engine" aria-label="Search" id="searchInput">
        <button class="btn btn-outline-danger" type="submit">Search</button>
      </form>

      <!-- Logout Button (Only If User is Logged In) -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="login.php" class="btn btn-outline-danger ms-3"><i class="fas fa-power-off"></i></a>
      <?php endif; ?>
    </div>
  </div>
</nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Total Registered Boats</h3>
                        <p id="total-boats">Loading...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Active Licenses</h3>
                        <p id="active-licenses">Loading...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Registered Fishermen</h3>
                        <p id="total-fishermen">Loading...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Boat List Section -->
            <div class="col-md-4">
                <div class="card">
                    <h2 class="card-header">Registered Boats</h2>
                    <div class="boat-list p-3" id="boat-list">
                        <p>Loading boat data...</p>
                    </div>
                </div>
            </div>

            <!-- Boat Registration Form Section -->
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Register New Boat</h2>
                    <div class="card-body">
                        <form id="boatForm" action="register_boat.php" method="POST">
                            <!-- OWNER DETAILS SECTION -->
                            <h4 class="text-primary">Owner Details</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="registrationNumber" class="form-label">Registration Number:</label>
                                    <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="ownerName" class="form-label">Owner's Name:</label>
                                    <input type="text" class="form-control" id="ownerName" name="ownerName" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="contact" class="form-label">Contact Email:</label>
                                    <input type="email" class="form-control" id="contact" name="contact">
                                </div>
                            </div>

                            <!-- BOAT DETAILS SECTION -->
                            <hr>
                            <h4 class="text-primary">Boat Details</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="boatName" class="form-label">Boat Name:</label>
                                    <input type="text" class="form-control" id="boatName" name="boatName" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="boatType" class="form-label">Boat Type:</label>
                                    <input type="text" class="form-control" id="boatType" name="boatType" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="length" class="form-label">Boat Length (meters):</label>
                                    <input type="number" step="0.1" class="form-control" id="length" name="length" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="hullMaterial" class="form-label">Hull Material:</label>
                                    <input type="text" class="form-control" id="hullMaterial" name="hullMaterial" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="yearBuilt" class="form-label">Year Built:</label>
                                    <input type="number" class="form-control" id="yearBuilt" name="yearBuilt" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="homePort" class="form-label">Home Port:</label>
                                    <input type="text" class="form-control" id="homePort" name="homePort" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="crewCapacity" class="form-label">Crew Capacity:</label>
                                    <input type="number" class="form-control" id="crewCapacity" name="crewCapacity" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="registrationDate" class="form-label">Registration Date:</label>
                                    <input type="date" class="form-control" id="registrationDate" name="registrationDate" required>
                                </div>
                            </div>

                            <!-- EQUIPMENT & LICENSE SECTION -->
                            <hr>
                            <h4 class="text-primary">Equipment & License</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="engineType" class="form-label">Engine Type:</label>
                                    <input type="text" class="form-control" id="engineType" name="engineType" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="engineModel" class="form-label">Engine Model:</label>
                                    <input type="text" class="form-control" id="engineModel" name="engineModel" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="power" class="form-label">Power (HP):</label>
                                    <input type="number" class="form-control" id="power" name="power" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="fuelType" class="form-label">Fuel Type:</label>
                                    <input type="text" class="form-control" id="fuelType" name="fuelType" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="fuelCapacity" class="form-label">Fuel Capacity (liters):</label>
                                    <input type="number" class="form-control" id="fuelCapacity" name="fuelCapacity" required>
                                </div>
                                <div class="col-12">
                                    <label for="boatEquipment" class="form-label">List of Equipment:</label>
                                    <textarea class="form-control" id="boatEquipment" name="boatEquipment" rows="3" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="permitDetails" class="form-label">Permit Details:</label>
                                    <textarea class="form-control" id="permitDetails" name="permitDetails" rows="3" required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-5 w-50">Register Boat</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
