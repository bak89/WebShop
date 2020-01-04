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
    <div class="img-container"><img class='prod-img' src='assets/images/<?= $image ?>'></div>
    <div class="description-container">
        <p class='name' class=\"prod-name\"><?= $name ?></p>
        <p class='description'><?= $desc ?></p>
        <p class='price'>CHF <?= $price ?></p>
        <form class="add-to-cart" id="formCart" method="post">
            <input hidden name="item[id]" value="<?= $id ?>"/><br/>
            <input hidden name="item[num]" type="number" value="1"/><br/>
            <input class="btn" type="submit" value="<?= $this->tr('addToCart') ?>"/>
        </form>
    </div>
</div>



