<?php
require_once 'autoloader.php';

$register = isset($_POST['signUp']) ? $_POST['signUp'] : false;
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
        User::save($register);
        //header("Location: registered.php");
    }else{
        echo "<h1 style='color: red'>".$error."</h1>>";
    }
}
?>
<form>
    <h1>Sign Up</h1>
    <p class="ui form" action="index.php?action=signUpUser" method="post">
    <p><label>Name</label><input id="name" name="user[name]" placeholder="Name" required/></p>
    <p><label>Last Name</label><input id="lastname" name="user[lastname]" placeholder="Last Name" required/></p>
    <p><label>Street/Nr.</label><input id="street" name="user[street]" placeholder="Street" required/></p>
    <p><label>Zip</label><input id="zip" name="user[zip]" placeholder="Zip" pattern="[0-9]{4}"/></p>
    <p><label>City</label><input id="city" name="user[city]" placeholder="City" required/></p>
    <p><label>Email</label><input id="email" type="email" name="user[email]" placeholder="Your@mail.com" required/></p>
    <p></p><label>Password</label><input id="password" type="password" name="user[password]"
                                         placeholder="Your Password"></p>
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