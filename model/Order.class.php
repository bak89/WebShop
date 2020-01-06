<?php

class Order
{
    private $order_ID;
    private $user_ID;
    private $product_ID;


    public function __toString()
    {
        return sprintf(" %s - %s - %s", $this->order_ID, $this->product_ID, $this->user_ID);
    }

    static public function insert($values)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO orders (product_ID, user_ID) VALUE (?,?,?)")) {
            if ($stmt->bind_param('sss', $values['order_ID'], $values['user_ID'], $values['product_ID'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    static public function delete($id)
    {
        $id = (int)$id;
        $res = DB::doQuery("DELETE FROM products WHERE ID = $id");
        return $res != null;
    }


    public function update($values)
    {
        $db = DB::getInstance();
        $this->order_ID= $db->escape_string($values['order_ID']);
        $this->user_ID = $db->escape_string($values['user_ID']);
        $this->product_ID = $db->escape_string($values['product_ID']);
    }

    public function save()
    {
        $sql = sprintf("UPDATE products SET user_ID='%s',product_ID='%s' WHERE order_ID= %d;", $this->user_ID, $this->product_ID,$this->order_ID);
        echo "<!-- SQL: $sql -->";
        $res = DB::doQuery($sql);
        return $res != null;
    }

    static public function getAllOrders()
    {
        $orders = array();
        $res = DB::doQuery("SELECT * FROM orders");
        if ($res) {
            while ($order = $res->fetch_object(get_class())) {
                $orders[] = $order;
            }
        }
        return $orders;
    }

    static public function getOrderById($id)
    {
        $id = (int)$id;
        $res = DB::doQuery("SELECT * FROM orders WHERE order_ID = $id");
        if ($res) {
            if ($order = $res->fetch_object(get_class())) {
                return $order;
            }
        }
        return null;
    }
}
