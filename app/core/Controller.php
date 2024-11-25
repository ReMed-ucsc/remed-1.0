<?php

trait Controller
{

    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $filename = "../app/views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require_once($filename);
        } else {
            require_once("../app/views/404.view.php");
        }
    }

    // first pass the path of the view relative to view folder(ex: authenticate/login) 
    // and then the data which has to passed for that view
    // if the view is not found then 404.view.php will be loaded
    // Usage: $this->view('subfolder/viewname', $data);


    // Start a session if not already started
    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set a session variable
    public function setSession($key, $value)
    {
        $this->startSession();
        $_SESSION[$key] = $value;
    }

    protected function unsetSession($key)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Get a session variable
    public function getSession($key)
    {
        $this->startSession();
        return $_SESSION[$key] ?? null;
    }

    // Destroy the session
    public function destroySession()
    {
        $this->startSession();
        session_destroy();
    }

    // Check if a user is authenticated
    public function isAuthenticated()
    {
        $this->startSession();
        return isset($_SESSION['user_id']);
    }

    // Protect a route by redirecting to login if not authenticated
    public function protectRoute()
    {
        if (!$this->isAuthenticated()) {
            redirect('login');
            exit();
        }
    }
}
