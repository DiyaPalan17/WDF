
<?php
require_once "db.php";

$username = "admin";
$email = "admin@example.com";
$password = password_hash("Admin@123", PASSWORD_DEFAULT);
$role = "admin";

$sql = "INSERT INTO users (username, email, password, role)
        VALUES (:username, :email, :password, :role)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":username" => $username,
        ":email" => $email,
        ":password" => $password,
        ":role" => $role
    ]);

    echo "Admin account created successfully!";

} catch (PDOException $e) {
    echo "Admin account could not be created. It may already exist.";
}
?>
