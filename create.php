<?php

require_once 'database.php';
require_once './functions.php';

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


?>

<?php include_once './views/partials/header.php'; ?>

<h1 class="py-3">Create new product</h1>

<?php include_once 'views/products/form.php' ?>
</body>

</html>