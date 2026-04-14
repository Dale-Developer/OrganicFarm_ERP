<?php
require_once '../config/config.php';
session_start();

// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $admin_key = $_POST['admin_key'];
    
    // First, let's see what's in the database
    $stmt = $pdo->prepare("SELECT UserID, FullName, Email, Password, Role, admin_key FROM users WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if (!$user) {
        $_SESSION['error'] = 'User not found';
        header('Location: ../index.php?error=admin');
        exit();
    }
    
    // Check if role is Admin (case sensitive)
    if ($user['Role'] !== 'Admin') {
        $_SESSION['error'] = 'Not an admin account. Your role: ' . $user['Role'];
        header('Location: ../index.php?error=admin');
        exit();
    }
    
    // Verify password
    if (!password_verify($password, $user['Password'])) {
        $_SESSION['error'] = 'Wrong password';
        header('Location: ../index.php?error=admin');
        exit();
    }
    
    // Verify admin key
    if (empty($user['admin_key'])) {
        $_SESSION['error'] = 'No admin key set for this account';
        header('Location: ../index.php?error=admin');
        exit();
    }
    
    if (!password_verify($admin_key, $user['admin_key'])) {
        $_SESSION['error'] = 'Wrong admin security key';
        header('Location: ../index.php?error=admin');
        exit();
    }
    
    // Set session variables
    $_SESSION['user_id'] = $user['UserID'];
    $_SESSION['user_name'] = $user['FullName'];
    $_SESSION['user_email'] = $user['Email'];
    $_SESSION['user_role'] = $user['Role'];
    $_SESSION['logged_in'] = true;
    
    // Redirect to admin dashboard
    header('Location: ../static/Admin/admin_dashboard.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
<!-- ACCOUNT
 Admin
 admin@gmail.com
 Admin12345!
 Admin12345! -->