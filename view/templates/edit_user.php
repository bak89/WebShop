<h2>Edit User</h2>
<form method="post" action="index.php">
	<p><label>Name</label><input name="user[name]" value="<?php echo $user->getName()?>"/></p>
	<p><label>Email</label><input name="user[email]" value="<?php echo $user->getEmail()?>"/></p>
	<p><label>Password</label><input name="user[password]" value="<?php echo $user->getPassword()?>" type="number"/></p>
	<p><label>UserType</label><select name="user[userType]">
		<?php foreach ($projects as $project) {
			$selected = $project->getId() == $user->getProjectId() ? ' selected="selected"' : '';
			printf('<option value="%d"%s>%s</option>', $project->getId(), $selected, $project->getTitle());
		}?>
	</select></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user" />
</form>
