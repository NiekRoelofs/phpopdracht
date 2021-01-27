<?php

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'error';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        //ucwords to capitalize the first letter of .php file
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        //require the controller
        require_once "../app/controllers/{$this->currentController}.php";
        //instantiate controller class
        $this->currentController = new $this->currentController;

        //check for second part of url
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        } else {
            $this->currentMethod = "index";
            unset($url[1]);
        }

        //get params
        $this->params = $url ? array_values($url) : ['index'];

        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            //allows to filter variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //breaking it into an array
            $url = explode("/", $url);
            return $url;
        }
        return null;
    }
}
