<?php 
$page_title = "Book Returns"; 
include 'database.php'; 
include 'header.php'; 

// Initialize variables first (FIXES undefined key warning)
$success = '';
$error = '';

// Handle return ONLY when form submitted
if ($_POST && isset($_POST['action']) && $_POST['action'] == 'return') {
    $assignment_id = $_POST['assignment_id'];
    $condition = $_POST['condition'];
    $notes = $_POST['notes'] ?? '';
    
    // Update assignment as returned
    $stmt = $pdo->prepare("
        UPDATE assignments 
        SET status = 'returned', return_condition = ?, return_notes = ?, return_date = CURDATE() 
        WHERE id = ? AND status = 'assigned'
    ");
    $result = $stmt->execute([$condition, $notes, $assignment_id]);
    
    if ($result) {
        // Get book_id to update availability
        $assignStmt = $pdo->prepare("SELECT book_id FROM assignments WHERE id = ?");
        $assignStmt->execute([$assignment_id]);
        $bookId = $assignStmt->fetch()['book_id'];
        
        // Update book availability (+1 available)
        if ($bookId) {
            $pdo->prepare("UPDATE books SET available = available + 1 WHERE id = ?")->execute([$bookId]);
        }
        
        $success = "✅ Book return processed successfully!";
    } else {
        $error = "❌ Invalid assignment or already returned!";
    }
}

// Get pending assignments for return dropdown
$stmt = $pdo->query("
    SELECT a.id, a.assign_date, s.name as student_name, b.title as book_title
    FROM assignments a 
    JOIN students s ON a.student_id = s.id 
    JOIN books b ON a.book_id = b.id 
    WHERE a.status = 'assigned'
    ORDER BY a.assign_date DESC
");
$pendingAssignments = $stmt->fetchAll();

// Get recent returns for display
$recentReturns = $pdo->query("
    SELECT a.*, s.name as student_name, b.title as book_title 
    FROM assignments a 
    JOIN students s ON a.student_id = s.id 
    JOIN books b ON a.book_id = b.id 
    WHERE a.status = 'returned' 
    ORDER BY a.return_date DESC LIMIT 10
")->fetchAll();
?>

<div style="background: rgba(255,255,255,0.95); margin: 2rem; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <h2 style="color: #5a67d8;">📦 Book Returns</h2>
    
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

    <!-- Return Form -->
    <div style="background: #f7fafc; padding: 2rem; border-radius: 15px; margin: 2rem 0;">
        <h3 style="margin-bottom: 1.5rem; color: #5a67d8;">🔄 Process Book Return</h3>
        <form method="POST" style="max-width: 700px;">
            <input type="hidden" name="action" value="return">
            
            <div class="form-group">
                <label>📋 Select Assignment to Return *</label>
                <select name="assignment_id" required style="font-size: 1.1rem;">
                    <option value="">Select Pending Assignment</option>
                    <?php foreach ($pendingAssignments as $assignment): ?>
                        <option value="<?php echo $assignment['id']; ?>">
                            <?php echo htmlspecialchars($assignment['student_name'] . ' - ' . $assignment['book_title'] . ' (' . $assignment['assign_date'] . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>📊 Return Condition *</label>
                    <select name="condition" required style="font-size: 1.1rem;">
                        <option value="">Select Condition</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                        <option value="Damaged">Damaged</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>📅 Return Date</label>
                    <input type="date" name="return_date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label>📝 Return Notes</label>
                <textarea name="notes" rows="3" style="font-size: 1.1rem;" 
                          placeholder="Any damage notes or observations..."></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.2rem; padding: 1.2rem;">
                ✅ Process Return
            </button>
        </form>
    </div>

    <!-- Recent Returns -->
    <h3 style="margin: 2rem 0 1rem 0; color: #5a67d8;">📋 Recent Returns (<?php echo count($recentReturns); ?>)</h3>
    
    <?php if (!empty($recentReturns)): ?>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Book</th>
                <th>Return Date</th>
                <th>Condition</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentReturns as $return): ?>
            <tr>
                <td style="font-weight: 600;">
                    <?php echo htmlspecialchars($return['student_name']); ?>
                </td>
                <td><?php echo htmlspecialchars($return['book_title']); ?></td>
                <td><?php echo date('M j, Y', strtotime($return['return_date'])); ?></td>
                <td class="status-<?php echo strtolower($return['return_condition']); ?>" 
                    style="padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600;">
                    <?php echo htmlspecialchars($return['return_condition']); ?>
                </td>
                <td style="font-size: 0.9rem; color: #666;">
                    <?php echo htmlspecialchars($return['return_notes'] ?: 'No notes'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div style="text-align: center; padding: 3rem; color: #666;">
            <h3>No returns yet</h3>
            <p>Process some book returns using the form above!</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
