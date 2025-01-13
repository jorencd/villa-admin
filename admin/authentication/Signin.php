<?php
session_start();
include '../database/dbconnect.php';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['success'] = 'Login successful! Redirecting to dashboard...';
            $_SESSION['admin_id'] = $user['admin_id'];  // Maintain session state
        } else {
            $_SESSION['error'] = 'Invalid email or password';
        }
    } else {
        $_SESSION['error'] = 'Please enter a valid email and password';
    }

    header("Location: authentication.php");
    exit();
}
?>