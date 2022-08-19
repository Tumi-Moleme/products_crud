<?php

/** @var $pdo \PDO **/
require_once 'database.php';

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

  require_once './validate_products.php';

  if (empty($errors)) {

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

<?php include_once './views/partials/header.php'; ?>

<p>
  <a href="index.php" class="btn btn-secondary">&LeftArrowBar;</a>
</p>
<!-- ---------- Heading ---------- -->
<h1 class="py-3">Update product
  <b><?php echo $product['title']; ?></b>
</h1>
<!-- --x------- Heading -------x-- -->

<?php include_once './views/products/form.php'; ?>
</body>

</html>