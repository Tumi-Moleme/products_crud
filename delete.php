<?php
$pdo =  new
  PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = $_POST['id'] ?? null;

if (!$id) {
  header('Location: index.php');
}
$stmt = $pdo->prepare('DELETE FROM products WHERE id = :id ');
$stmt->bindValue(':id', $id);
$stmt->execute();
//TODO send message to user
header("Location: index.php");
