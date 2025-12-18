<?php
include('header.php');
include('connect.php');

// Check if ID is set in GET
if(!isset($_GET['id'])){
    echo "No product selected!";
    exit;
}

$id = $_GET['id'];

// Fetch product details
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);

if($result->num_rows == 0){
    echo "Product not found!";
    exit;
}

$product = $result->fetch_assoc();

// If form submitted via POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $desc = $_POST['product_description'];

    $update_sql = "UPDATE products SET product_name='$name', product_price='$price', product_description='$desc' WHERE id=$id";

    if($conn->query($update_sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<h3>Edit Product</h3>
<form method="POST">
    <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
    </div>
    <div class="form-group">
        <label>Product Price</label>
        <input type="text" name="product_price" class="form-control" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
    </div>
    <div class="form-group">
        <label>Product Description</label>
        <textarea name="product_description" class="form-control" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-info">Update Product</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include('footer.php'); ?>
