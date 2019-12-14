<?php
class User {
	private $ID;
	private $Name;
	private $Email;
	private $Password;
	private $UserType;

	public function getID() {
		return $this->ID;
	}
	public function getName() {
		return $this->Name;
	}
	public function getEmail() {
		return $this->Email;
	}
	public function getPassword() {
		return $this->Password;
	}
	public function getUserType() {
		return $this->UserType;
	}

    public function __toString()
    {
        return sprintf("%d) %s %s %s", $this->ID, $this->Name, $this->Email,$this->UserType);
    }

	static public function insert($values) {
		if ( $stmt = DB::getInstance()->prepare("INSERT INTO users (Name, Email , Password, UserType) VALUE (?,?,?,?)")){
			if ($stmt->bind_param('ssss', $values['name'], $values['email'], $values['password'], $values['userType'])) {
				if ($stmt->execute()) {
					return true;
				}
			}
		}
		return false;
	}

    static public function delete_user($values) {
        if ( $stmt = DB::getInstance()->prepare("DELETE FROM users WHERE VALUE (?,?)")){
            if ($stmt->bind_param('ss', $values['email'], $values['userType'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }


	public static function checkCredentials($login, $password) {
		if ($stmt = DB::getInstance()->prepare("SELECT Email,Password FROM users WHERE Email = ? AND Password = ? ")) {
			if ($stmt->bind_param('ss', $values['email'], $values['password'])) {
				if ($stmt->execute()) {
					return true;
				}
		}
	}
	return false;
		//return isset(self::$users[$login]) && self::$users[$login] == $password;
	}

    static public function getUser($orderBy="id")
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

     /*   $res = DB::doQuery("SELECT u.*, p.title AS 'user_list' FROM users u LEFT OUTER JOIN project p ON s.project_id = p.id$orderByStr");
        if ($res) {
            while ($user = $res->fetch_object(get_class())) {
                $users[] = $user;
            }
        }
        return $users;
    }*/

    static public function getUserById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM users WHERE id = $id");
        if ($res) {
            if ($user = $res->fetch_object(get_class())) {
                return $user;
            }
        }
        return null;
    }
}
