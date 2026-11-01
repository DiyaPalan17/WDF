<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();
$pageTitle = 'Dashboard';
require __DIR__ . '/includes/header.php';
?>
<h1>Welcome, <?= e(current_user()['name']) ?>!</h1>
<p class="lead">This is your StudentHub dashboard.</p>
<div class="tiles">
  <article class="panel"><h2>My profile</h2><p>Review your student account information.</p><a href="profile.php">View profile →</a></article>
  <article class="panel"><h2>Campus events</h2><p>Browse upcoming campus activities.</p><a href="events.php">Explore events →</a></article>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
