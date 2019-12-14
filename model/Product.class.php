<?php

class Product
{
    private $ID;
    private $productType;
    private $productName;
    private $productPrice;
    private $productDescriptionDE;
    private $productDescriptionIT;
    private $productDescriptionEN;
    private $productImage;

    public function getID()
    {
        return $this->ID;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function getProductType()
    {
        return $this->productType;
    }

    public function getProductDescriptionDE()
    {
        return $this->productDescriptionDE;
    }

    public function getProductDescriptionIT()
    {
        return $this->productDescriptionIT;
    }

    public function getProductDescriptionEN()
    {
        return $this->productDescriptionEN;
    }

    public function getProductImage()
    {
        return $this->productImage;
    }


    public function __toString()
    {
        return sprintf("%d) %s %s %s", $this->ID, $this->productName, $this->productPrice, $this->productType);
    }

    static public function insert($values)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO products (productType , productName,productDescriptionDE,productDescriptionIT,productDescriptionEN,productPrice) VALUE (?,?,?,?,?,?,?)")) {
            if ($stmt->bind_param('ssssss', $values['type'], $values['name'], $values['descriptionDE'], $values['descriptionIT'], $values['descriptionEN'], $values['price'])) {
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


    public function update($id)
    {
        $db = DB::getInstance();
        $this->productType = $db->escape_string($values['type']);
        $this->productName = $db->escape_string($values['name']);
        $this->productPrice = (double)$values['price'];
        $this->productDescriptionDE = $db->escape_string($values['desc_de']);
        $this->productDescriptionIT = $db->escape_string($values['desc_it']);
        $this->productDescriptionEN = $db->escape_string($values['desc_en']);
        $this->productImage = $db->escape_string($values['image']);
    }

    public function save()
    {
        $sql = sprintf("UPDATE products SET productType='%s',productName='%s', productDescriptionDE='%s', productDescriptionIT='%s', productDescriptionEN='%s', price=%d, productImage='%s'  WHERE id= %d;", $this->productType, $this->productName, $this->productDescriptionDE, $this->productDescriptionIT, $this->productDescriptionEN, $this->productPrice, $this->productImage);
        $res = DB::doQuery($sql);
        return $res != null;
    }

    static public function getAllProducts()
    {
        $products = array();
        $res = DB::doQuery("SELECT * FROM products");
        if ($res) {
            while ($product = $res->fetch_object(get_class())) {
                $products[] = $product;
            }
        }
        return $products;
    }

    static public function getProduct($orderBy = 'name')
    {
        $orderByStr = '';
        if (in_array($orderBy, ['id', 'name'])) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $products = array();
        $res = DB::doQuery("SELECT * FROM products $orderByStr");
        if ($res) {
            while ($product = $res->fetch_object(get_class())) {
                $products[] = $product;
            }
        }
        return $products;
    }

    static public function getProductById($id)
    {
        $id = (int)$id;
        $res = DB::doQuery("SELECT * FROM products WHERE id = $id");
        if ($res) {
            if ($product = $res->fetch_object(get_class())) {
                return $product;
            }
        }
        return null;
    }

}
