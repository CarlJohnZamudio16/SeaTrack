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
    <!-- Chart.js -->
    <script src="js/chart.umd.js"></script>
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
          <a class="nav-link" aria-current="page" href="regist.php">Register Boat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="analytics.php">Analytics</a>
        </li>
      </ul>
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

    <!-- Analytics Section -->
    <div id="analytics" class="mt-4">
    <h2>Analytics Dashboard</h2>
    
    <div class="row">
      <div class="col-md-6">
        <div class="card m-4">
          <div class="card-body">
            <h5 class="card-title">Boats Registered Over Time</h5>
            <canvas id="boatsOverTime"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card m-4">
          <div class="card-body">
            <h5 class="card-title">License Status</h5>
            <canvas id="licenseStatus"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card m-4">
          <div class="card-body">
            <h5 class="card-title">Boat Types</h5>
            <canvas id="boatTypes"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card m-4">
          <div class="card-body">
            <h5 class="card-title">Fuel Usage</h5>
            <canvas id="fuelUsage"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
const ctx1 = document.getElementById('boatsOverTime').getContext('2d');
const boatsOverTime = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['2020', '2021', '2022', '2023', '2024'],
        datasets: [{
            label: 'Total Boats Registered',
            data: [50, 120, 200, 320, 450],
            borderColor: 'blue',
            borderWidth: 2
        }]
    }
});

const ctx2 = document.getElementById('licenseStatus').getContext('2d');
const licenseStatus = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Active', 'Expired'],
        datasets: [{
            data: [300, 150],
            backgroundColor: ['green', 'red']
        }]
    }
});

const ctx3 = document.getElementById('boatTypes').getContext('2d');
const boatTypes = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Motorboat', 'Sailboat', 'Fishing Vessel'],
        datasets: [{
            label: 'Number of Boats',
            data: [180, 90, 230],
            backgroundColor: ['blue', 'orange', 'gray']
        }]
    }
});

const ctx4 = document.getElementById('fuelUsage').getContext('2d');
const fuelUsage = new Chart(ctx4, {
    type: 'doughnut',
    data: {
        labels: ['Diesel', 'Gasoline', 'Electric'],
        datasets: [{
            data: [250, 180, 70],
            backgroundColor: ['purple', 'yellow', 'green']
        }]
    }
});
</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

<!-- Analytics Script (Only for Analytics Page) -->
<script src="js/analytics.js"></script>


</body>
</html>
