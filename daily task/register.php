<?php 
// connect with database
require_once 'config.php';
// add user registration code here
if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=base64_encode($_POST['password']);
    $phone=$_POST['phone'];

    $sql="INSERT INTO tbl_register (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";
    
    $query=mysqli_query($conn,$sql);
    if($query)
        {
            echo "<script>
            alert('Registration Successful');
            window.location.href='login.php';
            </script>";
        }
    else
        {
            echo "Error: ".mysqli_error($conn);
        }
}



?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<title>task</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>

    <container>
        <div class="task-box m-auto mt-5 p-4  rounded-lg shadow-lg bg-white">
            <h2 class="mx-auto text-center">Create Account</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                 <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            <!-- create a next page button -->
            <div class="mt-0 p-2 mb-5">

             <a href="index.php" class="btn  rounded-pill float-left fs-5 text-danger"><i class="bi bi-arrow-return-left"></i> Back</a>

                <a href="login.php" class="btn  rounded-pill float-end"><i class="bi bi-arrow-right-circle-fill fs-1 text-dark"></i></a>
            </div>
        </div>


</body>
</html>