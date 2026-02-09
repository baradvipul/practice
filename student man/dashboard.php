<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="add-student.php">Add Student</a>
</div>

<div class="card">
<h2>Student Dashboard</h2>

<table>
<tr>
<th>Roll</th><th>Name</th><th>Email</th><th>Course</th><th>GPA</th><th>Action</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM students");
while($row=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $row['roll_no'] ?></td>
<td><?= $row['first_name']." ".$row['last_name'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['course'] ?></td>
<td><?= $row['gpa'] ?></td>
<td>
<a href="view-student.php?id=<?= $row['id'] ?>" class="btn btn-info">View</a>
<a href="edit-student.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
<a href="delete-student.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>

</body>
</html>
