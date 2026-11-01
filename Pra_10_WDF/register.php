<?php

require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
    $role = $_POST["role"] ?? "";

    if (
        $username === "" ||
        $email === "" ||
        $password === "" ||
        $confirm_password === "" ||
        $role === ""
    ) {
        $error = "All fields are required.";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    }

    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    }

    elseif ($role !== "student" && $role !== "admin") {
        $error = "Please select Student or Admin.";
    }

    else {

        // Check whether email already exists
        $stmt = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        if (!$stmt) {
            die("Database error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $error = "Email already registered.";

        } else {

            // Hash password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Insert new user
            $insert = $conn->prepare(
                "INSERT INTO users
                (username, email, password, role)
                VALUES (?, ?, ?, ?)"
            );

            $insert->bind_param(
                "ssss",
                $username,
                $email,
                $hashed_password,
                $role
            );

            if ($insert->execute()) {

                header(
                    "Location: login.php?message=Registration successful. Please login."
                );

                exit;

            } else {

                $error = "Registration failed: " . $insert->error;
            }

            $insert->close();
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Register</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Register</h2>

    <?php

    if ($error !== "") {

        echo "<p class='error'>"
             . htmlspecialchars($error)
             . "</p>";

    }

    ?>

    <form method="POST" action="register.php">

        <label>Username:</label>

        <input
            type="text"
            name="username"
            required
        >

        <label>Email:</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Password:</label>

        <input
            type="password"
            name="password"
            required
        >

        <label>Confirm Password:</label>

        <input
            type="password"
            name="confirm_password"
            required
        >

        <label>Role:</label>

        <select name="role" required>

            <option value="">Select Role</option>

            <option value="student">
                Student
            </option>

            <option value="admin">
                Admin
            </option>

        </select>

        <button type="submit">
            Register
        </button>

    </form>

    <p>
        Already have an account?

        <a href="login.php">
            Login
        </a>
    </p>

</div>

</body>

</html>