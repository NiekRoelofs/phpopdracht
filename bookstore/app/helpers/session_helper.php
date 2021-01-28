<?php

function sessionStart($lifetime, $path, $domain, $secure, $httpOnly){

    session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);

    session_start();

}
sessionStart(3600*3, '/', 'localhost', true, true); //secure session

function isLoggedIn()
{
    if (isset($_SESSION["user_id"])) {
        return true;
    } else {
        return false;
    }
}