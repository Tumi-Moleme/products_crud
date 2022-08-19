<?php

require_once 'database.php';


$errors = [];
$title = '';
$price = '';
$description = '';
$product = [
  'image' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once './validate_products.php';
  if (empty($errors)) {

    $stmt = $pdo->prepare("INSERT INTO products 
  (title, image,description, price, create_date )
  VALUES (?,?,?,?,?)");

    $stmt->bindValue(1, $title);
    $stmt->bindValue(2, $imagePath);
    $stmt->bindValue(3, $description);
    $stmt->bindValue(4, $price);
    $stmt->bindValue(5, date('Y-m-d H:i:s'));

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

<?php include_once './views/partials/header.php'; ?>

<h1 class="py-3">Create new product</h1>

<?php include_once 'views/products/form.php' ?>
</body>

</html>