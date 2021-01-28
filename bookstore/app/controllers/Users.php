<?php

class Users extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = $this->service("User_Service");
    }

    public function index()
    {
        $users = null;
        if (empty($_GET["search"])) {
            $users = $this->userService->getAllUsers();
        } elseif ($_GET["filtertype"] == "username") {
            $users = $this->userService->getUserByName($_GET["search"]);
        } elseif ($_GET["filtertype"] == "email") {
            $users = $this->userService->getUserByEmail($_GET["search"]);
        } elseif ($_GET["filtertype"] == "date") {
            $users = $this->userService->getUserByDate($_GET["search"]);
        }

        $data = [
            "users" => $users
        ];

        $this->view("users/index", $data);
    }

    public function login()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //clean input

            $data = [
                "username" => trim($_POST["username"]),
                "password" => trim($_POST["password"]),
                "usernameError" => "",
                "passwordError" => "",
            ];

            if (empty($data["username"])) {
                $data["usernameError"] = "Please enter a username.";
            }
            if (empty($data["password"])) {
                $data["passwordError"] = "Please enter a password.";
            }

            if (!empty($data["username"]) && !empty($data["password"])) {
                $loggedInUser = $this->userService->login($data["username"], $data["password"]);

                if ($loggedInUser) {
                    if (isset($_POST["remember"])) {
                        setcookie("username", $data["username"], time() + 3600 * 24, "", "", "", true);
                    } else {
                        unset($_COOKIE["username"]); //delete cookie if "remember me" is not used
                        setcookie("username", null, -1);
                    }
                    $this->createUserSession($loggedInUser);
                } else {
                    $data["passwordError"] = "Password or username is incorrect, try again.";

                    $this->view("users/login", $data);
                }
            }

        } else {
            $data = [
                "username" => "",
                "password" => "",
                "usernameError" => "",
                "passwordError" => ""
            ];
        }

        $this->view("users/login", $data);
    }

    public function createUserSession($user)
    {
        $_SESSION["user_id"] = $user->id;
        $_SESSION["username"] = $user->username;
        $_SESSION["email"] = $user->email;
        header("location:" . URLROOT . "/index");
    }


    public function register()
    {
        $data = [
            "username" => "",
            "email" => "",
            "password" => "",
            "confirmPassword" => "",
            "usernameError" => "",
            "emailError" => "",
            "passwordError" => "",
            "confirmPasswordError" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "username" => trim($_POST["username"]),
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "confirmPassword" => trim($_POST["confirmPassword"]),
                "usernameError" => "",
                "emailError" => "",
                "passwordError" => "",
                "confirmPasswordError" => ""
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";

            if (empty($data["username"])) {
                $data["usernameError"] = "Please enter a username.";
            } elseif (!preg_match($nameValidation, $data["username"])) {
                $data["usernameError"] = "Name can only contain letters and numbers.";
            }

            if (empty($data["email"])) {
                $data["emailError"] = "Please enter an email address.";
            } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                $data["emailError"] = "Please enter a valid email address.";
            } else {
                if ($this->userService->checkUserByEmail($data["email"])) { //check if email is already in use
                    $data["emailError"] = "Email is already taken.";
                }
            }

            //check password length and numbers
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 8) {
                $data['passwordError'] = 'Password must be at least 8 characters';
            }

            //check confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            //check all errors
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //create user
                if ($this->userService->createUser($data)) {
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }

        $this->view("users/register", $data);
    }

    public function resetpassword()
    {

        $data = [
            "username" => "",
            "password" => "",
            "confirmPassword" => "",
            "usernameError" => "",
            "passwordError" => "",
            "confirmPasswordError" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "username" => trim($_POST["username"]),
                "password" => trim($_POST["password"]),
                "confirmPassword" => trim($_POST["confirmPassword"]),
                "usernameError" => "",
                "passwordError" => "",
                "confirmPasswordError" => ""
            ];

            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            if (empty($data["username"])) {
                $data["usernameError"] = "Please enter a username.";
            } elseif ($this->userService->getUserByName($data["username"]) == null) { //get username
                $data["usernameError"] = "Invalid username.";
            }

            //check password length and numbers
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be at least 6 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //check confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } elseif ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
            }

            //check all errors
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //change password in database
                if ($this->userService->updateUser($data)) {
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }

        $this->view("users/resetpassword", $data);
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("location: " . URLROOT . "/users/login");
    }

    public function error()
    {
        $this->view("error");
    }
}