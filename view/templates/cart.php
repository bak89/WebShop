<h4>My Shopping Cart</h4>
<div id="cart-holder">
    <?//php $cart->render(); ?>
</div>


<h4>Add Item</h4>
<form id="form" method="post">
    <label>Product Id</label> <input name="item[id]" /><br />
    <label>Number</label> <input name="item[num]" type="number"/><br />
    <input type="submit" value="Add" />
</form>