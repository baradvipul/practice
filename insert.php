<?php
include('header.php');
include('connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $desc = $_POST['product_description'];

    $sql = "INSERT INTO products (product_name, product_price, product_description) VALUES ('$name','$price','$desc')";
    if($conn->query($sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error: ".$conn->error;
    }
}
?>

<form method="POST">
    <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="product_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Product Price</label>
        <input type="text" name="product_price" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="product_description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Add Product</button>
</form>

<?php include('footer.php'); ?>
