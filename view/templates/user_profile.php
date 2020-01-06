<?php
if ($this->controller->isLoggedIn()){
    $current= $_SESSION['user'];
    $user = User::getUserByEmail($current);
}
?>

<h1>Profile</h1>
<p>I'm your profile</p>
<p>Here you can change your data</p>

<form method="post" action="<?= $this->build_url('index.php', array('action' => 'update_profile')) ?>">
    <p><label>Name</label><input name="user[name]" value="<?= $user->getName() ?>" type="text" readonly/></p>
    <p><label>Last Name</label><input id="lastname" name="user[lastname]" value="<?= $user->getLastName() ?>"
                                      type="text" readonly/></p>
    <p><label>Street/Nr.</label><input id="street" name="user[street]" value="<?= $user->getStreet() ?>"/></p>
    <p><label>Zip</label><input id="zip" name="user[zip]" value="<?= $user->getZip() ?>" pattern="[0-9]{4}"/></p>
    <p><label>City</label><input id="city" name="user[city]" value="<?= $user->getCity() ?>"/></p>
    <p><label>Email</label><input name="user[email]" value="<?= $user->getEmail() ?>" type="email" readonly/></p>
    <p><label>Password</label><input name="user[password]" value="<?= $user->getPassword() ?>" type="password"/></p>

    <p>
        <button type="submit" name="save">Save</button>
    </p>
    <input type="hidden" name="user[id]" value="<?= $user->getID() ?>"/>
    <input type="hidden" name="user[userType]" value="<?= $user->getUserType() ?>"/>
</form>