<?php
$title = $_POST['title'];
$description = $_POST['desc'];
$price = $_POST['price'];
$imagePath = '';

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
}
