<?php

require_once 'database.php';

$search = $_GET['search'] ?? null;

if ($search) {
  $stmt = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
  $stmt->bindValue(":title", "%$search%");
} else {
  $stmt = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once './views/partials/header.php'; ?>
<h2 class="py-3">Products CRUD</h2>
<p> <a href="create.php" class="btn btn-success">Create Product</a></p>

<!-- ---------- Search bar ---------- -->
<form action="" method="get">
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?php echo $search ?>">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </div>
</form>
<!-- --x------- End of Search bar -------x-- -->

<!-- ---------- Start Of Table ---------- -->
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>

      <tr>

        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Price</th>
        <th>Create Date</th>
        <th>Action</th>

      </tr>

    </thead>
    <tbody>

      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?php echo $product['id']; ?></td>
          <td>
            <img src="<?php echo $product['image'] ?>" class="thumb-image" alt="<?php echo $product['title'] ?>">
          </td>
          <td><?php echo $product['title']; ?></td>
          <td><?php echo "R " . $product['price']; ?></td>
          <td><?php echo $product['create_date']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Edit</a>
            <form style="display: inline-block" action="delete.php " method="POST">
              <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
              <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<!-- --x------- End Of Table -------x-- -->

</body>

</html>