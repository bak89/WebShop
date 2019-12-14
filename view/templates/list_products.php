<h2>Products</h2>
<h5><?php echo isset($message) ? $message : ''; ?></h5>
<?php
foreach ($products as $product) {
    $name = $product->getName();
    $id = $product->getId();
    echo "<span class=\"user\">$product</span> <a href=\"index.php?action=edit_user&name=$name\">Edit</a> | <a href=\"index.php?action=delete_user&id=$id\">Delete</a><br/>";
}
?>