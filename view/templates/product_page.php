<?php
/*foreach ($products as $product) {
$id = $product->getID();
$image = $product->getProductImage();
$name = $product->getProductName();

echo "<p class='name' class=\"prod-name\">$name</p>";
echo "<img class='prod-img' src='assets/images/$image'>";*/
?>

<form class="Add2Cart" method="post">
    <input hidden name="item[id]" value="<?= $id ?>"/><br/>
    <input hidden name="item[num]" type="number" value="1"/><br/>
    <input type="submit" value="Add"/>
</form>
<?php
}