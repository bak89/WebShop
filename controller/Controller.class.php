<?php

class Controller {

	private $data = array();
	private $title = "";

	// A C T I O N S

	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
		$this->title = "Home";
	}

	public function contact(Request $request) {
		$this->title = "Contact";
	}

	public function list_students(Request $request) {
		//$sort = isset($_GET['sort']) ? $_GET['sort'] : 'lastname';
		$sort = $request->getParameter('sort', 'lastname');
		$this->data["students"] = Student::getStudents($sort);
	}

	public function edit_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To edit a Student, please login first!";
			return 'login';
		}
		$id = $request->getParameter('id', 0);
		$student = Student::getStudentById($id);
		if (!$student) {
			return $this->page404();
		}
		$this->data['student'] = $student;
		$this->data['projects'] = Project::getProjects();
	}

	public function update_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To update a Student, please login first!";
			return 'login';
		}
		$values = $request->getParameter('student', array());
		$student = Student::getStudentById($values['id']);
		if (!$student) {
			return $this->page404();
		}
		$student->update($values);
		$student->save();
		$this->data['message'] = "Student updated successfully!";
		//return 'list_students';

		// external redirect
		//header('Location: index.php?action=list_students');
		//exit();

		//internal page redirect
		return $this->internalRedirect('list_students', $request);
	}

	public function login(Request $request) {
		$login = $request->getParameter('login', '');
		$password = $request->getParameter('password', '');

		if (!User::checkCredentials($login, $password)) {
			$this->data['message'] = "Sorry, wrong credentials!";
			return;
		}
		$this->startSession();
		$_SESSION['user'] = $login;
		$this->data['message'] = "Hi " .ucfirst($login) .", you just logged in!";
		return 'home';
	}

	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		$_SESSION = array();
		$this->data['message'] = "Und Tschüss!";
		return 'home';
	}

	public function signUpUser(Request $request){
    $values = $request->getParameter('user', array());
		$user = User::insert($values);
		if (!$user) {
			return $this->page404();
		}
		$this->data['message'] = "User created successfully!";
		return 'home';
	}

	public function signUp(Request $request){
		$this->data["message"] = "Hello World!";
		$this->title = "Sign Up";
	}

	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}


	// H E L P E R S

	public function &getData() {
		return $this->data;
	}

	public function isLoggedIn() {
		$this->startSession();
		return isset($_SESSION['user']);
	}

	public function getTitle() {
		return $this->title;
	}


	// P R I V A T E  H E L P E R S

	private $sessionState = false;

	private function startSession() {
		if ($this->sessionState == false) {
			$this->sessionState = session_start();
		}
	}

	private function page404() {
		header('HTTP/1.1 404 Not Found');
		return 'page404';
	}

	private function internalRedirect($action, $request) {
		$tpl = $this->$action($request);
		return $tpl ? $tpl : $action;
	}

}
