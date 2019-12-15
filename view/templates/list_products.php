<h2>Products</h2>
<h5><?php echo isset($message) ? $message : ''; ?></h5>
<?php
foreach ($products as $product) {
    $id = $product->getID();
    $image = $product->getProductImage();
    echo "<span class=\"product\">$product</span><img src='assets/images/$image'> <a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
}
?>
<a href="index.php?action=add_product">Add Product</a>
