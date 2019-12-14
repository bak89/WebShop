<?php

class Product
{
    private $id;
    private $type;
    private $name;
    private $price;
    private $descriptionDE;
    private $descriptionIT;
    private $descriptionEN;
    private $image;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescriptionDE()
    {
        return $this->descriptionDE;
    }

    public function getDescriptionIT()
    {
        return $this->descriptionIT;
    }

    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    public function getImage()
    {
        return $this->image;
    }


    public function __toString()
    {
        return sprintf("%d) %s %s %s", $this->id, $this->name, $this->price,$this->type);
    }

    static public function insert($values)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO product (productID, productType , productName,productDescriptionDE,productDescriptionIT,productDescriptionEN,productPrice) VALUE (?,?,?,?,?,?,?)")) {
            if ($stmt->bind_param('sssssss', $values['id'], $values['type'], $values['name'], $values['descriptionDE'], $values['descriptionIT'], $values['descriptionEN'], $values['price'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    static public function getProduct($orderBy = 'name')
    {
        $orderByStr = '';
        if (in_array($orderBy, ['id', 'name'])) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $products = array();
        $res = DB::doQuery("SELECT * FROM product $orderByStr");
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
        $res = DB::doQuery("SELECT * FROM product WHERE id = $id");
        if ($res) {
            if ($product = $res->fetch_object(get_class())) {
                return $product;
            }
        }
        return null;
    }

}
