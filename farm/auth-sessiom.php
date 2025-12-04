<?php
session_start();

// Check if user is logged in
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: admin-dashboard.php");
        exit();
    }
}

// Check if user is admin
function requireAdmin() {
    requireLogin();
    
    if ($_SESSION['role'] !== 'admin') {
        // Optional: redirect to user dashboard instead
        header("Location: admin-dashboard.php");
        exit();
    }
}
?>
