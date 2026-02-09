<?php 
$page_title = "Book Management"; 
include 'database.php'; 
include 'header.php'; 

if ($_POST && isset($_POST['action']) && $_POST['action'] == 'add_book') {
    $stmt = $pdo->prepare("INSERT INTO books (title, author, isbn, quantity, available, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['author'], $_POST['isbn']??'', $_POST['quantity'], $_POST['quantity'], $_POST['category']]);
    $success = "✅ Book added successfully!";
}

$stmt = $pdo->query("SELECT * FROM books ORDER BY created_at DESC");
$books = $stmt->fetchAll();
?>

<div style="background: rgba(255,255,255,0.95); margin: 2rem; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <?php if (isset($success)) echo "<div style='background:#c6f6d5;color:#38a169;padding:1rem;border-radius:10px;'>$success</div>"; ?>
    
    <h2 style="color:#5a67d8;">📚 Book Management</h2>
    <a href="#addBook" class="btn btn-primary" onclick="document.getElementById('addBookForm').scrollIntoView()" style="margin-bottom:2rem;display:inline-block;">➕ Add New Book</a>

    <form id="addBookForm" method="POST" style="max-width:600px;margin-bottom:3rem;">
        <input type="hidden" name="action" value="add_book">
        <div class="form-row">
            <div class="form-group">
                <label>Book Title *</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Author *</label>
                <input type="text" name="author" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn">
            </div>
            <div class="form-group">
                <label>Quantity *</label>
                <input type="number" name="quantity" min="1" value="1" required>
            </div>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" required>
                <option value="Technology">Technology</option>
                <option value="Fiction">Fiction</option>
                <option value="Science">Science</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">Add Book</button>
    </form>

    <table>
        <thead><tr><th>Title</th><th>Author</th><th>ISBN</th><th>Total</th><th>Available</th><th>Category</th></tr></thead>
        <tbody>
            <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['author']); ?></td>
                <td><?php echo htmlspecialchars($book['isbn']??'N/A'); ?></td>
                <td><strong><?php echo $book['quantity']; ?></strong></td>
                <td style="color:#38a169;"><strong><?php echo $book['available']; ?></strong></td>
                <td><?php echo htmlspecialchars($book['category']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
