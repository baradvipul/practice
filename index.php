<?php include('header.php'); ?>
<a href="insert.php" class="btn btn-success mb-3">Add New Product</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php include('view.php'); ?>
    </tbody>
</table>
<?php include('footer.php'); ?>
