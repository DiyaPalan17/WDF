<?php
require_once __DIR__ . '/includes/bootstrap.php';
if (current_user()) redirect('dashboard.php');
$errors = [];
$name = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    if ($name === '' || mb_strlen($name) > 100) $errors[] = 'Enter a name (maximum 100 characters).';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters.';
    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) $errors[] = 'An account with this email already exists.';
    }
    if (!$errors) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, "student")');
        $stmt->execute([$name, $email, $hash]);
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => (int)$pdo->lastInsertId(), 'name' => $name, 'email' => $email, 'role' => 'student'];
        flash('Account created successfully.');
        redirect('dashboard.php');
    }
}
$pageTitle = 'Register';
require __DIR__ . '/includes/header.php';
?>
<section class="form-card">
  <h1>Create your account</h1>
  <?php foreach ($errors as $error): ?><p class="form-error"><?= e($error) ?></p><?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label for="name">Full name</label>
    <input id="name" name="name" maxlength="100" required value="<?= e($name) ?>">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" maxlength="190" required value="<?= e($email) ?>">
    <label for="password">Password (minimum 8 characters)</label>
    <input id="password" name="password" type="password" minlength="8" required autocomplete="new-password">
    <button class="button" type="submit">Register</button>
  </form>
  <p>Already registered? <a href="login.php">Log in</a>.</p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
