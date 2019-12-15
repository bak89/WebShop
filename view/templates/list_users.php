<h2>Users</h2>
<h5><?php echo isset($message) ? $message : ''; ?></h5>
<?php
foreach ($users as $user) {
    $id = $user->getID();
    echo "<span class=\"user\">$user</span> <a href=\"index.php?action=edit_user&id=$id\">Edit</a> | <a href=\"index.php?action=delete_user&id=$id\">Delete</a><br/>";
}
?>
<a href="index.php?action=signUp">Add User</a>