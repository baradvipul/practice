<?php 
// Start session FIRST
session_start();

// Check if session expired (10 seconds from login)
if (isset($_SESSION['expire']) && time() > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit;
}

// add connection file
include 'config.php';

// Handle login
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=base64_encode($_POST['password']);

    $sql="SELECT * FROM tbl_register WHERE email='$email' AND password='$password'";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($query);
    $count=mysqli_num_rows($query);
    
    if($count==1) {
        // Set session data AND 10-second expiration
        $_SESSION['rid']=$row['rid'];
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['expire'] = time() + 5;  // EXPIRES IN 10 SECONDS
        
        header("Location: content.php");
        exit;
    } else {
        echo "<script>alert('Invalid Credentials'); window.location.href='login.php';</script>";
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php if(isset($_GET['expired'])): ?>
    <div class="alert alert-warning text-center">ho gaya expire sir</div>
<?php endif; ?>

<container>
    <div class="task-box m-auto mt-5 p-4 bg-white rounded-lg shadow-lg">
        <h2 class="mx-auto text-center">Login</h2>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            
            <div class="mt-3">
                <a href="register.php" class="btn rounded-pill float-left fs-5 text-danger">
                    <i class="bi bi-arrow-return-left"></i> Back
                </a>
            </div>
        </form>
    </div>
</container>
</body>
</html>