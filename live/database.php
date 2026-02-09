<?php
$host = 'localhost';
$dbname = 'library_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Create tables automatically
$createTables = "
CREATE TABLE IF NOT EXISTS books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(50) UNIQUE,
    quantity INT NOT NULL DEFAULT 1,
    available INT NOT NULL DEFAULT 1,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    assign_date DATE NOT NULL,
    status ENUM('assigned', 'returned') DEFAULT 'assigned',
    return_condition ENUM('Excellent', 'Good', 'Poor', 'Damaged') NULL,
    return_notes TEXT NULL,
    return_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";
$pdo->exec($createTables);

// Add sample data (only first time)
if ($pdo->query("SELECT COUNT(*) FROM books")->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO books (title, author, isbn, quantity, available, category) VALUES
    ('PHP & MySQL Web Development', 'Luke Welling', '978-0321833890', 5, 3, 'Technology'),
    ('JavaScript: The Definitive Guide', 'David Flanagan', '978-0596805524', 8, 2, 'Technology'),
    ('Clean Code: A Handbook', 'Robert C. Martin', '978-0132350884', 4, 1, 'Technology')");
    
    $pdo->exec("INSERT INTO students (name, email, phone) VALUES
    ('Rahul Patel', 'rahul@email.com', '9876543210'),
    ('Priya Sharma', 'priya@email.com', '9876543201')");
}
?>
