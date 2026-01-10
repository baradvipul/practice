<?php 
// START SESSION FIRST & CHECK 10-SECOND TIMEOUT
session_start();

// Destroy session after 10 seconds OR if not logged in
if (!isset($_SESSION["rid"]) || !isset($_SESSION['expire']) || time() > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit;
}

// Add connection file
include 'config.php';
error_reporting(0);

// Add header file
include 'header.php';

$rid = $_SESSION['rid'];

// Fetch task list
$sql = "SELECT * FROM tbl_task WHERE rid='$rid'";
$query = mysqli_query($conn, $sql);

// Handle approved tasks
if(isset($_POST['approveTask'])){
    $rid = $_SESSION['rid'];
    $approvedTasks = implode(",", $_POST['taskChk']);
    $sql_insert = "INSERT INTO tbl_approved_tasks (rid, approved_task_name) VALUES ('$rid', '$approvedTasks')";
    $query_insert = mysqli_query($conn, $sql_insert);
    
    if($query_insert) {
        echo "<script>
        alert('Task Approved Successfully');
        window.location.href='content.php';
        </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
<div class="container-fluid">
    <div class="task-box mx-auto bg-white p-5 mt-5" style="max-width: 800px;">
        <div class="row">
            <div class="col-md-12">
                <!-- SESSION COUNTDOWN -->
                <div class="alert alert-info mb-4">
                    <strong>Session expires in: 
                        <span id="countdown"><?php echo ($_SESSION['expire'] - time()); ?></span> seconds
                    </strong>
                </div>
                
                <h2 class="mb-4">Good Evening, <?php echo $_SESSION['name']; ?>!</h2>
                
                <form method="post">
                    <div class="text-center mt-4">
                        <h4 class="mb-4">Select Tasks to Approve:</h4>
                        
                        <!-- Task List -->
                        <div class="list-group list-group-flush">
                            <?php
                            if(mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <div class="list-group-item d-flex w-100 justify-content-between align-items-center p-3 border-bottom">
                                        <div>
                                            <h5 class="mb-1"><?php echo htmlspecialchars($row['task_name']); ?></h5>
                                            <small><?php echo htmlspecialchars($row['task_description'] ?? ''); ?></small>
                                        </div>
                                        <input type="checkbox" name="taskChk[]" value="<?php echo htmlspecialchars($row['task_name']); ?>" 
                                               class="form-check-input" id="task_<?php echo $row['id']; ?>">
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<p class="text-muted">No tasks available.</p>';
                            }
                            ?>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" name="approveTask" class="btn btn-dark rounded-pill px-5 py-2 fs-5">
                                <i class="bi bi-check-circle"></i> Approve Selected Tasks
                            </button>
                            <!-- <a href="logout.php" class="btn btn-danger rounded-pill px-5 py-2 ms-3 fs-5">
                                <i class="bi bi-box-arrow-right"></i> Logout -->
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- COUNTDOWN TIMER -->
<script>
let expireTime = <?php echo $_SESSION['expire']; ?>;
function updateCountdown() {
    let now = Math.floor(Date.now() / 1000);
    let remaining = expireTime - now;
    if (remaining > 0) {
        document.getElementById('countdown').textContent = remaining;
    } else {
        // Auto redirect when expired
        window.location.href = 'login.php?expired=1';
    }
}
setInterval(updateCountdown, 1000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>