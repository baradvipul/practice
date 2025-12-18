<?php
include('connect.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['product_price']; ?></td>
            <td><?php echo $row['product_description']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>No products found</td></tr>";
}
?>
