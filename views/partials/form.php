
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div> <?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<form action="" method="post" enctype="multipart/form-data">
    <?php if (!empty($product['image'])): ?>
      <img class="update-image"src="<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" >
    <?php endif; ?>

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
</form>
