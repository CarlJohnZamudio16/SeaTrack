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
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch dashboard statistics
$statsQuery = "
    SELECT 
        (SELECT COUNT(*) FROM boats) AS total_boats,
        (SELECT COUNT(*) FROM boats WHERE status = 'Active') AS active_licenses,
        (SELECT COUNT(DISTINCT owner_name) FROM boats) AS total_fishermen
";
$statsResult = $conn->query($statsQuery);
$statsData = $statsResult->fetch_assoc() ?? [];

// Fetch total boats registered over time (for Line Chart)
$boatsOverTimeQuery = "
    SELECT YEAR(registration_date) AS year, COUNT(id) AS total 
    FROM boats 
    WHERE registration_date IS NOT NULL
    GROUP BY YEAR(registration_date) 
    ORDER BY year ASC
";
$boatsOverTime = fetchData($conn, $boatsOverTimeQuery, 'year', 'total');

// Fetch license status counts (for Pie Chart)
$licenseStatusQuery = "
    SELECT status, COUNT(id) AS total 
    FROM boats 
    GROUP BY status
";
$licenseStatus = fetchData($conn, $licenseStatusQuery, 'status', 'total');

// Fetch boat types count (for Bar Chart)
$boatTypesQuery = "
    SELECT boat_type, COUNT(id) AS total 
    FROM boats 
    WHERE boat_type IS NOT NULL
    GROUP BY boat_type
";
$boatTypes = fetchData($conn, $boatTypesQuery, 'boat_type', 'total');

// Fetch fuel type usage (for Doughnut Chart)
$fuelUsageQuery = "
    SELECT fuel_type, COUNT(id) AS total 
    FROM boats 
    WHERE fuel_type IS NOT NULL
    GROUP BY fuel_type
";
$fuelUsage = fetchData($conn, $fuelUsageQuery, 'fuel_type', 'total');

// Combine all data into one response
$response = array_merge($statsData, [
    "charts" => [
        "boatsOverTime" => $boatsOverTime,
        "licenseStatus" => $licenseStatus,
        "boatTypes" => $boatTypes,
        "fuelUsage" => $fuelUsage
    ]
]);

echo json_encode($response);

// Close connections
$conn->close();

/**
 * Helper function to fetch chart data
 */
function fetchData($conn, $query, $labelColumn, $dataColumn)
{
    $result = $conn->query($query);
    $data = ['labels' => [], 'data' => []];

    while ($row = $result->fetch_assoc()) {
        $data['labels'][] = $row[$labelColumn];
        $data['data'][] = $row[$dataColumn];
    }

    return $data;
}
?>
