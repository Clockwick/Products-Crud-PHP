<?php
  require_once '../../views/database.php';

  $id = $_GET['id'] ?? null;
  if (!$id) {
    Header("Location: index.php");
    exit;
  }
  $statement = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
  $statement->bindValue(":id", $id);
  $statement->execute();
  $product = $statement->fetch(PDO::FETCH_ASSOC);

  $title = $product['title'];
  $description = $product['description'];
  $price = $product['price'];
  $image = $product['image'] ?? null;
  $image_path = '';
  
  
    
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../views/partials/validate_product.php";
    if (empty($errors)) {
      $statement = $pdo->prepare("
          UPDATE products SET title = :title, image = :image, description = :description, price = :price WHERE product_id = :id
      ");
      
      $statement->bindValue(':title', $title);
      $statement->bindValue(':image', $image_path);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':id', $id);
      $statement->execute();
      header("Location: index.php");
    }
    
  }


?>

<?php include_once "../../views/partials/header.php" ?>
<body>
    <div class="container mt-2">
      <h1>Update Product <?php echo $product['title'] ?></h1>
      <p>
        <a href="index.php" class="btn btn-secondary">Go back to products</a>
      </p>
      <?php include_once "../../views/partials/form.php" ?>
      <button type="submit" class="btn btn-outline-success">Update products</button>
    </div>
</body>
</html>
