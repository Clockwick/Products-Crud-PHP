<?php
require_once 's.php';
$pdo = new PDO($sql_param_1, $sql_param_2, $sql_param_3);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Products CRUD</title>
</head>
<body> <div class="container">


        <h1>Products CRUD</h1>
        <p>
            <a href="create.php" class="btn btn-primary">Create</a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $i => $product) : ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td>
                            <?php if ($product["image"]) : ?>
                                <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['title']; ?>" class="thumbnail-img">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $product['title'] ?></td>
                        <td>$<?php echo number_format($product['price'], 2, '.', ',') ?></td>
                        <td><?php echo $product['create_date'] ?></td>
                        <td>
                        <a href="update.php?id=<?php echo $product['product_id'] ?>"><button type="button" class="btn btn-sm btn-outline-primary">Edit</button></a>
                            <form action="delete.php" method="post" style="display: inline-block">
                              <input type="hidden" name="id" value="<?php echo $product['product_id'] ?>">
                              <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>

                        </td
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>
