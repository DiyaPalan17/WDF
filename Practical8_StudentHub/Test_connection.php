<?php
require __DIR__ . "/db.php";
try {
    $stmt = $pdo->prepare("SELECT * FROM stu_data");
    $stmt->execute();
    $rows = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("Connection succeeded, but reading stu_data failed. Confirm the table exists.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Practical 8 - Test Connection</title>
<style>
body { font-family: Arial, sans-serif; margin: 24px; }
.success { color: green; font-weight: bold; }
table { border-collapse: collapse; margin-top: 12px; }
th, td { border: 1px solid #888; padding: 10px; text-align: left; }
th { background: #f2f2f2; }
</style>
</head>
<body>
<h1>Practical 8 - Database Connection Test</h1>
<p class="success">Database connected successfully.</p>
<p>Database: <strong>student</strong> | Connection: <strong>PDO</strong></p>
<h2>Student Data</h2>
<table>
<?php if (!empty($rows)): ?>
<thead><tr><?php foreach (array_keys($rows[0]) as $column): ?>
<th><?= htmlspecialchars((string)$column, ENT_QUOTES, "UTF-8") ?></th>
<?php endforeach; ?></tr></thead><tbody>
<?php foreach ($rows as $row): ?><tr>
<?php foreach ($row as $value): ?><td><?= htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8") ?></td><?php endforeach; ?>
</tr><?php endforeach; ?></tbody>
<?php else: ?>
<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Gender</th><th>Phone No.</th><th>Address</th><th>Pincode</th><th>Message</th></tr></thead>
<tbody><tr><td colspan="8">No records found in stu_data yet.</td></tr></tbody>
<?php endif; ?>
</table>
</body>
</html>
