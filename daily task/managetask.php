<?php 
//add connection
include 'config.php';
// set session 
if(!isset($_SESSION["rid"])){
    header("Location: login.php");
    exit();
}

// add header file
include 'header.php';
// show completed task in google pie chart
$rid=$_SESSION['rid'];
$sql="SELECT * FROM tbl_approved_tasks WHERE rid='$rid'";
$query=mysqli_query($conn,$sql);
$approvedTasks="approved";
$row=mysqli_fetch_array($query);

// ✅ SAFE CODE - Already perfect!
$approvedTaskName = $row['approved_task_name'] ?? '';
$taskNames = $approvedTaskName ? explode(",", $approvedTaskName) : [];
$taskCount=count($taskNames);
?>

<!-- Your HTML is perfect - Google Charts API works great! -->
<div class="task-box mx-auto bg-white p-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Decent task Today 😎</h2>
            <h3 class=""><?php echo $_SESSION['name']; ?>!</h3>
            
            <div class="mt-4">
                <!-- Google Pie Chart - Perfect implementation! -->
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Approved Tasks', <?php echo $taskCount; ?>],
                            ['Pending Tasks', 0]
                        ]);

                        var options = {
                            title: 'My Daily Activities',
                            width: 400,
                            height: 300
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="piechart" style="width: 400px; height: 300px;"></div>

                <!-- Completed Tasks List -->
                <div class="list-group mt-4">
                    <h3 class="mb-4">Completed Tasks</h3>
                    <?php if(empty($taskNames)): ?>
                        <p>No approved tasks yet. Add some tasks first!</p>
                    <?php else: ?>
                        <?php foreach($taskNames as $taskName): ?>
                            <div class="d-flex w-100 justify-content-between mb-3 p-3 border">
                                <h5 class="mb-1"><?php echo htmlspecialchars(trim($taskName)); ?></h5>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <a href="content.php" class="btn rounded-pill float-left fs-5 text-danger">
                <i class="bi bi-arrow-return-left"></i> Back
            </a>
        </div>
    </div>
</div>
