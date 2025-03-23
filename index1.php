<?php session_start(); ?>
<!DOCTYPE html>
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
          <a class="nav-link active" aria-current="page" href="index1.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="regist.php">Register Boat</a>
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
    <div class="col-md-4">
      <div class="card">
        <h2 class="card-header">Registered Boats</h2>
        <div class="boat-list p-3" id="boat-list">
          <p>Loading boat data...</p>
        </div>
        <button class="btn btn-primary register-btn m-3" onclick="window.location.href='regist.php';">Register New Boat</button>
      </div>
    </div>

    <!-- Boat Details Section -->
    <div class="col-md-8">
      <div class="card">
        <h2 class="card-header">Boat Details</h2>
        <div class="card-body">
          <div class="detail-section">
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Name:</div>
              <div id="boat-name"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Registration Number:</div>
              <div id="boat-registration"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Owner:</div>
              <div id="boat-owner"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Status:</div>
              <div id="boat-status" class="status pending"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Boat Type:</div>
              <div id="boat-type"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Length:</div>
              <div id="boat-length"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Hull Material:</div>
              <div id="boat-material"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Year Built:</div>
              <div id="boat-year"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Home Port:</div>
              <div id="boat-port"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Crew Capacity:</div>
              <div id="boat-crew"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Engine:</div>
              <div id="boat-engine"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Fuel Type:</div>
              <div id="boat-fuel"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">Fuel Capacity:</div>
              <div id="boat-fuel-capacity"></div>
            </div>
            <!-- License Expiry Section -->
            <div class="info-row mb-2">
              <div class="info-label fw-bold">License Expiry:</div>
              <div id="boat-license-expiry"></div>
            </div>
            <div class="info-row mb-2">
              <div class="info-label fw-bold">License Status:</div>
              <div id="boat-license-status" class="status"></div>
            </div>
          </div>

          <!-- Tabs for Equipment and Permit -->
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/script.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
