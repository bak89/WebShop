<?php

class Request {

	private $params;

	public function __construct() {
		$this->params = array_merge($_GET, $_POST);
	}

	public function isParameter($param) {
		return isset($this->params[$param]);
	}

	public function getParameter($param, $default=null) {
		if ($this->isParameter($param)) {
			return $this->params[$param];
		} else {
			return $default;
		}
	}
}
