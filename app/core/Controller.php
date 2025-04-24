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


    // Check if a user is authenticated
    public function isAuthenticated()
    {
        $this->startSession();

        if (!isset($_SESSION['isAdmin'])) {
            return false;
        }

        $userIdType = $_SESSION['isAdmin'] ? 'id' : 'user_id';
        return isset($_SESSION[$userIdType]) && !empty($_SESSION[$userIdType]);
    }

    public function isAuthorized()
    {
        $this->startSession();
        return isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];
    }

    public function checkSessionTimeout()
    {
        $app = new App();

        $timeoutDuration = 3600; // 1hr in seconds

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

        // First check if the user is authenticated
        if (!$this->isAuthenticated()) {
            // Not logged in, redirect to appropriate login page
            if ($app->checkAdmin()) {
                redirect('admin/login');
            } else {
                redirect('login');
            }
            exit();
        }

        // Check for session timeout
        $timeoutDuration = 3600; // 1 hour in seconds
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
        $this->setSession('last_activity', time());

        // Now check if user is in the correct section based on role
        $isAdmin = $app->checkAdmin(); // Current section is admin
        $userIsAdmin = $this->isAuthorized(); // User has admin role

        // Redirect if user is in the wrong section
        if ($isAdmin && !$userIsAdmin) {
            // Trying to access admin section without admin privileges
            redirect('login'); // Redirect to regular user area
            exit();
        } else if (!$isAdmin && $userIsAdmin) {
            // Admin user trying to access regular user section
            redirect('admin/dashboard'); // Redirect to admin area
            exit();
        }
    }

    public function preventCaching()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Wed, 01 Jan 1997 00:00:00 GMT");
    }

    // Destroy the session
    public function destroySession()
    {
        $this->startSession();

        // Clear all session variables
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finally, destroy the session
        session_destroy();
    }

    public function secureLogout()
    {
        $this->destroySession();

        // Prevent caching
        $this->preventCaching();

        // Force a new session ID
        session_regenerate_id(true);

        // Redirect with a random parameter to prevent caching of the redirect
        $randomParam = md5(uniqid(mt_rand(), true));
        redirect('login?nocache=' . $randomParam);
        exit();
    }
}
