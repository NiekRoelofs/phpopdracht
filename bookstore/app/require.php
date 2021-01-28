<?php
//Require libraries from folder libraries
require_once "libraries/Core.php";
require_once "libraries/Controller.php";
require_once "libraries/Database.php";
require_once "DAL/User_DAO.php";
require_once "DAL/Book_DAO.php";
require_once "DAL/IBase_DAO.php";
require_once "models/User.php";
require_once "models/Book.php";

require_once "helpers/session_helper.php";

require_once "config/config.php";

//instantiate core class
try {
    $init = new Core();
} catch (Exception $e) {
        echo URLROOT . "pages/error";
}
