<h1>Profile</h1>
<p>I'm your profile</p>
<p>Here you can change your data</p>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <p><label>Name</label><input name="user[name]" value="<?php echo $user->getName()?>" type="text" readonly/></p>
    <p><label>Last Name</label><input id="lastname" name="user[lastname]"  value="<?= $user->getLastName()?>" type="text" readonly/></p>
    <p><label>Street/Nr.</label><input id="street" name="user[street]" value="<?= $user->getStreet()?>"/></p>
    <p><label>Zip</label><input id="zip" name="user[zip]" value="<?= $user->getZip()?>" pattern="[0-9]{4}"/></p>
    <p><label>City</label><input id="city" name="user[city]" value="<?= $user->getCity()?>"/></p>
    <p><label>Email</label><input name="user[email]" value="<?php echo $user->getEmail()?>" type="email" readonly/></p>
    <p><label>Password</label><input name="user[password]" value="<?php echo $user->getPassword()?>" type="password"/></p>

    <p><input type="submit" value="Save"></p>
    <input type="hidden" name="user[id]" value="<?php echo $user->getID()?>" />
    <input type="hidden" name="action" value="update_user" />
</form>