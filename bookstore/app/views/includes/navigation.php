<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="mr-auto" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo URLROOT; ?>/index">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/books/index">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
            </li>
            <li class="nav-item">
                <?php  if (isset($_SESSION["user_id"])) : ?>
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/index">Users</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php  if (!isset($_SESSION["user_id"])) : ?>
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php  if (isset($_SESSION["user_id"])) : ?>
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Log out</a>
                <?php else : ?>
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>