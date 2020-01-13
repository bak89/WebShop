<h2>Edit User</h2>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <p><label>Name</label><input name="user[name]" value="<?php echo $user->getName() ?>" type="text"/></p>
    <p><label>Last Name</label><input id="lastname" name="user[lastname]" value="<?= $user->getLastName() ?>"
                                      type="text"/></p>
    <p><label>Street/Nr.</label><input id="street" name="user[street]" value="<?= $user->getStreet() ?>"/></p>
    <p><label>Zip</label><input id="zip" name="user[zip]" value="<?= $user->getZip() ?>" pattern="[0-9]{4}"/></p>
    <p><label>City</label><input id="city" name="user[city]" value="<?= $user->getCity() ?>"/></p>
    <p><label>Email</label><input name="user[email]" value="<?php echo $user->getEmail() ?>" type="email"/></p>
    <p><label>UserType</label><input name="user[userType]" value="<?php echo $user->getUserType() ?>" type="text"></p>
    <p><input type="hidden" name="user[password]" value="<?php if (isset($_SESSION['newPassword'])) {
            echo $_SESSION['newPassword'];
        } else {
            //echo $user->getPassword();
        } ?>"/></p>
    <p><label>Password</label><a href="<?= $this->build_url('index.php', array('action' => 'change_password')) ?>">Change
            Password</a>

    <p><input type="submit" value="Save"></p>
    <input type="hidden" name="user[id]" value="<?php echo $user->getID() ?>"/>
    <input type="hidden" name="action" value="update_user"/>
</form>




