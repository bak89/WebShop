<?php if ($this->controller->isAdmin()) echo "
<p>Admin Options</p>
<div class='admin-options'>
<p class='option'> <a href='index.php?action=list_users'>The list of users</a> </p>
<p class='option'><a href=\"index.php?action=add_product\">Add Product</a></p>
</div>" ?>

<div class="product-gallery">
    <!--all product-->
    <?php
    foreach ($products as $product) {
    $id = $product->getID();
    $image = $product->getProductImage();
    $name = $product->getProductName();
    $price = $product->getProductPrice();

    echo "<a id=\"product-page\" href=\"" . $this->build_url('index.php', array('action' => 'product_page', 'id' => $id)) . " \">";

    echo "<div class=product-container>";

    echo "<p class='name' class=\"prod-name\">$name</p>";
    ?>
    <div class='image-container'>
        <?php
        echo "<img class='prod-img' src='assets/images/$image'>";
        ?>
    </div>
    <?php echo "<p class='price'>CHF $price</p>";

    if ($this->controller->isAdmin()) echo
        "<a href=\"" . $this->build_url('index.php', array('action' => 'edit_product','id'=>$id)) . " \">
                    <button>Edit</button>
                </a> | <a href=\"" . $this->build_url('index.php', array('action' => 'delete_product','id'=>$id)) . " \">
                    <button>Delete</button>
                </a>";
    ?>
</div>
<?php
}
?>
</div>