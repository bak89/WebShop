<?php

class Order
{
    private $id;
    private $userId;
    private $orderItems;


    public function __toString()
    {
        return sprintf(" %s - %s - %s", $this->id, $this->orderItems, $this->userId);
    }

    static public function insert($userId,$items)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO orders (userId, orderItems) VALUE (?,?)")) {
            if ($stmt->bind_param('ss',$userId, $items)) {
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
        $this->id= $db->escape_string($values['id']);
        $this->userId = $db->escape_string($values['userId']);
        $this->orderItems = $db->escape_string($values['orderItems']);
    }

    public function save()
    {
        $sql = sprintf("UPDATE products SET user_ID='%s',product_ID='%s' WHERE order_ID= %d;", $this->userId, $this->orderItems,$this->id);
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
        $res = DB::doQuery("SELECT * FROM orders WHERE id = $id");
        if ($res) {
            if ($order = $res->fetch_object(get_class())) {
                return $order;
            }
        }
        return null;
    }
}
