
<?php
  require_once '../../views/database.php';

  $id = $_POST['id'] ?? null;
  if (!$id) {
    Header("Location: index.php");
    exit;
  }
  $statement = $pdo->prepare("DELETE FROM products WHERE product_id = :id");
  $statement->bindValue(":id", $id);
  $statement->execute();
  
  Header("Location: index.php");
  
?>
