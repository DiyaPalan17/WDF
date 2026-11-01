<?php
require __DIR__ . "/db.php";
try {
    $stmt = $pdo->prepare("SELECT * FROM stu_data");
    $stmt->execute();
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("Unable to read stu_data. Confirm that the table exists in the student database.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>StudentHub Database Connection Test</title>
<style>
body { font-family: Arial, sans-serif; margin: 24px; color: #222; }
h1 { font-size: 28px; }
.success { color: green; font-weight: bold; }
.table-wrap { overflow-x: auto; }
table { border-collapse: collapse; margin-top: 12px; }
th, td { border: 1px solid #888; padding: 10px 12px; text-align: left; }
th { background: #f2f2f2; }
.empty { color: #555; }
</style>
</head>
<body>
<h1>StudentHub Database Connection Test</h1>
<p class="success">Database connected successfully.</p>
<p>Database: <strong>student</strong></p>
<p>Connection: <strong>PDO</strong></p>
<h2>Student Data</h2>
<div class="table-wrap"><table>
<?php if (!empty($students)): ?>
<thead><tr>
<?php foreach (array_keys($students[0]) as $column): ?>
<th><?= htmlspecialchars((string)$column, ENT_QUOTES, "UTF-8") ?></th>
<?php endforeach; ?>
</tr></thead><tbody>
<?php foreach ($students as $student): ?><tr>
<?php foreach ($student as $value): ?>
<td><?= htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8") ?></td>
<?php endforeach; ?>
</tr><?php endforeach; ?>
</tbody>
<?php else: ?>
<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Gender</th><th>Phone No.</th><th>Address</th><th>Pincode</th><th>Message</th></tr></thead>
<tbody><tr><td colspan="8" class="empty">No student records found in stu_data yet.</td></tr></tbody>
<?php endif; ?>
</table></div>
</body>
</html>
