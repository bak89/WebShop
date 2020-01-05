<?php
require_once 'autoloader.php';

$register = $_POST['user'] ?? array();
if ( $register ) {

    $formIsValid = true;
    $error = "";

    if (!isset($register['name'])||!isset($register['lastname'])||!isset($register['street'])||!isset($register['zip'])||!isset($register['city'])||!isset($register['email'])
        ||$register['name'] == ""||$register['lastname'] == ""||$register['street'] == ""||$register['zip'] == ""||$register['city'] == ""||$register['email'] == ""){
        $formIsValid = false;
        $error = "please fill all the fields";
    }elseif (!preg_match("@[0-9]{4}@",$register['zip'])){
        $formIsValid = false;
        $error = "please enter a valid zip code";
    }elseif (!filter_var($register['email'],FILTER_VALIDATE_EMAIL)){
        $formIsValid = false;
        $error = "please enter a valid email";
    }

    if ($formIsValid) {
        $user = new User($register['name'],$register['lastname'],$register['email'],$register['password'],$register['street'],$register['zip'],$register['city']);
        User::save($user);

        header("Location: index.php?action=home");
    }else{
        echo "<h1 style='color: red'>".$error."</h1>";
    }
}
?>
<form class="ui form" method="post">
    <h1>Sign Up</h1>
    <p><label>Name</label><input id="name" name="user[name]" placeholder="Name" value="<?= $register['name'] ?? null ?>" required/></p>
    <p><label>Last Name</label><input id="lastname" name="user[lastname]" placeholder="Last Name" value="<?= $register['lastname'] ?? null ?>" required/></p>
    <p><label>Street/Nr.</label><input id="street" name="user[street]" placeholder="Street"  value="<?= $register['street'] ?? null ?>"required/></p>
    <p><label>Zip</label><input id="zip" name="user[zip]" placeholder="Zip" pattern="[0-9]{4}" value="<?= $register['zip'] ?? null ?>"/></p>
    <p><label>City</label><input id="city" name="user[city]" placeholder="City"  value="<?= $register['city'] ?? null ?>"required/></p>
    <p><label>Email</label><input id="email" type="email" name="user[email]" placeholder="Your@mail.com"  value="<?= $register['email'] ?? null ?>"required/></p>
    <p></p><label>Password</label><input id="password" type="password" name="user[password]"
                                         placeholder="Your Password" value="<?= $register['password'] ?? null ?>" required></p>
    <!--<p><input class="submit" type="submit" value="Submit"/></p>-->
    <button class="ui button" type="submit">Submit</button>
    <input type="hidden" name="user[userType]" value="user"/>
</form>

  <!--  <div class="field">
        <label>Name</label>
        <input id="name" type="text" name="user[name]" placeholder="Name & Lastname" required>
    </div>
    <div class="field">
        <label>Email</label>
        <input id="email" type="email" name="user[email]" placeholder="Your@mail.com" required>
    </div>
    <div class="field">
        <label>Password</label>
        <input id="password" type="password" name="user[password]" placeholder="Your Password">
    </div>
    <button class="ui button" type="submit">Submit</button>

    <input type="hidden" name="user[userType]" value="user"/>
    </form>
</div>-->