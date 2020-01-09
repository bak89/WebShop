<div class="product-gallery">
    <!--all product-->
    <?php

    $selected = $_GET["type"];

    foreach ($products as $product) {
    $id = $product->getID();
    $type = $product->getProductType();
    $image = $product->getProductImage();
    $name = $product->getProductName();
    $price = $product->getProductPrice();

    if($type == $selected){

    //echo "<a id=\"product-page\" href=\"".$this->build_url('index.php', array('action' => 'product_page'))."&id=$id \"></a>";

   echo "<a id=\"product-page\" href='index.php?action=product_page&id=$id'>";

    echo "<div class=product-container>";

    echo "<p class='name' class=\"prod-name\">$name</p>";
    ?>
    <div class='image-container'>
        <?php
        echo "<img class='prod-img' src='assets/images/$image'>";
        ?>
    </div>
    <?php echo "<p class='price'>CHF $price</p>";

    /*if ($this->controller->isAdmin()) {
    echo "<br><a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
    }*/
    ?>
</div>
<?php
}}
?>
</div>