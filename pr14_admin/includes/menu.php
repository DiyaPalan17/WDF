
<?php
$role = $_SESSION["role"] ?? "guest";

$menuItems = [
    "admin" => [
        ["label" => "Dashboard", "url" => "/pr14_admin/dashboard.php"],
        ["label" => "Students", "url" => "/pr14_admin/admin/students.php"],
        ["label" => "Events", "url" => "/pr14_admin/admin/events.php"],
        ["label" => "User Management", "url" => "/pr14_admin/admin/users.php"],
        ["label" => "Audit Logs", "url" => "/pr14_admin/admin/audit_logs.php"]
    ],
    "student" => [
        ["label" => "Home", "url" => "/pr14_admin/student_dashboard.php"],
        ["label" => "Events", "url" => "/pr14_admin/student_events.php"]
    ]
];
?>

<nav class="nav nav-pills gap-2 mb-4">
    <?php foreach ($menuItems[$role] ?? [] as $item): ?>
        <a class="nav-link border"
           href="<?= htmlspecialchars($item["url"]) ?>">
            <?= htmlspecialchars($item["label"]) ?>
        </a>
    <?php endforeach; ?>
</nav>
