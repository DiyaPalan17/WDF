<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Home';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <p class="eyebrow">StudentHub Portal</p>
  <h1>Your campus life, in one place.</h1>
  <p>Access your student dashboard, profile, and campus events.</p>
  <div class="actions">
    <?php if (current_user()): ?>
      <a class="button" href="dashboard.php">Open dashboard</a>
    <?php else: ?>
      <a class="button" href="register.php">Create account</a>
      <a class="button button-secondary" href="login.php">Log in</a>
    <?php endif; ?>
  </div>
</section>
<section class="panel">
  <h2>What you can do</h2>
  <div class="tiles">
    <article><h3>Student profile</h3><p>View your account details in one place.</p></article>
    <article><h3>Campus events</h3><p>Browse events and search the event list.</p></article>
    <article><h3>Secure access</h3><p>Sign in to access your personal dashboard.</p></article>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
