<?php
require_once __DIR__ . '/../includes/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
$q = trim((string)($_GET['q'] ?? ''));
if (mb_strlen($q) > 100) $q = mb_substr($q, 0, 100);
$like = '%' . $q . '%';
$stmt = $pdo->prepare(
    'SELECT title, category, description, DATE_FORMAT(event_date, "%d %b %Y") AS event_date
     FROM events WHERE title LIKE ? OR category LIKE ? OR description LIKE ?
     ORDER BY event_date ASC LIMIT 50'
);
$stmt->execute([$like, $like, $like]);
echo json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
