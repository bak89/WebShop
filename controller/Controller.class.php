<?php

class Controller
{

    private $data = array();
    private $title = "";

    // A C T I O N S
    public function home(Request $request)
    {
        $this->title = "Home";

        $sort = $request->getParameter('sort', 'id');
        $this->data["products"] = Product::getProduct($sort);
        $this->startSession();
    }

    public function contactUs(Request $request)
    {
        $this->title = "Contact Us";
        $this->startSession();
    }

    public function registered(Request $request)
    {
        $this->title = "Registered";
        $this->startSession();
    }

    public function aboutUs(Request $request)
    {
        $this->title = "About Us";
        $this->startSession();
    }

    public function cart(Request $request)
    {
        $this->title = "Cart";
        $this->startSession();
    }

    public function product_page(Request $request)
    {
        $id = $_GET['id'];
        $this->data["product"] = Product::getProductById($id);
        $this->startSession();
    }

    public function product_overview(Request $request)
    {
        $sort = $request->getParameter('sort', 'id');
        $this->data["products"] = Product::getProduct($sort);
        $this->startSession();
    }

    public function order_complete(Request $request)
    {
        $this->title = "Order Complete";
        $this->startSession();
    }


    // USER

    public function user_Profile(Request $request)
    {
        if (!$this->isLoggedIn()) {
            $this->data['message'] = "To see your Profile, please login first!";
            return 'login';
        }
        $this->title = "Profile";
        $this->startSession();
    }

    public function update_profile(Request $request){
        $values = $request->getParameter('user', array());
        $user = User::getUserById($values['id']);
        if (!$user) {
            return $this->page404();
        }
        $user->update($values);
        $user->save($user);
        $this->data['message'] = "User updated successfully!";

        header('Location: index.php?action=home');
        exit();
    }

    // A D M I N  ONLY

    public function list_users(Request $request)
    {
        if (!$this->isAdmin()) {
            $this->data['message'] = "To update a User, please login first!";
            return 'login';
        }
        $sort = $request->getParameter('sort', 'id');
        $this->data["users"] = User::getUser($sort);
    }

    public function update_user(Request $request)
    {
        $values = $request->getParameter('user', array());
        $user = User::getUserById($values['id']);
        if (!$user) {
            return $this->page404();
        }
        $user->update($values);
        $user->save($user);
        $this->data['message'] = "User updated successfully!";

        //internal page redirect
        return $this->internalRedirect('list_users', $request);
    }

    public function delete_user(Request $request)
    {
        $id = $request->getParameter('id', 0);
        $user = User::getUserById($id);
        if (!$user) {
            return $this->page404();
        }
        $user = User::delete($id);

        //external redirect
        header('Location: index.php?action=list_users');
        exit();
    }

    public function edit_user(Request $request)
    {
        $id = $request->getParameter('id', 0);
        $user = User::getUserById($id);
        if (!$user) {
            return $this->page404();
        }
        $this->data['user'] = $user;
    }

    // PRODUCT

    public function addProduct(Request $request)
    {
        $values = $request->getParameter('product', array());
        $product = Product::insert($values);
        if (!$product) {
            return $this->page404();
        }
        $this->data['message'] = "Product created successfully!";
        //external redirect
        header('Location: index.php?action=home');
        exit();
    }

    public function add_product(Request $request)
    {
        $this->title = "Add Product";
    }

    public function edit_product(Request $request)
    {
        $id = $request->getParameter('id', 0);
        $product = Product::getProductById($id);
        if (!$product) {
            return $this->page404();
        }
        $this->data['product'] = $product;
    }

    public function update_product(Request $request)
    {
        if (!$this->isAdmin()) {
            $this->data['message'] = "To update a Product, please login first!";
            return 'login';
        }
        $values = $request->getParameter('product', array());
        $product = Product::getProductById($values['id']);
        if (!$product) {
            return $this->page404();
        }
        $product->update($values);
        $product->save();
        $this->data['message'] = "Product updated successfully!";

        //internal page redirect
        return $this->internalRedirect('home', $request);
    }

    public function delete_product(Request $request)
    {
        $id = $request->getParameter('id', 0);
        $product = Product::getProductById($id);
        if (!$product) {
            return $this->page404();
        }
        $product = Product::delete($id);

        //external redirect
        header('Location: index.php?action=home');
        exit();
    }

    //LOGIN

    public function login(Request $request)
    {
        $login = $request->getParameter('login', '');
        $password = $request->getParameter('password', '');
        $user = User::checkCredentials($login, $password);

        if ($user == null) {
            $this->data['message'] = "Sorry, wrong credentials!";
            return;
        }
        $this->startSession();
        $_SESSION['user'] = $login;
        $_SESSION['userType'] = $user->getUserType();
        $this->data['message'] = "Hi " . ucfirst($login) . ", you just logged in!";
        //external redirect
        header('Location: index.php?action=home');
        exit();
    }

    public function logout(Request $request)
    {
        $this->startSession();
        session_destroy();
        $_SESSION = array();
        $this->data['message'] = "Bye Bye!";
        header('Location: index.php?action=home');
        exit();
    }

    public function signUpUser(Request $request)
    {
        $values = $request->getParameter('user', array());
        $user = User::insert($values);
        if (!$user) {
            return $this->page404();
        }
       $this->data['message'] = "User created successfully!";
        header('Location: index.php?action=registered');
        exit();
    }

    public function signUp(Request $request)
    {
        $this->title = "Sign Up";
    }

    public function isAdmin()
    {
        $this->startSession();
        if (!isset($_SESSION['userType'])) {
            return false;
        } else {
            return $_SESSION['userType'] == 'admin';
        }
    }

    public function isLoggedIn()
    {
        $this->startSession();
        return isset($_SESSION['user']);
    }

    // H E L P E R S

    public function getTitle()
    {
        return $this->title;
    }

    public function __call($function, $args)
    {
        throw new Exception("The action '$function' does not exist!");
    }

    public function &getData()
    {
        return $this->data;
    }

    // P R I V A T E  H E L P E R S

    private $sessionState = false;

    private function startSession()
    {
        if ($this->sessionState == false) {
            $this->sessionState = session_start();
        }
    }

    private function page404()
    {
        header('HTTP/1.1 404 Not Found');
        return 'page404';
    }

    private function internalRedirect($action, $request)
    {
        $tpl = $this->$action($request);
        return $tpl ? $tpl : $action;
    }

}