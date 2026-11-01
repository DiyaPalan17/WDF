
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check whether the user is logged in
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"])) {
    header("Location: /pr14_admin/login.php");
    exit;
}

// Allow only admin users
if ($_SESSION["role"] !== "admin") {
    http_response_code(403);
    exit("Access Denied: Admins only.");
}
?>
