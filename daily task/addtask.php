<?php 
//add connection
include 'config.php';
// add header file
include 'header.php';
// add task here
if(isset($_POST['addTask'])){
    $rid=$_SESSION['rid'];
    $taskName=$_POST['taskName'];
    $taskDescription=$_POST['taskDescription'];
    
    $sql="INSERT INTO tbl_task (rid,task_name, task_description) VALUES ( '$rid', '$taskName', '$taskDescription')";
    
    $query=mysqli_query($conn,$sql);
    if($query)
        {
            echo "<script>
            alert('Task Added Successfully');
            window.location.href='content.php';
            </script>";
        }
    else
        {
            echo "Error: ".mysqli_error($conn);
        }
}
?>
<!-- create a content -->
<div class="w-50 mx-auto bg-white p-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="">Good Evening, <br> <?php echo $_SESSION['name']; ?>!</h2>
            <div class="mt-4">
                <!-- add task here -->
                <form method="post" action="addtask.php">
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="taskName" name="taskName">
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Task Description</label>
                        <textarea class="form-control" id="taskDescription" name="taskDescription"></textarea>
                    </div>
                    <button type="submit" name="addTask" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>