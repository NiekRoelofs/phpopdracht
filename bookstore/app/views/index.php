<?php
require APPROOT . "/views/includes/head.php";
require APPROOT . "/views/includes/navigation.php";
?>

<div class="pageinfo">
    <h1>Welcome to my website<?php if(isset($_SESSION["username"])) : echo ", " . $_SESSION["username"]; endif; ?>!</h1>

    <p>On this website you can register an account, login and reset your password</p>
    <p>On top of that, you can check out a list of books and if you're logged in, you can add and delete books from/to the list!</p>
    <p>A list of users is also available.</p>
</div>

