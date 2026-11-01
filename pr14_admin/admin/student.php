
<?php
require_once "../includes/auth.php";
require_once "../db.php";

$stmt = $pdo->query(
    "SELECT id, full_name, enrollment_no, created_at
     FROM students ORDER BY id DESC"
);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2>Manage Students</h2>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Enrollment No.</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= (int)$student["id"] ?></td>
                        <td><?= htmlspecialchars($student["full_name"]) ?></td>
                        <td><?= htmlspecialchars($student["enrollment_no"] ?? "") ?></td>
                        <td><?= htmlspecialchars($student["created_at"]) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            No students found.
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
