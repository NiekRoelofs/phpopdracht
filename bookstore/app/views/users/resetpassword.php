<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Reset password</h2>

        <form action="<?php echo URLROOT; ?>/users/resetpassword" method="POST">
            <label>Username</label>
            <input type="text" placeholder="Username" name="username">
            <span class="invalidInput">
                <?php echo $data["usernameError"]; ?>
            </span><br>
            <label>New password</label>
            <input type="password" placeholder="Password" name="password">
            <span class="invalidInput">
                <?php echo $data["passwordError"]; ?>
            </span><br>
            <label>Confirm new password</label>
            <input type="password" placeholder="Password" name="confirmPassword">
            <span class="invalidInput">
                <?php echo $data["confirmPasswordError"]; ?>
            </span><br>

            <button id="submit" type="submit" value="submit">Reset Password</button>

        </form>
    </div>

</div>
<?php
require APPROOT . "/views/includes/footer.php";
?>
