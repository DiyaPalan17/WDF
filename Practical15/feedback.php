<?php
require_once __DIR__ . '/includes/bootstrap.php';
$errors = [];
$name = current_user()['name'] ?? '';
$email = current_user()['email'] ?? '';
$rating = '5';
$comments = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $rating = (string)($_POST['rating'] ?? '');
    $comments = trim((string)($_POST['comments'] ?? ''));
    if ($name === '' || mb_strlen($name) > 100) $errors[] = 'Enter your name (maximum 100 characters).';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) $errors[] = 'Enter a valid email address.';
    if (!in_array($rating, ['1','2','3','4','5'], true)) $errors[] = 'Choose a rating from 1 to 5.';
    if ($comments === '' || mb_strlen($comments) > 3000) $errors[] = 'Enter feedback (maximum 3000 characters).';
    if (!$errors) {
        $userId = current_user()['id'] ?? null;
        $stmt = $pdo->prepare('INSERT INTO feedback (user_id, name, email, rating, comments) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$userId, $name, $email, (int)$rating, $comments]);
        flash('Thank you! Your feedback has been submitted.');
        redirect('feedback.php');
    }
}
$pageTitle = 'Feedback';
require __DIR__ . '/includes/header.php';
?>
<section class="form-card">
  <h1>Share your feedback</h1>
  <p>Tell us what works well and what we can improve.</p>
  <?php foreach ($errors as $error): ?><p class="form-error"><?= e($error) ?></p><?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label for="name">Your name</label>
    <input id="name" name="name" maxlength="100" required value="<?= e($name) ?>">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" maxlength="190" required value="<?= e($email) ?>">
    <label for="rating">Rating</label>
    <select id="rating" name="rating" required>
      <option value="5" <?= $rating === '5' ? 'selected' : '' ?>>5 - Excellent</option>
      <option value="4" <?= $rating === '4' ? 'selected' : '' ?>>4 - Very good</option>
      <option value="3" <?= $rating === '3' ? 'selected' : '' ?>>3 - Good</option>
      <option value="2" <?= $rating === '2' ? 'selected' : '' ?>>2 - Needs improvement</option>
      <option value="1" <?= $rating === '1' ? 'selected' : '' ?>>1 - Poor</option>
    </select>
    <label for="comments">Your feedback</label>
    <textarea id="comments" name="comments" rows="5" maxlength="3000" required><?= e($comments) ?></textarea>
    <button class="button" type="submit">Submit feedback</button>
  </form>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
