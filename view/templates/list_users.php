<h2>Users</h2>
<h5><?php echo isset($message) ? $message : ''; ?></h5>
<?php
foreach ($users as $user) {
    $name = $user->getName();
    echo "<span class=\"user\">$user</span> <a href=\"index.php?action=edit_user&name=$name\">Edit</a> | <a href=\"index.php?action=delete_user&name=$name\">Delete</a><br/>";
}
?>
