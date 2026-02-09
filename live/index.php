<?php $page_title = "Library Management System"; 
include 'database.php'; 
include 'header.php';  // FULL PATH
// ... your page code ...
include 'footer.php';  // FULL PATH at bottom
?>
<section class="hero">
    <h1>Library Management System</h1>
    <p>Comprehensive book and student management system</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
        <a href="books.php" class="btn btn-primary">Manage Books</a>
        <a href="students.php" class="btn btn-primary">Manage Students</a>
    </div>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 2rem 0;">
    <div style="background: rgba(255,255,255,0.95); border-radius: 20px; padding: 2rem; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
        <div style="font-size: 3rem; margin-bottom: 1rem;">👨‍🎓</div>
        <h3 style="color: #5a67d8; margin-bottom: 1rem;">Student Management</h3>
        <p>Add, edit, manage student information</p>
        <a href="students.php" class="btn btn-primary">Manage Students</a>
    </div>
    <div style="background: rgba(255,255,255,0.95); border-radius: 20px; padding: 2rem; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
        <div style="font-size: 3rem; margin-bottom: 1rem;">📖</div>
        <h3 style="color: #5a67d8; margin-bottom: 1rem;">Book Management</h3>
        <p>Complete inventory management</p>
        <a href="books.php" class="btn btn-primary">Manage Books</a>
    </div>
    <div style="background: rgba(255,255,255,0.95); border-radius: 20px; padding: 2rem; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
        <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
        <h3 style="color: #5a67d8; margin-bottom: 1rem;">Book Assignment</h3>
        <p>Assign and track books</p>
        <a href="assignments.php" class="btn btn-primary">Assignments</a>
    </div>
</div>
<?php include 'footer.php'; ?>
