<?php
require_once 'autoloader.php';

$register = $_POST['user'] ?? array();

if ($register) {

    $formIsValid = true;
    $error = "";

    if (!isset($register['email']) || $register['email'] == "") {
        $formIsValid = false;
        $error = "please fill all the fields";
    } else
        if (!filter_var($register['email'], FILTER_VALIDATE_EMAIL)) {
            $formIsValid = false;
            $error = "please enter a valid email";
        } else if (!preg_match("@^\S*(?=\S{4,})(?=\S*[a-z])(?=\S*[\d])\S*$@", $register['password'])) {
            $formIsValid = false;
            $error = "the password must be longer than 4 characters and must contain at least one character and one number";
        } else if ($register['password'] != $register['cpassword']) {
            $formIsValid = false;
            $error = "please enter a valid password";
        }

    if ($formIsValid) {
        $password = $register['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $register['password'] = $hash;
        User::insert($register);
        header("Location: index.php?action=home");
    } else {
        echo "<h1 style='color: red'>" . $error . "</h1>";
    }
}
?>
<h3>Please Login</h3>
<!--form action="index.php?action=login" method="post">
    <p><label>Login</label> <input name="login"></p>
    <p><label>Password</label> <input type="password" name="password"></p>
    <p><input type="submit" value="Login"></p>
</form-->
<form class="ui form" method="post">
    <p><label>Email</label><input id="email" type="email" name="user[email]" placeholder="Your@mail.com"
                                  value="<?= $register['email'] ?? null ?>" required/></p>
    <p></p><label>Password</label><input id="password" type="password" name="user[password]"
                                         placeholder="Your Password" value="<?= $register['password'] ?? null ?>"
                                         required></p>
    <button class="ui button" type="submit">Submit</button>
    <input type="hidden" name="user[userType]" value="user"/>
</form>