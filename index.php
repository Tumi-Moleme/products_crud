<?php
$pdo =  new
  PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Application v1</title>
  <!-- ---------- Bootstrap CSS ---------- -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
  <div class="container py-3">
    <h2 class="py-3">Section title</h2>
    <p> <a href="create.php" class="btn btn-success">Create Product</a></p>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
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
              <td><?php   ?></td>
              <td><?php echo $product['title']; ?></td>
              <td><?php echo "R " . $product['price']; ?></td>
              <td><?php echo $product['create_date']; ?></td>
              <td>
                <button type="button" class="btn btn-outline-primary">Edit</button>
                <button type="button" class="btn btn-outline-danger">Delete</button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
</body>

</html>