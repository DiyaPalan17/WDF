<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Secure Login</h2>

    <?php
    if (isset($_GET["error"])) {
        echo "<p class='error'>" . htmlspecialchars($_GET["error"]) . "</p>";
    }

    if (isset($_GET["message"])) {
        echo "<p class='success'>" . htmlspecialchars($_GET["message"]) . "</p>";
    }
    ?>

    <form action="authenticate.php" method="POST">

        <label>Email:</label>
        <input
            type="email"
            name="email"
            required
        >

        <label>Password:</label>
        <label>
    <input type="checkbox" name="remember_me" value="1">
    Remember Me
    </label>
        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">Login</button>

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</div>

</body>
</html>