<?php
require_once '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    
    $errors = [];
    
    if (empty($fullname)) {
        $errors[] = 'Full name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters';
    }
    
    // Check if email already exists
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT UserID FROM users WHERE Email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email already registered';
        }
    }
    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'customer'; // Default role for new signups
        
        // Insert using your actual column names
        $stmt = $pdo->prepare("INSERT INTO users (FullName, Email, PhoneNumber, Address, Password, Role) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$fullname, $email, $phone, $address, $hashed_password, $role])) {
            $_SESSION['success'] = 'Account created successfully! Please login.';
            header('Location: ../index.php?success=signup');
            exit();
        } else {
            $_SESSION['error'] = 'Registration failed. Please try again.';
            header('Location: ../index.php?error=signup');
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: ../index.php?error=signup');
        exit();
    }
}
?>