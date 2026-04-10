<?php
require_once '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $admin_key = $_POST['admin_key'];
    
    $stmt = $pdo->prepare("SELECT UserID, FullName, Email, Password, Role, admin_key FROM users WHERE Email = ? AND Role = 'admin'");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['Password'])) {
        // Verify admin key
        if (empty($user['admin_key']) || !password_verify($admin_key, $user['admin_key'])) {
            $_SESSION['error'] = 'Invalid admin security key';
            header('Location: ../index.php?error=admin');
            exit();
        }
        
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['user_name'] = $user['FullName'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_role'] = $user['Role'];
        
        header('Location: ../static/Admin/admin_dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid email, password, or you are not authorized as admin';
        header('Location: ../index.php?error=admin');
        exit();
    }
}
?>