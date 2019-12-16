<?php
require_once('lib/helper.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
</head>
<body>
<header>
    <p>GA*AG</p>
    <div class="navbar">
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
    </div>


    <div class="navbar">
        <?php render_navigation($language, $pageId); ?>
        <div id="languages"><?php render_languages($language, $pageId); ?></div>
    </div>
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
            <p class="footernav-item"><a id="MyAccount" href="index.php?action=login" class="footernav-item">
                    <span>My Account</span>
                </a>
            </p>
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
