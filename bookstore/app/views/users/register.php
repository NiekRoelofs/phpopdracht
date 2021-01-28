<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <label>Username</label>
            <input id="username" type="text" placeholder="Username" name="username">
            <span class="invalidInput">
                <?php echo $data["usernameError"]; ?>
            </span>

            <label>Email</label>
            <input id="email" type="email" placeholder="e.g. frank@live.nl" name="email">
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
<?php
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    echo "<script>
            document.getElementById('username').value = '$username';
            document.getElementById('email').value = '$email';
                </script>";
}
require APPROOT . "/views/includes/footer.php";
?>
