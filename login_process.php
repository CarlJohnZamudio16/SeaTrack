<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Get user by email
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $fullName, $hashedPassword);
    
    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $fullName;
            header("Location: index1.php"); // Redirect to dashboard
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>
