<?php
$pdo =  new
  PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = $_GET['id'] ?? null;

if (!$id) {
  header('Location: index.php');
}
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id ');
$stmt->bindValue(':id', $id);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);
$errors = [];
$title =  $product['title'];
$price = $product['price'];
$description = $product['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title = $_POST['title'];
  $description = $_POST['desc'];
  $price = $_POST['price'];



  if (empty($title)) {
    $errors[] = "Product title is required";
  }

  if (empty($price)) {
    $errors[] = "Product price is required";
  }

  // check if images folder is created
  if (!is_dir('assets/images')) {
    mkdir('assets/images');
  }


  if (empty($errors)) {
    $image = $_FILES['image'] ?? null;
    $imagePath = $product['image'];


    if ($image && $image['tmp_name']) {
      if ($product['image']) {
        unlink($product['image']);
      }
      $imagePath =
        "assets/images/" . randomString(8) . '/' . $image['name'];
      mkdir(dirname($imagePath));

      move_uploaded_file($image['tmp_name'], $imagePath);
    }
    $stmt = $pdo->prepare("UPDATE products SET
   title = ?, image = ?,description = ?, price = ? WHERE id = ?");

    $stmt->bindValue(1, $title);
    $stmt->bindValue(2, $imagePath);
    $stmt->bindValue(3, $description);
    $stmt->bindValue(4, $price);
    $stmt->bindValue(5, $id);


    $stmt->execute();
    // let user know if product was created
    header('Location: index.php');
  }
}

function randomString($var)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $var; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];
  }

  return $str;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update product</title>
  <!-- ---------- Bootstrap CSS ---------- -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <!-- ---------- Custom CSS ----------- -->
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class="container py-3">
    <p>
      <a href="index.php" class="btn btn-secondary">&LeftArrowBar;</a>
    </p>
    <!-- ---------- Heading ---------- -->
    <h1 class="py-3">Update product
      <b><?php echo $product['title']; ?></b>
    </h1>
    <!-- --x------- Heading -------x-- -->

    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <div> <?php echo $error; ?> </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- ---------- Start of form ----------- -->
    <form action="" method="POST" enctype="multipart/form-data">
      <!-- Display image if product has one -->
      <?php if ($product['image']) : ?>
        <img src="<?php echo $product['image']; ?>" width="150" alt="">
      <?php endif; ?>

      <div class="form-group">
        <label>Product Image</label> <br>
        <input type="file" name="image">
      </div>

      <div class="form-group">
        <label>Product Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
      </div>

      <div class="form-group">
        <label>Product Description</label>
        <textarea class="form-control" name="desc">
        <?php echo $product['description']; ?>
        </textarea>
      </div>

      <div class="form-group">
        <label>Product Price</label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price; ?>">
      </div>
      <button type="submit" class=" btn btn-primary">Submit</button>

    </form>
    <!-- --x------- Start of form --------x-- -->

</body>

</html>