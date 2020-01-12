<?php
echo "<p>Thank you for your order!</p>";
$_SESSION['cart'] = new Cart();

echo "<p class=\"back\">&raquo; <a href=\"index.php?action=home\">Back to Home</a></p>";