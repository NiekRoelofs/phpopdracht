<?php

class Pages extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = $this->service("User_Service");
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        $data = [
            "title" => "Home page",
            "users" => $users
        ];

        $this->view("index", $data);
    }

    public function about()
    {
        $this->view("about");
    }

    public function error(){
        $this->view("error");
    }
}
