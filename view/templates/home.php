<h3>Welcome!</h3>
<h5>See our newest products...</h5>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=list_users\">The list of users</a>"; ?> </p>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=add_product\">Add Product</a>"; ?> </p>

<div class="product-gallery">
    <!--all product-->
    <?php
    foreach ($products as $product) {
    $id = $product->getID();
    $image = $product->getProductImage();
    $name = $product->getProductName();
    $price = $product->getProductPrice();

    echo "<a id=\"product-page\" href='index.php?action=product_page&id=$id'>";
    //id?
    echo "<div class=product-container>";

    echo "<p class='name' class=\"prod-name\">$name</p>";
    ?>
    <div class='image-container'>
        <?php
    echo "<img class='prod-img' src='assets/images/$image'>";
    ?>
    </div>
    <?php
    echo "<p class='price'>CHF $price</p>";

    if ($this->controller->isAdmin()) {
        echo "<br><a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
    }
    ?>
</div>
<?php
}
?>
</div>
