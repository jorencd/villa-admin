<?php
session_start();

include '../database/dbconnect.php';
try {
    // Initialize PDO connection
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Input validation (basic example)
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        // Query to check if the email and password match in the admin table
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();

        // Verify email and password
        if ($user) {
            // Start session and redirect to dashboard if credentials are correct
            $_SESSION['admin_id'] = $user['admin_id']; // Use admin_id for session
            header("Location: ../../admin/dashboard/dashboard.php");
            exit();  // Ensure no further code is executed after redirection
        } else {
            // Either email or password is incorrect
            echo "<script>
            alert('Invalid email or password');
            window.location.href = 'authentication.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Please enter a valid email and password');
        window.location.href = 'authentication.php';
        </script>";
    }
}
