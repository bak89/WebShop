<?php

class View {

	private $controller;

	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}

	public function render($tpl) {
		$innerTpl = __DIR__ ."/templates/$tpl.php";
		if(!file_exists($innerTpl)) {
			throw new Exception("The template '$innerTpl.php' does not exist!");
		}
		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		$title = $this->controller->getTitle();
		$title = "GA*AG" .($title ? " - ".$title : "");
		include __DIR__ ."/templates/main.php";
	}
}
