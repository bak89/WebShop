<?php
class User {
	private $id;
	private $name;
	private $email;
	private $password;
	private $userType;

	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getUserType() {
		return $this->userType;
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
}
