<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "root";
$password = "";
$database = "fishing_boat_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Auto-generate registration number
function generateRegNumber() {
    $randomNum = rand(1000, 9999); // Generate random number
    $year = date("Y"); // Get current year
    return "FV-" . $year . $randomNum; // Format the registration number
}

// Prepare the data from the form
$boatName = $_POST['boatName'];
$ownerName = $_POST['ownerName'];
$contact = $_POST['contact'];
$boatType = $_POST['boatType'];
$length = $_POST['length'];
$hullMaterial = $_POST['hullMaterial'];
$yearBuilt = $_POST['yearBuilt'];
$homePort = $_POST['homePort'];
$crewCapacity = $_POST['crewCapacity'];
$status = $_POST['status'];
$registrationDate = $_POST['registrationDate'];
$engineType = $_POST['engineType'];
$engineModel = $_POST['engineModel'];
$power = $_POST['power'];
$fuelType = $_POST['fuelType'];
$fuelCapacity = $_POST['fuelCapacity'];
$boatEquipment = $_POST['boatEquipment'];
$permitDetails = $_POST['permitDetails'];

// Auto-generate registration number if not provided
$registrationNumber = isset($_POST['registrationNumber']) ? $_POST['registrationNumber'] : generateRegNumber();

// Insert the boat data into the database
$query = "INSERT INTO boats (boat_name, registration_number, owner_name, contact_email, boat_type, length, 
                            hull_material, year_built, home_port, crew_capacity, status, registration_date, 
                            engine_type, engine_model, power, fuel_type, fuel_capacity, boat_equipment, permit_details) 
          VALUES ('$boatName', '$registrationNumber', '$ownerName', '$contact', '$boatType', '$length', 
                  '$hullMaterial', '$yearBuilt', '$homePort', '$crewCapacity', '$status', '$registrationDate', 
                  '$engineType', '$engineModel', '$power', '$fuelType', '$fuelCapacity', '$boatEquipment', '$permitDetails')";

if ($conn->query($query) === TRUE) {
    echo "Boat registered successfully. Registration Number: $registrationNumber";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
