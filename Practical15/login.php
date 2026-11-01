<?php
require_once __DIR__ . '/includes/bootstrap.php';
if (current_user()) redirect('dashboard.php');
$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    $stmt = $pdo->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        unset($user['password_hash']);
        $_SESSION['user'] = $user;
        flash('Welcome back.');
        redirect('dashboard.php');
    }
    $error = 'Email or password is incorrect.';
}
$pageTitle = 'Log in';
require __DIR__ . '/includes/header.php';
?>
<section class="form-card">
  <h1>Log in</h1>
  <?php if ($error): ?><p class="form-error" role="alert"><?= e($error) ?></p><?php endif; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" required autocomplete="email" value="<?= e($email) ?>">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" required autocomplete="current-password">
    <button class="button" type="submit">Log in</button>
  </form>
  <p>New to StudentHub? <a href="register.php">Register</a>.</p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
