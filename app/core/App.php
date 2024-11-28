<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, "/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        // Remove the public folder from the URL
        unset($URL[0]);
        $URL = array_values($URL); // Reindex the array
        // show($URL);

        // Determine if the URL contains 'admin'
        $isAdmin = false;
        if (!empty($URL[0]) && strtolower($URL[0]) === 'admin') {
            $isAdmin = true;
            unset($URL[0]);
            $URL = array_values($URL);
        }
        // show($URL);

        // Check if the controller exists and select it
        $controllerPath = $isAdmin ? "../app/controllers/admin/" : "../app/controllers/pharmacy/";
        $filename = $controllerPath . ucfirst($URL[0] ?? ($isAdmin ? 'Dashboard'  : 'Index')) . ".php";
        if (file_exists($filename)) {
            require_once($filename);
            $this->controller = ucfirst($URL[0] ?? ($isAdmin ? 'Dashboard'  : 'Index'));

            unset($URL[0]);
        } else {
            require_once("../app/controllers/_404.php");
            $this->controller = '_404';
        }

        $controller = new $this->controller;

        // Check if the method exists and select it
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        // read the url and pass the remaining parts as arguments to the method
        // If no method is specified, default to 'index'
        call_user_func_array([$controller, $this->method], $URL);
    }

    public function checkAdmin()
    {
        $URL = $this->splitURL();

        unset($URL[0]);
        $URL = array_values($URL); // Reindex the array
        // show($URL);

        // Determine if the URL contains 'admin'
        if (!empty($URL[0]) && strtolower($URL[0]) === 'admin') {
            return true;
        } else {
            return false;
        }
    }
}
