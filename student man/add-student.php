<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="dashboard.php">Dashboard</a>
</div>

<div class="card">
<h2>Add Student</h2>

<form method="post">
<input name="roll_no" placeholder="Roll No" required><br><br>
<input name="first_name" placeholder="First Name" required><br><br>
<input name="last_name" placeholder="Last Name" required><br><br>
<input name="email" placeholder="Email" required><br><br>
<input name="phone" placeholder="Phone" required><br><br>

<select name="gender">
<option>Male</option>
<option>Female</option>
</select><br><br>

<input type="date" name="dob" required><br><br>
<input name="address" placeholder="Address"><br><br>
<input name="city" placeholder="City"><br><br>
<input name="state" placeholder="State"><br><br>
<input name="course" placeholder="Course"><br><br>
<input name="gpa" placeholder="GPA"><br><br>
<input type="date" name="enrollment_date"><br><br>

<button name="save" class="btn btn-primary">Add Student</button>
</form>

<?php
if(isset($_POST['save'])){
    mysqli_query($conn,"INSERT INTO students
    (roll_no,first_name,last_name,email,phone,gender,dob,address,city,state,course,gpa,enrollment_date)
    VALUES(
    '$_POST[roll_no]','$_POST[first_name]','$_POST[last_name]','$_POST[email]',
    '$_POST[phone]','$_POST[gender]','$_POST[dob]','$_POST[address]',
    '$_POST[city]','$_POST[state]','$_POST[course]','$_POST[gpa]','$_POST[enrollment_date]'
    )");
    echo "<p style='color:green'>Student Added Successfully</p>";
}
?>

</div>
</body>
</html>
