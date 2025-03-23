<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Secure hash

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email already exists. Please use another email.";
    } else {
        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $password);

        if ($stmt->execute()) {
            echo "<script>
                alert('Account created successfully! You can now log in.');
                window.location.href = 'login.php';
            </script>";
            exit();
        }
        

        $stmt->close();
    }

    $checkEmail->close();
    $conn->close();
}
?>
