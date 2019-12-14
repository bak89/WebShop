<?php

class Controller {

	private $data = array();
	private $title = "";

	// A C T I O N S

	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
		$this->title = "Home";
	}

	public function contactUs(Request $request) {
		$this->title = "Contact Us";
	}

	public function aboutUs(Request $request){
	    $this->title = "About Us";
    }

    // USER

	public function list_users(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["users"] = User::getUser($sort);
	}

	public function edit_user(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To edit a User, please login first!";
			return 'login';
		}
		$id = $request->getParameter('id', 0);
		$user = User::getUserById($id);
		if (!$user) {
			return $this->page404();
		}
		$this->data['user'] = $user;
	}

	public function update_user(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To update a User, please login first!";
			return 'login';
		}
		$values = $request->getParameter('user', array());
		$user = User::getUserById($values['id']);
		if (!$user) {
			return $this->page404();
		}
		$user->update($values);
		$user->save();
		$this->data['message'] = "User updated successfully!";
		//return 'list_students';

		// external redirect
		//header('Location: index.php?action=list_students');
		//exit();

		//internal page redirect
		return $this->internalRedirect('list_users', $request);
	}

	// PRODUCT
    public function list_products(Request $request) {
        //$sort = isset($_GET['sort']) ? $_GET['sort'] : 'lastname';
        $sort = $request->getParameter('sort', 'name');
        $this->data["users"] = User::getUser($sort);
    }

    public function edit_product(Request $request) {
        if (!$this->isLoggedIn()) {
            $this->data['message'] = "To edit a User, please login first!";
            return 'login';
        }
        $id = $request->getParameter('id', 0);
        $user = User::getUserById($id);
        if (!$user) {
            return $this->page404();
        }
        $this->data['user'] = $user;
        $this->data['projects'] = Project::getProjects();
    }

    public function update_product(Request $request) {
        if (!$this->isLoggedIn()) {
            $this->data['message'] = "To update a User, please login first!";
            return 'login';
        }
        $values = $request->getParameter('user', array());
        $user = User::getUserById($values['id']);
        if (!$user) {
            return $this->page404();
        }
        $user->update($values);
        $user->save();
        $this->data['message'] = "User updated successfully!";
        //return 'list_students';

        // external redirect
        //header('Location: index.php?action=list_students');
        //exit();

        //internal page redirect
        return $this->internalRedirect('list_users', $request);
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
		$this->data['message'] = "Bye Bye!";
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
