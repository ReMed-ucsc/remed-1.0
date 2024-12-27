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
        return isset($_SESSION['id']);
    }

    public function isAuthorized()
    {
        $this->startSession();
        return isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];
    }

    public function checkSessionTimeout()
    {
        $app = new App();

        $timeoutDuration = 1800; // 30 minutes

        if ($this->getSession('last_activity') && (time() - $this->getSession('last_activity') > $timeoutDuration)) {
            // Last activity was more than $timeoutDuration ago
            $this->destroySession();
            if ($app->checkAdmin()) {
                redirect('admin/login');
            } else {
                redirect('login');
            }
            exit();
        }

        // Update last activity time
        // $_SESSION['last_activity'] = time();
    }

    // Protect a route by redirecting to login if not authenticated
    public function protectRoute()
    {
        $app = new App();


        // if (!$this->isAuthenticated()) {
        //     $timeoutDuration = 30; // in seconds


        //     if ($this->getSession('last_activity') && (time() - $this->getSession('last_activity') > $timeoutDuration)) {
        //         // Last activity was more than $timeoutDuration ago
        //         $this->destroySession();
        //         if ($app->checkAdmin()) {
        //             redirect('admin/login');
        //         } else {
        //             redirect('login');
        //         }
        //         exit();
        //     }
        // }

        if (!$this->isAuthenticated()) {
            if ($app->checkAdmin()) {
                redirect('admin/login');
            } else {
                redirect('login');
            }
            exit();
        } else if ($app->checkAdmin()) {
            if (!$this->isAuthorized()) {
                redirect('admin/login');
            }
        } else {
            if ($this->isAuthorized()) {
                redirect('login');
            }
        }
    }
}
