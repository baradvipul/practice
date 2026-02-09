\<?php 
$page_title = "Book Assign"; 
include 'database.php'; 
include 'header.php'; 

// Initialize variables first (FIXES undefined warning)
$success = '';
$error = '';

// Handle book assign ONLY when form submitted
if ($_POST && isset($_POST['action']) && $_POST['action'] == 'assign_book') {
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];      // ← NOW DEFINED!
    $assign_date = $_POST['assign_date'];
    
    // Check book availability
    $checkStmt = $pdo->prepare("SELECT available FROM books WHERE id = ?");
    $checkStmt->execute([$book_id]);
    $book = $checkStmt->fetch();
    
    if ($book && $book['available'] > 0) {
        // Insert assignment
        $stmt = $pdo->prepare("INSERT INTO assignments (student_id, book_id, assign_date) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $book_id, $assign_date]);
        
        // Update book availability
        $pdo->prepare("UPDATE books SET available = available - 1 WHERE id = ?")->execute([$book_id]);
        
        $success = "✅ Book assigned successfully to student!";
    } else {
        $error = "❌ Book not available!";
    }
}

// Get data for dropdowns
$students = $pdo->query("SELECT id, name, email FROM students ORDER BY name")->fetchAll();
$books = $pdo->query("SELECT id, title, author, available FROM books WHERE available > 0 ORDER BY title")->fetchAll();

// Get all assignments for display
$stmt = $pdo->query("
    SELECT a.id, a.assign_date, a.status, s.name as student_name, s.email, 
           b.title as book_title, b.author
    FROM assignments a 
    JOIN students s ON a.student_id = s.id 
    JOIN books b ON a.book_id = b.id 
    ORDER BY a.assign_date DESC
");
$assignments = $stmt->fetchAll();
?>

<div style="background: rgba(255,255,255,0.95); margin: 2rem; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <h2 style="color: #5a67d8;">📋 Book Assign</h2>
    
    <?php if ($success): ?>
        <div style="background: #c6f6d5; color: #38a169; padding: 1rem; border-radius: 10px; margin: 1rem 0;">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div style="background: #fed7d7; color: #c53030; padding: 1rem; border-radius: 10px; margin: 1rem 0;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Assign Form -->
    <div style="background: #f7fafc; padding: 2rem; border-radius: 15px; margin: 2rem 0;">
        <h3 style="margin-bottom: 1.5rem; color: #5a67d8;">➕ Assign New Book</h3>
        <form method="POST" style="max-width: 700px;">
            <input type="hidden" name="action" value="assign_book">
            
            <div class="form-row">
                <div class="form-group">
                    <label>👨‍🎓 Select Student *</label>
                    <select name="student_id" required style="font-size: 1.1rem;">
                        <option value="">Choose Student</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo $student['id']; ?>">
                                <?php echo htmlspecialchars($student['name']); ?> 
                                <small style="color: #666;">(<?php echo $student['email']; ?>)</small>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>📖 Select Book *</label>
                    <select name="book_id" required style="font-size: 1.1rem;">
                        <option value="">Choose Available Book</option>
                        <?php foreach ($books as $book): ?>
                            <option value="<?php echo $book['id']; ?>">
                                <?php echo htmlspecialchars($book['title']); ?> by <?php echo $book['author']; ?>
                                <strong style="color: #38a169;"> (<?php echo $book['available']; ?> available)</strong>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label>📅 Assign Date *</label>
                <input type="date" name="assign_date" value="<?php echo date('Y-m-d'); ?>" required 
                       style="font-size: 1.1rem;">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.2rem; padding: 1.2rem;">
                ➕ Assign Book Now
            </button>
        </form>
    </div>

    <!-- Assigned Books List -->
    <h3 style="margin: 2rem 0 1rem 0; color: #5a67d8;">📚 Currently Assigned Books (<?php echo count($assignments); ?>)</h3>
    
    <?php if (!empty($assignments)): ?>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Book</th>
                <th>Assigned On</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td style="font-weight: 600;">
                    <?php echo htmlspecialchars($assignment['student_name']); ?><br>
                    <small><?php echo htmlspecialchars($assignment['email']); ?></small>
                </td>
                <td>
                    📖 <?php echo htmlspecialchars($assignment['book_title']); ?><br>
                    <small>by <?php echo htmlspecialchars($assignment['author']); ?></small>
                </td>
                <td><?php echo date('M j, Y', strtotime($assignment['assign_date'])); ?></td>
                <td>
                    <?php if ($assignment['status'] == 'returned'): ?>
                        <span class="status-good" style="padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600;">
                            ✅ Returned
                        </span>
                    <?php else: ?>
                        <span class="status-poor" style="padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600;">
                            ⏳ Assigned
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div style="text-align: center; padding: 3rem; color: #666;">
            <h3>No assignments yet</h3>
            <p>Use the form above to assign your first book!</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
