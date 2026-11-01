
<?php
require_once "../includes/auth.php";
require_once "../db.php";

$stmt = $pdo->query(
    "SELECT a.id, a.user_id, u.username, a.action,
            a.details, a.ip_address, a.created_at
     FROM audit_logs a
     LEFT JOIN users u ON a.user_id = u.id
     ORDER BY a.created_at DESC
     LIMIT 100"
);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Audit Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid py-4 px-4">
    <h2>Audit Logs</h2>
    <p class="text-muted">Recent administrative and user activities</p>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>IP Address</th>
                    <th>Date and Time</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= (int)$log["id"] ?></td>
                        <td><?= htmlspecialchars($log["username"] ?? "Deleted user") ?></td>
                        <td><?= htmlspecialchars($log["action"]) ?></td>
                        <td><?= htmlspecialchars($log["details"] ?? "") ?></td>
                        <td><?= htmlspecialchars($log["ip_address"] ?? "") ?></td>
                        <td><?= htmlspecialchars($log["created_at"]) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No audit records found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
