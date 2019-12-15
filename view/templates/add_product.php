<div>
    <h1>Add a Product</h1>
    <form class="ui form" action="index.php?action=addProduct" method="post">
        <div class="field">
            <label>Type</label>
            <input id="productType" type="text" name="product[productType]" placeholder="Type">
        </div>
        <div class="field">
            <label>Name</label>
            <input id="productName" type="text" name="product[productName]" placeholder="Name of Product">
        </div>
        <div class="field">
            <label>DescriptionDE</label>
            <input id="productDescriptionDE" type="text" name="product[productDescriptionDE]" placeholder="Description in DE">
        </div>
        <div class="field">
            <label>DescriptionIT</label>
            <input id="productDescriptionIT" type="text" name="product[productDescriptionIT]" placeholder="Description in IT">
        </div>
        <div class="field">
            <label>DescriptionEN</label>
            <input id="productDescriptionEN" type="text" name="product[productDescriptionEN]" placeholder="Description in EN">
        </div>
        <div class="field">
            <label>Price</label>
            <input id="productPrice" type="number" name="product[productPrice]" placeholder="Price">
        </div>
        <div class="field">
            <label>Image</label>
            <input id="productImage" type="text" name="product[productImage]" placeholder="Img">
        </div>

        <button class="ui button" type="submit">Submit</button>
    </form>
</div>