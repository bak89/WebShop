<h3>Home</h3>
<h5><?php echo isset($message) ? $message : ''; ?></h5>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=list_users\">The list of users</a>"; ?> </p>
<p><?php if ($this->controller->isAdmin()) echo "<a href=\"index.php?action=add_product\">Add Product</a>"; ?> </p>

<!--all product-->
<?php
foreach ($products as $product) {
    $id = $product->getID();
    $image = $product->getProductImage();
    if ($this->controller->isAdmin()){
        echo "<span class=\"product\">$product</span><img src='assets/images/$image'> <a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
    } else{
        ?>
        <span class="product"><?=$product?></span><img src='assets/images/<?=$image?>'><br/>

        <form class="Add2Cart" method="post">
            <input hidden name="item[id]" value="<?=$id?>"/><br/>
            <input hidden name="item[num]" type="number" value="1"/><br/>
            <input type="submit" value="Add"/>
        </form>
        <?php
    }
}
?>
