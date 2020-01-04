<?php

class Cart
{
    // product id <-> num
    private $items = [];

    public function addItem($itemId, $num) {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId] += $num;
        } else {
            $this->items[$itemId] = $num;
        }
    }

    public function removeItem($itemId, $num) {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId] -= $num;
            $this->items;
            if ($this->items[$itemId] <= 0) {
                unset($this->items[$itemId]);
            }
        } else {
            $this->items[$itemId] = $num;
        }
    }

    public function updateItem($itemId, $num) {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId] += $num;
            if ($this->items[$itemId] <= 0) {
                unset($this->items[$itemId]);
            }
        } else {
            $this->items[$itemId] = $num;
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function isEmpty()
    {
        return count($this->items) == 0;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item => $num) {
            $p = Product::getProductById($item)->getProductPrice();
            $total += $num * $p;
        }
        return $total;
    }

    public function render()
    {
        if ($this->isEmpty()) {
            echo "<div class=\"cart empty\">[Empty Cart]</div>";
        } else {
            echo "<div class=\"cart\"><table>";
            echo "<tr><th>Article-ID</th><th>#</th></tr>";
            foreach ($this->items as $item => $num) {
                $product = Product::getProductById($item);
                // var_dump($product);
                $id = $product->getID();
                echo "<tr><td>" . $product->getProductName() .
                    " </td><td><div class=\"plus & minus\">
                            <form class=\"Add2Cart\" method=\"post\">
                                <input type='number' name='amount' class='updateCart' value='$num' min='1'>
                                <input type='hidden' name='order_id' value='" . $product->getID() . "'>
                            </form>
                       </div></td>
                       <td><button onclick='removeItem(".$id.")'>Remove</button></td>
                       </tr>";
            }
            echo "<tr><th>TOTAL</th><th>" . $this->getTotal() . "</th></tr>";
            echo "</table></div>";
        }
    }

}

