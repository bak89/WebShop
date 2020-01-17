<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/WebShop' . '/lib/Cart.class.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];
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

</head>
<body>
<header>
    <div class="banner">
        <p class="logo">GA*AG</p>
    </div>
    <div class="navbar" id="navbar-top">
        <?php if (!$this->controller->isLoggedIn()) echo
            " <div class=\"dropdown\">
                    <button class=\"dropbtn\">" . $this->tr('signIn') . "
                        <i class=\"fa fa-caret-down\"></i>
                    </button>
                    <div class=\"dropdown-content\">
                        <a href=\"" . $this->build_url('index.php', array('action' => 'login')) . '">' . $this->tr('logIn') . "</a>
                        <a href=\"" . $this->build_url('index.php', array('action' => 'signUp')) . '">' . $this->tr('signUp') . "</a>
                    </div>
                  </div>
                "; ?>

        <?php if ($this->controller->isLoggedIn()) echo
            "<a href=\"" . $this->build_url('index.php', array('action' => 'user_profile')) . " \">
                    <button class=\"headerButton\">" . $this->tr('profile') . "</button>
                </a>"; ?>

        <?php if ($this->controller->isLoggedIn()) echo
            "<a href=\"" . $this->build_url('index.php', array('action' => 'logOut')) . " \">
                    <button class=\"headerButton\">" . $this->tr('logOut') . "</button>
                </a>"; ?>

        <a href="index.php?action=cart">
            <img src="assets/resources/shopping-cart.png" id="cart-btn">
            <?= $cart->getTotal() ?>
        </a>
    </div>
    <?php $this->render_navbar() ?>
</header>

<?php include $innerTpl; ?>

<footer>

    <div class="footer-grid-container">

        <!-- link about us / account  -->
        <div class="col-1">
            <p class="footernav-item"><a id="AboutUS"
                                         href="<?= $this->build_url('index.php', array('action' => 'aboutus')) ?>"
                                         class="footernav-item">
                    <span><?= $this->tr('aboutus') ?></span>
                </a>
            </p>
            <p class="footernav-item"><a id="ContactUS"
                                         href="<?= $this->build_url('index.php', array('action' => 'contactus')) ?>"
                                         class="footernav-item">
                    <span><?= $this->tr('contactus') ?></span>
                </a>
            </p>
        </div>

        <div class="col-3">
            <?php if (!$this->controller->isLoggedIn()) { ?>
                <p class="footernav-item"><a id="MyAccount"
                                             href="<?= $this->build_url('index.php', array('action' => 'login')) ?>"
                                             class="footernav-item">
                        <span><?= $this->tr('myaccount') ?></span>
                    </a></p>
                <p class="footernav-item"><a id="CreateAccount"
                                             href="<?= $this->build_url('index.php', array('action' => 'signUp')) ?>"
                                             class="footernav-item">
                        <span><?= $this->tr('createaccount') ?></span>
                    </a></p>
            <?php } else { ?>
                <p class="footernav-item"><a id="MyAccount"
                                             href="<?= $this->build_url('index.php', array('action' => 'user_profile')) ?>"
                                             class="footernav-item">
                        <span><?= $this->tr('profile') ?></span>
                    </a></p>
            <?php } ?>
        </div>

        <div class="col-5">
            <p class="footernav-item"> <p>Currency : CHF</p></p>
        </div>
        <div class="col-7">
            <p class="footernav-item">
            <a href="https://facebook.com" target="_blank">
                <img src="assets/resources/facebook.png" alt="Facebook" width="48" height="48">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="assets/resources/instagram.jpg" alt="Instagram" width="48" height="48">
            </a>
            <a href="https://twitter.com" target="_blank">
                <img src="assets/resources/twitter.jpg" alt="Twitter" width="48" height="48">
            </a></p>
        </div>

        <div class="col-13">
            <p class="footernav-item"> <p>&copy; 2019 Anna & Giorgio</p></p></div>
        </div>
</footer>
</body>
</html>
