<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();
$stmt = $pdo->prepare('SELECT name, email, created_at FROM users WHERE id = ?');
$stmt->execute([current_user()['id']]);
$profile = $stmt->fetch();
$pageTitle = 'Profile';
require __DIR__ . '/includes/header.php';
?>
<h1>My profile</h1>
<section class="panel profile">
  <p><strong>Name:</strong> <?= e($profile['name']) ?></p>
  <p><strong>Email:</strong> <?= e($profile['email']) ?></p>
  <p><strong>Member since:</strong> <?= e(date('d M Y', strtotime($profile['created_at']))) ?></p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
