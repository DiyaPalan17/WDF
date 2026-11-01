<?php $pageTitle = $pageTitle ?? 'StudentHub'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> | StudentHub</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
  <a class="brand" href="index.php">StudentHub</a>
  <nav aria-label="Main navigation">
    <a href="index.php">Home</a>
    <a href="events.php">Events</a>
    <a href="contact.php">Contact</a>
    <a href="feedback.php">Feedback</a>
    <?php if (current_user()): ?>
      <a href="dashboard.php">Dashboard</a>
      <a href="profile.php">Profile</a>
      <form class="nav-form" action="logout.php" method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <button class="link-button" type="submit">Log out</button>
      </form>
    <?php else: ?>
      <a href="login.php">Log in</a>
      <a href="register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">
<?php if (!empty($_SESSION['flash'])): $notice = $_SESSION['flash']; unset($_SESSION['flash']); ?>
  <div class="notice <?= e($notice['type']) ?>" role="status"><?= e($notice['message']) ?></div>
<?php endif; ?>
