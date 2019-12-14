<?php

class User
{
    private $ID;
    private $Name;
    private $Email;
    private $Password;
    private $UserType;

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

    static public function insert($values)
    {
        if ($stmt = DB::getInstance()->prepare("INSERT INTO users (Name, Email , Password, UserType) VALUE (?,?,?,?)")) {
            if ($stmt->bind_param('ssss', $values['name'], $values['email'], $values['password'], $values['userType'])) {
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
        if (in_array($orderBy, ['id', 'name', 'email', 'password'])) {
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

    public function update($values)
    {
        $db = DB::getInstance();
        $this->Name = $db->escape_string($values['name']);
        $this->Email = $db->escape_string($values['email']);
        $this->Password = $db->escape_string($values['password']);
        $this->UserType = $db->escape_string($values['userType']);
    }

    public function save()
    {
        $sql = sprintf("UPDATE users SET Name='%s', Email='%s', Password='%s', UserType='%s' WHERE id = %d;", $this->Name, $this->Email, $this->Password, $this->UserType, $this->ID);
        $res = DB::doQuery($sql);
        return $res != null;
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
}
