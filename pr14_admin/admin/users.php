
<?php
require_once "../includes/auth.php";
require_once "../db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = filter_input(INPUT_POST, "user_id", FILTER_VALIDATE_INT);
    $newStatus = $_POST["status"] ?? "";

    if ($userId && in_array($newStatus, ["active", "inactive"], true)) {
        $stmt = $pdo->prepare(
            "SELECT id, username, role, status FROM users WHERE id = ?"
        );
        $stmt->execute([$userId]);
        $target = $stmt->fetch(PDO::FETCH_ASSOC);

        // Do not allow the current admin to deactivate their own account.
        if (!$target) {
            $message = "User not found.";
        } elseif ($userId === (int)$_SESSION["user_id"]
                  && $newStatus === "inactive") {
            $message = "You cannot deactivate your own account.";
        } elseif ($target["status"] !== $newStatus) {
            $stmt = $pdo->prepare(
                "UPDATE users SET status = ? WHERE id = ?"
            );
            $stmt->execute([$newStatus, $userId]);

            $stmt = $pdo->prepare(
                "INSERT INTO audit_logs (user_id, action, details, ip_address)
                 VALUES (?, 'USER_STATUS_CHANGED', ?, ?)"
            );
            $stmt->execute([
                $_SESSION["user_id"],
                "Changed user " . $target["username"] .
                " status from " . $target["status"] . " to " . $newStatus,
                $_SERVER["REMOTE_ADDR"] ?? null
            ]);

            $message = "User status updated successfully.";
        } else {
            $message = "User already has that status.";
        }
    } else {
        $message = "Invalid status request.";
    }
}

$users = $pdo->query(
    "SELECT id, username, email, role, status, created_at
     FROM users ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2>User Management</h2>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <?php if ($message !== ""): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= (int)$user["id"] ?></td>
                        <td><?= htmlspecialchars($user["username"]) ?></td>
                        <td><?= htmlspecialchars($user["email"]) ?></td>
                        <td><?= htmlspecialchars($user["role"]) ?></td>
                        <td><?= htmlspecialchars($user["status"]) ?></td>
                        <td>
                            <?php if ((int)$user["id"] !== (int)$_SESSION["user_id"]): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="user_id"
                                           value="<?= (int)$user["id"] ?>">
                                    <input type="hidden" name="status"
                                           value="<?= $user["status"] === "active" ? "inactive" : "active" ?>">
                                    <button class="btn btn-sm <?= $user["status"] === "active" ? "btn-danger" : "btn-success" ?>"
                                            type="submit">
                                        <?= $user["status"] === "active" ? "Deactivate" : "Activate" ?>
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Current account</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
