
<?php
require_once "includes/auth.php";
require_once "db.php";

// Get dashboard statistics
$totalUsers = (int) $pdo->query(
    "SELECT COUNT(*) FROM users"
)->fetchColumn();

$totalStudents = (int) $pdo->query(
    "SELECT COUNT(*) FROM students"
)->fetchColumn();

$totalEvents = (int) $pdo->query(
    "SELECT COUNT(*) FROM events"
)->fetchColumn();

$totalRegistrations = (int) $pdo->query(
    "SELECT COUNT(*) FROM registrations"
)->fetchColumn();

// Get latest registrations
$sql = "SELECT r.registered_at, u.username, e.title
        FROM registrations r
        JOIN users u ON r.user_id = u.id
        JOIN events e ON r.event_id = e.id
        ORDER BY r.registered_at DESC
        LIMIT 5";

$latestRegistrations = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Practical 14</title>
    <?php require_once "includes/menu.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Practical 14 Admin</a>
        <div class="text-white">
            Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>
            <a href="logout.php" class="btn btn-outline-light btn-sm ms-3">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6>Total Users</h6>
                    <h2><?= $totalUsers ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h6>Total Students</h6>
                    <h2><?= $totalStudents ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h6>Total Events</h6>
                    <h2><?= $totalEvents ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h6>Total Registrations</h6>
                    <h2><?= $totalRegistrations ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Latest Registrations</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Event</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($latestRegistrations)): ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                No registrations found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($latestRegistrations as $registration): ?>
                            <tr>
                                <td><?= htmlspecialchars($registration["username"]) ?></td>
                                <td><?= htmlspecialchars($registration["title"]) ?></td>
                                <td><?= htmlspecialchars($registration["registered_at"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
