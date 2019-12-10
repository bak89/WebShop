<h2>Edit User</h2>
<form method="post" action="index.php">
	<p><label>Name</label><input name="user[name]" value="<?php echo $student->getName()?>"/></p>
	<p><label>Email</label><input name="user[email]" value="<?php echo $student->getEmail()?>"/></p>
	<p><label>Password</label><input name="user[password]" value="<?php echo $student->getPassword()?>" type="number"/></p>
	<p><label>UserType</label><select name="user[userType]">
		<?php foreach ($projects as $project) {
			$selected = $project->getId() == $student->getProjectId() ? ' selected="selected"' : '';
			printf('<option value="%d"%s>%s</option>', $project->getId(), $selected, $project->getTitle());
		}?>
	</select></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="student[id]" value="<?php echo $student->getId()?>" />
	<input type="hidden" name="action" value="update_student" />
</form>
