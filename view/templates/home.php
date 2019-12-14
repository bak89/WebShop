<h3>Home</h3>
<h5><?php echo $message; ?></h5>
<p>
    &raquo; <?php if ($this->controller->isLoggedIn()) echo "<a href=\"index.php?action=list_users\">The list of users</a>"; ?> </p>
<p>&raquo; <a href="index.php?action=list_products">The list of products</a></p>