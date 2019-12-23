<?php ?>

<form class="Add2Cart" method="post">
    <input hidden name="item[id]" value="<?= $id ?>"/><br/>
    <input hidden name="item[num]" type="number" value="1"/><br/>
    <input type="submit" value="Add"/>
</form>
