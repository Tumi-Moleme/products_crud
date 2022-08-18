<?php
$pdo =  new
  PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// check if products id is set else assign it to null
$id = $_POST['id'] ?? null;


if (!$id) {
  header('Location: index.php');
}
// Prepare statement
$stmt = $pdo->prepare('DELETE FROM products WHERE id = :id ');
// bind parameters to the sql statement
$stmt->bindValue(':id', $id);
$stmt->execute();
//TODO send message to user
header("Location: index.php");
