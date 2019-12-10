
	<h3>Please Login</h3>
	<?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
	<form action="index.php?action=login" method="post">
		<p><label>Login</label> <input name="login"></p>
		<p><label>Password</label> <input type="password" name="password"></p>
		<p><input type="submit" value="Login"></p>
	</form>
