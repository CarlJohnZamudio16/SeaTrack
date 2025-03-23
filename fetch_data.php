<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "root"; // Change if using a different user
$password = ""; // Your MySQL password
$database = "fishing_boat_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Fetch data for dashboard statistics
$statsQuery = "
    SELECT 
        (SELECT COUNT(*) FROM boats) AS total_boats,
        (SELECT COUNT(*) FROM boats WHERE status = 'Active') AS active_licenses,
        (SELECT COUNT(DISTINCT owner_name) FROM boats) AS total_fishermen
";
$statsResult = $conn->query($statsQuery);
$statsData = $statsResult->fetch_assoc();

// Fetch total boats registered over time
$boatsOverTimeQuery = "
    SELECT YEAR(registration_date) AS year, COUNT(id) AS total 
    FROM boats 
    GROUP BY YEAR(registration_date) 
    ORDER BY year ASC
";
$result1 = $conn->query($boatsOverTimeQuery);
$boatsOverTime = ['labels' => [], 'data' => []];
while ($row = $result1->fetch_assoc()) {
    $boatsOverTime['labels'][] = $row['year'];
    $boatsOverTime['data'][] = $row['total'];
}

// Fetch license status counts
$licenseStatusQuery = "
    SELECT status, COUNT(id) AS total 
    FROM boats 
    GROUP BY status
";
$result2 = $conn->query($licenseStatusQuery);
$licenseStatus = ['labels' => [], 'data' => []];
while ($row = $result2->fetch_assoc()) {
    $licenseStatus['labels'][] = $row['status'];
    $licenseStatus['data'][] = $row['total'];
}

// Fetch boat types count
$boatTypesQuery = "
    SELECT boat_type, COUNT(id) AS total 
    FROM boats 
    GROUP BY boat_type
";
$result3 = $conn->query($boatTypesQuery);
$boatTypes = ['labels' => [], 'data' => []];
while ($row = $result3->fetch_assoc()) {
    $boatTypes['labels'][] = $row['boat_type'];
    $boatTypes['data'][] = $row['total'];
}

// Fetch fuel type usage
$fuelUsageQuery = "
    SELECT fuel_type, COUNT(id) AS total 
    FROM boats 
    GROUP BY fuel_type
";
$result4 = $conn->query($fuelUsageQuery);
$fuelUsage = ['labels' => [], 'data' => []];
while ($row = $result4->fetch_assoc()) {
    $fuelUsage['labels'][] = $row['fuel_type'];
    $fuelUsage['data'][] = $row['total'];
}

// Fetch boats data for display with search functionality
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$boatsQuery = "
    SELECT 
        boat_name, 
        registration_number, 
        owner_name, 
        contact_email, 
        registration_date, 
        status, 
        boat_type, 
        length, 
        hull_material, 
        year_built, 
        home_port, 
        crew_capacity, 
        engine_type, 
        engine_model, 
        power, 
        fuel_type, 
        fuel_capacity, 
        boat_equipment, 
        permit_details 
    FROM boats 
    WHERE 
        boat_name LIKE ? OR 
        owner_name LIKE ? OR 
        engine_model LIKE ? OR 
        registration_number LIKE ?
    ORDER BY id DESC
";

$stmt = $conn->prepare($boatsQuery);
$searchWildcard = "%" . $searchQuery . "%";
$stmt->bind_param('ssss', $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard);
$stmt->execute();
$result = $stmt->get_result();
$boats = [];

while ($row = $result->fetch_assoc()) {
    $row['boat_type'] = $row['boat_type'] ?? 'N/A';
    $row['length'] = $row['length'] ?? 'N/A';
    $row['hull_material'] = $row['hull_material'] ?? 'N/A';
    $row['year_built'] = $row['year_built'] ?? 'N/A';
    $row['home_port'] = $row['home_port'] ?? 'N/A';
    $row['crew_capacity'] = $row['crew_capacity'] ?? 'N/A';
    $row['engine_type'] = $row['engine_type'] ?? 'N/A';
    $row['engine_model'] = $row['engine_model'] ?? 'N/A';
    $row['power'] = $row['power'] ?? 'N/A';
    $row['fuel_type'] = $row['fuel_type'] ?? 'N/A';
    $row['fuel_capacity'] = $row['fuel_capacity'] ?? 'N/A';
    $row['boat_equipment'] = $row['boat_equipment'] ?? 'N/A';
    $row['permit_details'] = $row['permit_details'] ?? 'N/A';

    if (!empty($row['registration_date'])) {
        $regDate = new DateTime($row['registration_date']);
        $regDate->modify('+2 years'); // Add 2 years
        $row['license_expiry'] = $regDate->format('Y-m-d');
    } else {
        $row['license_expiry'] = 'N/A';
    }

    $boats[] = $row;
}

// Combine all data into one response
$response = array_merge($statsData, [
    "boatsOverTime" => $boatsOverTime,
    "licenseStatus" => $licenseStatus,
    "boatTypes" => $boatTypes,
    "fuelUsage" => $fuelUsage,
    "boats" => $boats
]);

echo json_encode($response);

// Close connections
$stmt->close();
$conn->close();
?>
