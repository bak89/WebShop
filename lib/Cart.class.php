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

    public function isEmpty() {
        return count($this->items) == 0;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item => $num) {
            $p = Product::getProductById($item)->getProductPrice();
            $total += $num * $p;
        }
        return $total;
    }

    public function render() {
        if ($this->isEmpty()) {
            echo "<div class=\"cart empty\">[Empty Cart]</div>";
        } else {
            echo "<div class=\"cart\"><table>";
            echo "<tr><th>Article-ID</th><th>#</th></tr>";
            $items = $this->getItems();
            //for checkout
            $itemIds = array();
            $amounts = array();
            foreach ($items as $item => $num) {
                $product = Product::getProductById($item);
                $id = $product->getID();
                $id = (int)$id;

                //for checkout
                array_push($itemIds,$id);
                array_push($amounts,$num);

                echo "<tr><td>" . $product->getProductName() . "</td><td><div class=\"plus & minus\">

                           
                            <form class=\"Add2Cart\" method=\"post\">
                                <input type='text' name='amount' class='updateCart item-" .$id. " ' value='$num' min='1'>
                                <input type='hidden' name='order_id' value='" . $product->getID() . "'>
                            </form>
                            <td><button class=\"pm-btn\" onclick='updateAmount(`-`, `item-" .$id . "`,`". $id ."`)'>-</button></td>
                            <td><button class=\"pm-btn\" onclick='updateAmount(`+`, `item-" .$id . "`,`". $id ."`)'>+</button></td>
                       </div></td>   
                       <td><button onclick='removeItem(".$id.")'>Remove</button></td>
                       </tr>";
            }
            echo "<tr><th id=\'total\'>TOTAL CHF</th><th>" . $this->getTotal() . "</th></tr>";
            echo "</table>
            
            <form method=\"post\"> 
                <input type=\"submit\" name=\"checkout\" value=\"Checkout\"/> 
            </form> 
            </div>";
            if(array_key_exists('checkout',$_POST)){
                if(!isset($_SESSION['user'])){
                    echo "<p>Please log in to checkout!</p>";
                    return;
                }
                $mail = $_SESSION['user'];
                $user = User::getUserByEmail($mail);
                $uid = $user->getID();
                $orderItems ='/';
                for ($i = 0; $i < sizeof($itemIds); $i++){
                    $it = $itemIds[$i];
                    $p = Product::getProductById($it);
                    $name = $p->getProductName();
                    $orderItems .= "{$amounts[$i]} x {$name} /";
                }
                Order::insert($uid,$orderItems);
                echo "<script type='text/javascript'>window.top.location='index.php?action=order_complete';</script>"; exit;
            }
        }
    }
}

