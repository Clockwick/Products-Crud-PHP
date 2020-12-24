<?php
require_once '../../views/database.php';

$title = '';
$description = '';
$price = '';
$image_path = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    require_once "../../views/partials/validate_product.php";
    
    if (empty($errors)) {
        $statement = $pdo->prepare("
            INSERT INTO products (title, image, description, price, create_date) 
            VALUES (:title, :image, :description, :price, :date)
        ");

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $image_path);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
        header("Location: index.php");
    }
}

?>

<?php include_once "../../views/partials/header.php" ?>
<body>
    <div class="container">
        <h1>Create Product</h1>
        <a href="index.php" class="btn btn-secondary">Go back to products</a>
        <?php include_once "../../views/partials/form.php" ?>
        <button type="submit" class="btn btn-outline-primary">Create products</button>
    </div>
</body>

</html>
