<?php

class User
{
    private $ID;
    private $Name;
    private $LastName;
    private $Email;
    private $Password;
    private $UserType;
    private $Street;
    private $Zip;
    private $City;

    static public function insert($values)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO users (Name, LastName, Email , Password, UserType,Street,Zip,City) VALUE (?,?,?,?,?,?,?,?)")) {
            if ($stmt->bind_param('ssssssss', $values['name'], $values['lastname'],$values['email'], $values['password'], $values['userType'], $values['street'], $values['zip'], $values['city'])) {
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
        $res = DB::doQuery("DELETE FROM users WHERE id = $id");
        return $res != null;
    }

    public static function checkCredentials($login, $password)
    {
        $users = User::getUser('id');
        foreach ($users as $user) {
            if ($user->Email == $login && $user->Password == $password) {
                return $user;
            }
        }
        return null;
        //return isset(self::$users[$login]) && self::$users[$login] == $password;
    }

    static public function getUser($orderBy = "id")
    {
        $orderByStr = '';
        if (in_array($orderBy, ['id', 'name', 'lastname', 'email', 'password'])) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $users = array();

        $res = DB::doQuery("SELECT * FROM users $orderByStr");
        if ($res) {
            while ($user = $res->fetch_object(get_class())) {
                $users[] = $user;
            }
        }
        return $users;
    }

    static public function getUserById($id)
    {
        $id = (int)$id;
        $res = DB::doQuery("SELECT * FROM users WHERE id = $id");
        if ($res) {
            if ($user = $res->fetch_object(get_class())) {
                return $user;
            }
        }
        return null;
    }

    public function getLastName()
    {
        return $this->LastName;
    }

    public function getStreet()
    {
        return $this->Street;
    }

    public function getZip()
    {
        return $this->Zip;
    }

    public function getCity()
    {
        return $this->City;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function getUserType()
    {
        return $this->UserType;
    }

    public function __toString()
    {
        return sprintf("%d) %s %s %s", $this->ID, $this->Name, $this->Email, $this->UserType);
    }

    public function update($values)
    {
        $db = DB::getInstance();
        $this->Name = $db->escape_string($values['name']);
        $this->LastName = $db->escape_string($values['lastname']);
        $this->Email = $db->escape_string($values['email']);
        $this->Password = $db->escape_string($values['password']);
        $this->UserType = $db->escape_string($values['userType']);
        $this->Street = $db->escape_string($values['street']);
        $this->Zip = $db->escape_string($values['zip']);
        $this->City = $db->escape_string($values['city']);
    }

    public function save($user)
    {
        $sql = sprintf("UPDATE users SET Name='%s',LastName='%s', Email='%s', Password='%s', UserType='%s',Street='%s',Zip='%s',City='%s' WHERE id = %d;", $user->Name, $user->LastName, $user->Email, $user->Password, $user->UserType, $user->Street, $user->Zip, $user->City);
        $res = DB::doQuery($sql);
        return $res != null;
    }

}
