\<?php 
$page_title = "Student Management"; 
include 'database.php'; 
include 'header.php'; 

// Handle add/edit student
if ($_POST) {
    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        $stmt = $pdo->prepare("UPDATE students SET name=?, email=?, phone=? WHERE id=?");
        $stmt->execute([$_POST['name'], $_POST['email'] ?? null, $_POST['phone'] ?? null, $_POST['edit_id']]);
        $message = "✅ Student updated successfully!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['email'] ?? null, $_POST['phone'] ?? null]);
        $message = "✅ Student added successfully!";
    }
}

// Get all students
$stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC");
$students = $stmt->fetchAll();
?>

<div style="background: rgba(255,255,255,0.95); margin: 2rem; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <?php if (isset($message)): ?>
        <div style="background: #c6f6d5; color: #38a169; padding: 1rem; border-radius: 10px; margin-bottom: 2rem;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <h2 style="color: #5a67d8; margin-bottom: 2rem;">👨‍🎓 Student Management</h2>

    <?php 
    $editStudent = null;
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$_GET['edit']]);
        $editStudent = $stmt->fetch();
    }
    ?>

    <form method="POST" style="max-width: 600px; margin-bottom: 3rem; background: #f7fafc; padding: 2rem; border-radius: 15px;">
        <?php if ($editStudent): ?>
            <input type="hidden" name="edit_id" value="<?php echo $editStudent['id']; ?>">
            <h3 style="color: #5a67d8; margin-bottom: 1rem;">Edit Student</h3>
        <?php else: ?>
            <h3 style="color: #5a67d8; margin-bottom: 1rem;">Add New Student</h3>
        <?php endif; ?>
        
        <div class="form-row">
            <div class="form-group">
                <label>Student Name *</label>
                <input type="text" name="name" value="<?php echo $editStudent['name'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $editStudent['email'] ?? ''; ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $editStudent['phone'] ?? ''; ?>">
        </div>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">💾 Save Student</button>
            <a href="students.php" class="btn" style="background: #e2e8f0; color: #4a5568;">❌ Cancel</a>
        </div>
    </form>

    <h3 style="color: #5a67d8; margin: 2rem 0 1rem 0;">All Students (<?php echo count($students); ?>)</h3>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td style="font-weight: 600;"><?php echo htmlspecialchars($student['name']); ?></td>
                <td><?php echo htmlspecialchars($student['email'] ?? 'No email'); ?></td>
                <td><?php echo htmlspecialchars($student['phone'] ?? 'No phone'); ?></td>
                <td><?php echo date('M j, Y', strtotime($student['created_at'])); ?></td>
                <td>
                    <a href="?edit=<?php echo $student['id']; ?>" class="btn" 
                       style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #5a67d8; color: white;">
                        ✏️ Edit
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if (empty($students)): ?>
        <div style="text-align: center; padding: 3rem; color: #666;">
            <h3>No students yet</h3>
            <p>Add your first student using the form above!</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
