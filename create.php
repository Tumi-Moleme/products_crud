<?php
$pdo =  new
  PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];
$title = '';
$price = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title = $_POST['title'];
  $description = $_POST['desc'];
  $price = $_POST['price'];
  $date = date('Y-m-d H:i:s');


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
    $imagePath = '';

    if ($image) {
      $imagePath =
        "assets/images/" . randomString(8) . '/' . $image['name'];
      mkdir(dirname($imagePath));

      move_uploaded_file($image['tmp_name'], $imagePath);
    }
    $stmt = $pdo->prepare("INSERT INTO products 
  (title, image,description, price, create_date )
  VALUES (?,?,?,?,?)");

    $stmt->bindValue(1, $title);
    $stmt->bindValue(2, $imagePath);
    $stmt->bindValue(3, $description);
    $stmt->bindValue(4, $price);
    $stmt->bindValue(5, $date);

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
  <title>Create product</title>
  <!-- ---------- Bootstrap CSS ---------- -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
  <div class="container py-3">
    <h1 class="py-3">Create new product</h1>

    <!-- Display error(s) message if input are not filled -->
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <div> <?php echo $error; ?> </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
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
          <?php echo $description; ?>
        </textarea>
      </div>

      <div class="form-group">
        <label>Product Price</label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price; ?>">
      </div>
      <button type="submit" class=" btn btn-primary">Submit</button>

    </form>
</body>

</html>