<h2>Edit User</h2>
<form method="post" action="index.php">
	<p><label>Name</label><input name="user[name]" value="<?php echo $user->getName()?>" type="text"/></p>
	<p><label>Email</label><input name="user[email]" value="<?php echo $user->getEmail()?>" type="email"/></p>
	<p><label>Password</label><input name="user[password]" value="<?php echo $user->getPassword()?>" type="password"/></p>
	<p><label>UserType</label><input name="user[userType]" value="<?php echo $user->getUserType()?>" type="text"></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user" />
</form>
