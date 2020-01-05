<?php

class View {

	private $controller;
	private $language;
	private $messages;

	public function __construct(Controller $controller, Request $request) {
		$this->controller = $controller;
		$this->language = $request->getParameter('lang', 'en');
		$this->messages = array();
		$this->load_language();
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
		include __DIR__ . "/templates/main.php";
	}

	public function build_url($url, $query_data) {
		$query_data['lang'] = $this->language;
		return $url . '?' . http_build_query($query_data);
	}

	public function render_navbar() {
		echo '<ul>';
		echo $this->render_navigation();
		echo $this->render_languages();
		echo '</ul>';
	}

	private function render_navigation()
	{
		$navs = array(
			'home' => array('action' => 'home'),
			'men' => array('action' => 'product_overview', 'type' => 'men'),
			'women' => array('action' => 'product_overview', 'type' => 'women'),
			'gift' => array('action' => 'product_overview', 'type' => 'gift'),
		);
		foreach ($navs as $nav => $query) {
			parse_str($_SERVER['QUERY_STRING'], $query_data);
			$class = 'active';
			foreach ($query as $key => $value) {
				if (!isset($query_data[$key]) || $query_data[$key] !== $value) {
					$class = 'inactive';
				}
			}
			echo '<li><a class="'
				 . $class . '" href="' . $this->build_url('index.php', $query) . '">'
				 . $this->tr($nav) . '</a></li>';
		}
	}

    public function url_with_language($lang)
    {
        parse_str($_SERVER['QUERY_STRING'], $query_data);
        $query_data['lang'] = $lang;
        return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($query_data);
	}

	function render_languages()
	{
		$languages = array('en', 'de', 'it');
		foreach ($languages as $lang) {
			$class = $this->language == $lang ? 'active' : 'inactive';
			echo '<li style="float:right"><a class="'
				 . $class . '" href="' . $this->url_with_language($lang) . '">'
				 . strtoupper($lang) . '</a></li>';
		}
	}

	// The translation function.
	public function tr($key)
	{
	    return $this->messages[$key];
	}

	private function load_language() {
		//include 'messages/' . $this->language . '.php';
		//$this->messages = $lang;
        $contents = file_get_contents('messages/' . $this->language . '.json');
        $contents = utf8_encode($contents);
        $this->messages = json_decode($contents,true);
	}
}
