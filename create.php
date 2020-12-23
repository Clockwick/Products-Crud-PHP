<?php
require_once 's.php';
$pdo = new PDO($sql_param_1, $sql_param_2, $sql_param_3);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$title = '';
$description = '';
$price = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');
    
    $image = $_FILES['image'] ?? null;
    $image_path = '';

    if (!is_dir("images")) 
    {
        mkdir("images");
    }
    if ($image && $image['tmp_name']) {
        $image_path = 'images/'.randomString(10).'/'.$image["name"];
        mkdir(dirname($image_path));
        move_uploaded_file($image['tmp_name'], $image_path);
    }

    if (empty($title)) {
        $errors[] = "Please inform title";
    }
    if (empty($price)) {
        $errors[] = "Please inform price";
    }
    if (empty($errors)) {
        $statement = $pdo->prepare("
            INSERT INTO products (title, image, description, price, create_date) 
            VALUES (:title, :image, :description, :price, :date)
        ");

        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $image_path);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', $date);
        $statement->execute();
        header("Location: index.php");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Products CRUD</title>
</head>

<body>
    <div class="container">
        <h1>Create Product</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <div> <?php echo $error ?> </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product image</label><br>
                <input type="file" name="image">
            </div>
            <div class="mb-3">
                <label class="form-label">Product title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Product description</label>
                <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Product price</label>
                <input type="number" step=".01" min="0.01" class="form-control" name="price" value="<?php echo $price ?>">
            </div>
            <button type="submit" class="btn btn-outline-primary">Create products</button>
        </form>
    </div>
</body>

</html>