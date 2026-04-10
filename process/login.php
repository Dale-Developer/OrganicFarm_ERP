<?php
require_once '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'customer';
    
    $stmt = $pdo->prepare("SELECT UserID, FullName, Email, Password, Role FROM users WHERE Email = ? AND Role = ?");
    $stmt->execute([$email, $role]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['user_name'] = $user['FullName'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_role'] = $user['Role'];
        
        header('Location: ../static/Customer/customer_dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: ../index.php?error=login');
        exit();
    }
}
?>