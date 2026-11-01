<?php

include "cont.php";

$sql = "SELECT * FROM students";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>

<body>

<h2>Student List</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Mobile</th>
        <th>Pincode</th>
        <th>Address</th>
        <th>Gender</th>
    </tr>

    <?php foreach ($students as $student) { ?>

    <tr>
        <td><?php echo $student['student_id']; ?></td>
        <td><?php echo $student['name']; ?></td>
        <td><?php echo $student['email']; ?></td>
        <td><?php echo $student['message']; ?></td>
        <td><?php echo $student['mobile']; ?></td>
        <td><?php echo $student['pincode']; ?></td>
        <td><?php echo $student['address']; ?></td>
        <td><?php echo $student['gender']; ?></td>
    </tr>

    <?php } ?>

</table>

</body>
</html>
