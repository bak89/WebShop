<div>
    <h1>Register</h1>
    <form class="ui form" action="index.php?action=signUpUser" method="post">
        <div class="field">
            <label>Name</label>
            <input id="name" type="text" name="user[name]" placeholder="Name & Lastname">
        </div>
        <div class="field">
            <label>Email</label>
            <input id="email" type="email" name="user[email]" placeholder="Your@mail.com">
        </div>
        <div class="field">
            <label>Password</label>
            <input id="password" type="password" name="user[password]" placeholder="Your Password">
        </div>
        <button class="ui button" type="submit">Submit</button>

        <input type="hidden" name="user[userType]" value="user" />
    </form>
</div>
