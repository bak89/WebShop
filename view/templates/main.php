<?php
//require_once('lib/helper.php');
require_once("autoloader.php");
require_once("config.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    if(isset($item)) {
        $cart->updateItem($item['id'], $item['num']);
    }

}

if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $id = $_POST['order_id'];
    $cart->setItem($id, $amount);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/product-page.css">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="application/javascript" src="./scripts/cart.js"></script>
    <!--start from here-->


    <!--to here-->
</head>
<body>
<header>
    <div class="banner">
        <p class="logo">GA*AG</p>
    </div>
    <div class="navbar" id="navbar-top">
        <form action="index.php?action=search" method="post">
            <label id="searchbar">Search: <input type="text" placeholder="what are you looking for?" required></label>
        </form>
        <?php if (!$this->controller->isLoggedIn()) echo
        " <div class=\"dropdown\">
            <button class=\"dropbtn\">Sign In
                <i class=\"fa fa-caret-down\"></i>
            </button>
            <div class=\"dropdown-content\">
                <a href=\"index.php?action=login\">Log in</a>
                <a href=\"index.php?action=signUp\">Sign Up</a>
            </div>
        </div>
        "; ?>

        <?php if ($this->controller->isLoggedIn()) echo
        "<a href=\"index.php?action=user_profile\">
            <button class=\"headerButton\">Profile</button>
        </a>"; ?>

        <?php if ($this->controller->isLoggedIn()) echo
        " <a href=\"index.php?action=logout\">
            <button class=\"headerButton\">Logout</button>
        </a>"; ?>

        <a href="index.php?action=cart">
            <img src="assets/resources/shopping-cart.png" id="cart-btn">
        </a>
    </div>


    <!--div class="navbar2">

        </?php render_navigation($language, $page); ?>
        <div id="languages"></?php render_languages($language, $page); ?></div>
    </div>-->



       <ul>
            <li><a class="active" href="index.php?action=Home">Home</a></li>
            <li><a href="index.php?action=product_overview&type=men">Men</a></li>
            <li><a href="index.php?action=product_overview&type=women">Women</a></li>
            <li><a href="index.php?action=product_overview&type=gift">Gift</a></li>
            <li style="float:right"><a href="index.php?lang=de">DE</a></li>
            <li style="float:right"><a href="index.php?lang=it">IT</a></li>
            <li style="float:right"><a href="index.php?lang=en">EN</a></li>
        </ul>

    </div>


</header>

<?php include $innerTpl; ?>

<footer>

    <div class="grid-container">

        <!-- link about us / account  -->
        <div class="col-1">
            <p class="footernav-item"><a id="AboutUS" href="index.php?action=aboutUs" class="footernav-item">
                    <span>About Us</span>
                </a>
            </p>
            <p class="footernav-item"><a id="ContactUS" href="index.php?action=contactUs" class="footernav-item">
                    <span>Contact Us</span>
                </a>
            </p>
        </div>

        <div class="col-3">
             <?php if (!$this->controller->isLoggedIn()) {
                 echo"
            <p class=\"footernav-item\"><a id=\"MyAccount\" href=\"index.php?action=login\" class=\"footernav-item\">
                    <span>My Account</span>
                </a>
            </p>";
                 }else{
                 echo"
            <p class=\"footernav-item\"><a id=\"MyAccount\" href=\"index.php?action=user_Profile\" class=\"footernav-item\">
                    <span>My Account</span>
                </a>
            </p>";

             }?>
            <p class="footernav-item"><a id="CreateAccount" href="index.php?action=signUp" class="footernav-item">
                    <span>Create Account</span>
                </a>
            </p>
        </div>

        <!-- -->
        <div class="col-4">
            <hr style="background-color:black">
        </div>

        <!--  social link / newsletter -->
        <div class="col-5">
            <!--   -->
            <a href="https://facebook.com" target="_blank">
                <img src="assets/resources/facebook.png" alt="Facebook" width="48" height="48">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="assets/resources/instagram.jpg" alt="Instagram" width="48" height="48">
            </a>
            <a href="https://twitter.com" target="_blank">
                <img src="assets/resources/twitter.jpg" alt="Twitter" width="48" height="48">
            </a>
        </div>

        <div class="col-7">
            <label class="newsletter" for="newsletter-email">Newsletter:</label>
            <input class="newsletter" type="email" id="newsletter-email" autocomplete="email"
                   placeholder="Enter your email"
                   required>
            <button type="button" class="SignIn">Sign In</button>
            <div class="validation-email">Please enter a valid email address.</div><!-- js per email-->
        </div>

        <div class="col-8">
            <hr style="background-color:black">
        </div>


        <!--  language / type money -->
        <div class="col-9">
            <img src="assets/resources/language.jpg" alt="language" width="48" height="48">
        </div>

        <div class="col-10">type money : CHF</div>

        <div class="col-13">
            <hr style="background-color:black">
        </div>

        <!-- Copyright  -->
        &copy; 2019 Anna & Giorgio
    </div>

</footer>
</body>
</html>
