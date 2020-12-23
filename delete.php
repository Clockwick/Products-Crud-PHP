
<?php
  require_once 's.php';
  $pdo = new PDO($sql_param_1, $sql_param_2, $sql_param_3);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
