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
		/*function t($key) {
		    // return i18n->t($key);
        }*/
		$title = $this->controller->getTitle();
		$title = "GA*AG" .($title ? " - ".$title : "");
		include __DIR__ . "/templates/main.php";
	}

    public function url_with_language($lang)
    {
        parse_str($_SERVER['QUERY_STRING'], $query_data);
        $query_data['lang'] = $lang;
        return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($query_data);
    }
}
