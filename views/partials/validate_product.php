<?php
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    

    if (!is_dir("images")) 
    {
        mkdir("images");
    }

    if (empty($title)) {
        $errors[] = "Please inform title";
    }
    if (empty($price)) {
        $errors[] = "Please inform price";
    }
    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $image_path = $product['image'];

        if ($image && $image['tmp_name']) {
            if ($product['image']) {
              unlink($product['image']);
            }
            $image_path = 'images/'.randomString(10).'/'.$image["name"];
            mkdir(dirname($image_path));
            move_uploaded_file($image['tmp_name'], $image_path);
        }

  }
?>
