<h3>Home</h3>
<h5><?php echo $message; ?></h5>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=list_users\">The list of users</a>"; ?> </p>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=list_products\">The list of products</a>"; ?> </p>

<!--all product-->
<?php
foreach ($products as $product) {
    $id = $product->getID();
    $image = $product->getProductImage();
    echo "<span class=\"product\">$product</span><img src='assets/images/$image'><br/>";
}
?>