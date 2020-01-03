<?php

$id = $product->getID();
$image = $product->getProductImage();
$name = $product->getProductName();
$price = $product->getProductPrice();
$descEN = $product->getProductDescriptionEN();

?>

<div class="container">
    <div class="img-container"> <?php echo "<img class='prod-img' src='assets/images/$image'>"; ?></div>
    <div class="description-container">
        <?php
        echo "<p class='name' class=\"prod-name\">$name</p>";
        echo "<p class='description'>$descEN</p>";
        echo "<p class='price'>CHF $price</p>"
        ?>
        <form class="add-to-cart" id="formCart" method="post">
            <input hidden name="item[id]" value="<?= $id ?>"/><br/>
            <input hidden name="item[num]" type="number" value="1"/><br/>
            <input class="btn" type="submit" value="Add to cart"/>
        </form>
    </div>
</div>



