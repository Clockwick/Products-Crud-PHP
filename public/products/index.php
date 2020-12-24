<?php

require_once "../../views/database.php";
$search = $_GET['search'] ?? '';
if (!$search) {
  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
} else {
  $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
  $statement->bindValue(':title', "%$search%");
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once "../../views/partials/header.php" ?>
<body> <div class="container">


        <h1>Products CRUD</h1>
        <p>
            <a href="create.php" class="btn btn-primary">Create</a>
        </p>
        <form>
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?php echo $search ?>">
            <button class="btn btn-outline-primary" type="submit" >Search</button>
          </div>
        </form>
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
