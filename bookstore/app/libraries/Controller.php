<?php

class Controller
{
    public function service($service)
    {
        require_once "../app/service/{$service}.php";

        return new $service();
    }

    //load the view (checks for the file)
    public function view($view, $data = [])
    {
        if (file_exists("../app/views/{$view}.php")) {
            require_once "../app/views/{$view}.php";
        } else {
            die("View does not exist.");
        }
    }
}