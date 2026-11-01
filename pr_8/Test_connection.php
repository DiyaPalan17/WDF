
<?php
include "cont.php";

$sql = "SELECT * FROM stu_data";
$stmt = $mysqli->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

echo "<h2>Connected successfully!</h2>";
echo "<h2>Student Data</h2>";

echo "<table border='1' cellpadding='8'>";
echo "<tr>";

while ($field = $result->fetch_field()) {
    echo "<th>" . htmlspecialchars($field->name) . "</th>";
}

echo "</tr>";

$result->data_seek(0);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . htmlspecialchars((string)$value) . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

$stmt->close();
?>
