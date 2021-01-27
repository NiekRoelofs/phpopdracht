<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <label>Username</label>
            <input type="text" placeholder="Username" name="username">
            <span class="invalidInput">
                <?php echo $data["usernameError"]; ?>
            </span>

            <label>Email</label>
            <input type="email" placeholder="e.g. frank@live.nl" name="email">
            <span class="invalidInput">
                <?php echo $data["emailError"]; ?>
            </span>

            <label>Password</label>
            <input type="password" placeholder="Password" name="password">
            <span class="invalidInput">
                <?php echo $data["passwordError"]; ?>
            </span>

            <label>Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="confirmPassword">
            <span class="invalidInput">
                <?php echo $data["confirmPasswordError"]; ?>
            </span>

            <button id="submit" type="submit" value="submit">Register</button>
        </form>
    </div>

</div>
