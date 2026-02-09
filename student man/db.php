<?php
$conn = mysqli_connect(
    "sqlXXX.byethostXX.com",   // MySQL Server (from cPanel)
    "b32_40946081",            // MySQL username
    "123456789",               // MySQL password
    "student_management"       // Database name
);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}
?>
