<?php
session_start();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=tops', 'root', '');
    
    $stmt = $pdo->prepare('SELECT id, Username, Email FROM emp WHERE Email = ? AND Password = ?');
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['Username'];
        $success = 'Login successful! Welcome ' . $user['Username'];
    } else {
        $error = 'Wrong email or password';
    }
}
?>

<html>
<body>
<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green"><?php echo $success; ?></p>
    <a href="dashboard.php">Go to Dashboard</a>
<?php else: ?>
    <form method="POST">
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
<?php endif; ?>


</body>
</html> 
