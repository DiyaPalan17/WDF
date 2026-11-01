<?php
require_once __DIR__ . '/includes/bootstrap.php';
$errors = [];
$name = '';
$email = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $message = trim((string)($_POST['message'] ?? ''));
    if ($name === '' || mb_strlen($name) > 100) $errors[] = 'Enter your name (maximum 100 characters).';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) $errors[] = 'Enter a valid email address.';
    if ($message === '' || mb_strlen($message) > 3000) $errors[] = 'Enter a message (maximum 3000 characters).';
    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $message]);
        flash('Your message has been submitted successfully.');
        redirect('contact.php');
    }
}
$pageTitle = 'Contact';
require __DIR__ . '/includes/header.php';
?>
<section class="form-card">
  <h1>Contact StudentHub</h1>
  <p>Send us a question or report a problem using the form below.</p>
  <?php foreach ($errors as $error): ?><p class="form-error"><?= e($error) ?></p><?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label for="name">Your name</label>
    <input id="name" name="name" maxlength="100" required value="<?= e($name) ?>">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" maxlength="190" required value="<?= e($email) ?>">
    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5" maxlength="3000" required><?= e($message) ?></textarea>
    <button class="button" type="submit">Send message</button>
  </form>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
