<h2>Edit Product</h2>
<form method="post" action="index.php">
    <p><label>Type</label><input name="product[productType]" value="<?php echo $product->getProductType()?>" type="text"></p>
    <p><label>Name</label><input name="product[productName]" value="<?php echo $product->getProductName()?>" type="text"/></p>
    <p><label>productDescriptionDE</label><input name="product[productDescriptionDE]" value="<?php echo $product->getProductDescriptionDE()?>" type="text"/></p>
    <p><label>productDescriptionIT</label><input name="product[productDescriptionIT]" value="<?php echo $product->getProductDescriptionIT()?>" type="text"/></p>
    <p><label>productDescriptionEN</label><input name="product[productDescriptionEN]" value="<?php echo $product->getProductDescriptionEN()?>" type="text"/></p>
    <p><label>Price</label><input name="product[productPrice]" value="<?php echo $product->getProductPrice()?>" type="number"/></p>
    <p><label>Image</label><input name="product[productImage]" value="<?php echo $product->getProductImage()?>" type="text"></p>

    <p><input type="submit" value="Save"></p>
	<input type="hidden" name="product[id]" value="<?php echo $product->getID()?>" />
	<input type="hidden" name="action" value="update_product" />
</form>
