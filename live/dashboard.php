<?php 
$page_title = "Dashboard"; 
include 'database.php'; 
include 'header.php';  // FULL PATH
// ... your page code ...
include 'footer.php';  // FULL PATH at bottom

// Get stats
$stmt = $pdo->query("SELECT SUM(quantity) as total_books, SUM(quantity - available) as assigned_books FROM books");
$bookStats = $stmt->fetch();
$totalBooks = $bookStats['total_books'] ?? 0;
$assignedBooks = $bookStats['assigned_books'] ?? 0;

$stmt = $pdo->query("SELECT COUNT(*) as total_students FROM students");
$totalStudents = $stmt->fetch()['total_students'];

$stmt = $pdo->query("SELECT COUNT(*) as pending FROM assignments WHERE status = 'assigned'");
$pendingBooks = $stmt->fetch()['pending'];

$stmt = $pdo->query("SELECT COUNT(*) as returned_today FROM assignments WHERE status = 'returned' AND DATE(return_date) = CURDATE()");
$returnedToday = $stmt->fetch()['returned_today'] ?? 0;
?>

<section style="background: rgba(255,255,255,0.95); margin: 2rem; border-radius: 20px; padding: 3rem; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #5a67d8; margin-bottom: 2rem;">Dashboard</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalBooks; ?></div>
            <div>Total Books</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $pendingBooks; ?></div>
            <div>Pending Books</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalStudents; ?></div>
            <div>Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $returnedToday; ?></div>
            <div>Returned Today</div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>
