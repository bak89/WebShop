<?php
require_once 'autoloader.php';

$register = $_POST['user'] ?? array();
$mail = $_SESSION['user'];
$user = User::getUserByEmail($mail);
$id = $user->getID();

if ($register) {

    $formIsValid = true;
    $error = "";

    if (User::checkCredentials($mail, $register['password']) == null) {
        $formIsValid = false;
        $error = "old password is wrong";
    } else if (!preg_match("@^\S*(?=\S{4,})(?=\S*[a-z])(?=\S*[\d])\S*$@", $register['password'])) {
        $formIsValid = false;
        $error = "the password must be longer than 4 characters and must contain at least one character and one number";
    } else if ($register['npassword'] != $register['cpassword']) {
        $formIsValid = false;
        $error = "please enter a valid password";
    }

    if ($formIsValid) {
        $password = password_hash($register['npassword'], PASSWORD_DEFAULT);
        $_SESSION['newPassword'] = $password;
        User::updatePassword($id, $password);
        header("Location: index.php?action=user_profile");
    } else {
        echo "<h1 style='color: #ac1313'>" . $error . "</h1>";
    }
}
?>
<h2>Edit Password</h2>

<form class="ui-form" method="post">
    <p></p><label>OldPassword</label><input id="oldpassword" type="password" name="user[password]"
                                            placeholder="Old Password" value="<?= $register['password'] ?? null ?>"
                                            required></p>
    <p></p><label>Password</label><input id="password" type="password" name="user[npassword]"
                                         placeholder="New Password" value="<?= $register['npassword'] ?? null ?>"
                                         required></p>
    <p></p><label>Repeat Password</label><input id="cpassword" type="password" name="user[cpassword]"
                                                placeholder="Repeat Password"
                                                value="<?= $register['cpassword'] ?? null ?>" required></p>
    <button class="ui-button" type="submit">Submit</button>
    <input type="hidden" name="user[userType]" value="user"/>
</form>



