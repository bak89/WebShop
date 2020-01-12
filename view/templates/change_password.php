<?php
require_once 'autoloader.php';

$register = $_POST['user'] ?? array();

if ($register) {

    $formIsValid = true;
    $error = "";


     if (!preg_match("@^\S*(?=\S{4,})(?=\S*[a-z])(?=\S*[\d])\S*$@", $register['password'])) {
        $formIsValid = false;
        $error = "the password must be longer than 4 characters and must contain at least one character and one number";
    } else if ($register['password'] != $register['cpassword']) {
        $formIsValid = false;
        $error = "please enter a valid password";
    }

    if ($formIsValid) {
        $passwordNH= $register['password'];
        $hash = password_hash($passwordNH, PASSWORD_DEFAULT);
        $password = $hash;
        User::updatePassword($password);
        header("Location: index.php?action=user_profile");
    } else {
        echo "<h1 style='color: #ac1313'>" . $error . "</h1>";
    }
}
?>
<h2>Edit Password</h2>

<form class="ui form" method="post">
    <p></p><label>Password</label><input id="password" type="password" name="user[password]"
                                         placeholder="Your Password" value="<?= $register['password'] ?? null ?>"
                                         required></p>
    <p></p><label>Repeat Password</label><input id="cpassword" type="password" name="user[cpassword]"
                                                placeholder="Repeat Password"
                                                value="<?= $register['cpassword'] ?? null ?>" required></p>
    <button class="ui button" type="submit">Submit</button>
    <input type="hidden" name="user[userType]" value="user"/>
</form>



