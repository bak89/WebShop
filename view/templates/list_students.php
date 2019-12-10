
	<h2>Users</h2>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>
	<?php
	foreach($users as $user) {
		$id = $user->getId();
		echo "<span class=\"user\">$user</span> <a href=\"index.php?action=edit_student&id=$id\">Edit</a> | <a href=\"index.php?action=delete_student&id=$id\">Delete</a><br/>";
	}
	?>
