<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Library Management System'; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; color: #333; }
        .navbar { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: white; }
        .nav-links { display: flex; list-style: none; gap: 2rem; }
        .nav-links a { color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 25px; transition: all 0.3s; }
        .nav-links a:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .hero { background: rgba(255,255,255,0.95); margin: 2rem; border-radius: 20px; padding: 3rem; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .hero h1 { color: #5a67d8; margin-bottom: 1rem; font-size: 2.5rem; }
        .btn { padding: 1rem 2rem; border: none; border-radius: 50px; font-size: 1.1rem; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-block; margin: 0.5rem; }
        .btn-primary { background: linear-gradient(45deg, #5a67d8, #667eea); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(90,103,216,0.4); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .stat-card { background: linear-gradient(45deg, #5a67d8, #667eea); color: white; padding: 2rem; border-radius: 15px; text-align: center; }
        .stat-number { font-size: 3rem; font-weight: bold; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #5a67d8; }
        input, select, textarea { width: 100%; padding: 1rem; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #5a67d8; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 2rem; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        th, td { padding: 1.5rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: linear-gradient(45deg, #5a67d8, #667eea); color: white; font-weight: 600; }
        tr:hover { background: #f7fafc; }
        .status-poor { background: #fed7d7; color: #c53030; }
        .status-good { background: #c6f6d5; color: #38a169; }
        .status-excellent { background: #bee3f8; color: #2b6cb0; }
        @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">📚 Library Management</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="assign.php">Assign</a></li>
            <li><a href="returns.php">Returns</a></li>
        </ul>
    </nav>
    <div class="container">
