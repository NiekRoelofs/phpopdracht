<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <label>Username</label>
            <input type="text" placeholder="Username" name="username">
            <span class="invalidInput">
                <?php echo $data["usernameError"]; ?>
            </span>

            <label>Password</label>
            <input type="password" placeholder="Password" name="password">
            <span class="invalidInput">
                <?php echo $data["passwordError"]; ?>
            </span>

            <button id="submit" type="submit" value="submit">Login</button>
            
            <p class="options">Not registered yet? <a href="<?php echo URLROOT;?>/users/register">
                    Create an account!</a></p>
            <p class="options">Forgot your password? <a href="<?php echo URLROOT;?>/users/resetpassword">
                    Change here!</a></p>
        </form>
    </div>

</div>
