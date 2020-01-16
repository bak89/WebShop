<?php

$id = $product->getID();
$image = $product->getProductImage();
$name = $product->getProductName();
$price = $product->getProductPrice();
switch ($this->language) {
    case 'en': $desc = $product->getProductDescriptionEN(); break;
    case 'it': $desc = $product->getProductDescriptionIT(); break;
    case 'de': $desc = $product->getProductDescriptionDE(); break;
}
?>

<div class="container">
    <div class="img-container"><img class='product-img' src='assets/images/<?= $image ?>'></div>
    <div class="description-container">
        <p class='name' class=\"prod-name\"><?= $name ?></p>
        <p class='description'><?= $desc ?></p>
        <p class='price'>CHF <?= $price ?></p>
        <form class="add-to-cart" id="formCart" method="post">
            <input class="add-btn" type="button" onclick="addItem(<?= $id ?>)" value="<?= $this->tr('addToCart') ?>"/>
        </form>
    </div>
</div>



