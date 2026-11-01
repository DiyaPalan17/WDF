
<?php
require_once "../includes/auth.php";
require_once "../db.php";

$stmt = $pdo->query(
    "SELECT id, title, description, event_date, created_at
     FROM events
     ORDER BY id DESC"
);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2>Manage Events</h2>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event Title</th>
                        <th>Description</th>
                        <th>Event Date</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= (int)$event["id"] ?></td>
                        <td><?= htmlspecialchars($event["title"]) ?></td>
                        <td><?= htmlspecialchars($event["description"] ?? "") ?></td>
                        <td><?= htmlspecialchars($event["event_date"] ?? "") ?></td>
                        <td><?= htmlspecialchars($event["created_at"]) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            No events found.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
