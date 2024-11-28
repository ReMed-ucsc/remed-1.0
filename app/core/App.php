<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function splitURL()
    {
        // Handle URL for both web and API
        $URL = $_GET['url'] ?? '';
        if (strpos($URL, 'api/') === 0) {
            // API request
            $URL = explode('/', trim($URL, "/"));
            return ['api', $URL];
        } else {
            // Web page request
            $URL = explode('/', trim($URL, "/"));
            return ['web', $URL];
        }
    }

    public function loadController()
    {
        list($type, $URL) = $this->splitURL();

        if ($type === 'api') {
            // API logic
            $controllerPath = "../api/";
            $filename = $controllerPath . ucfirst($URL[1] ?? 'Login') . "Controller.php";  // Assuming 'Controller.php' files
            if (file_exists($filename)) {
                require_once($filename);
                $this->controller = ucfirst($URL[1] ?? 'Login') . "Controller";  // Example: Api\Patient\LoginController
                unset($URL[1]);
            } else {
                echo json_encode(['error' => 'Controller not found']);
                exit;
            }

            // Call the API method (POST or GET)
            $controller = new $this->controller;
            $method = $URL[2] ?? 'index';  // Default to 'index' method if no method is provided

            // Handle POST requests
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], array_values($URL));
                } else {
                    echo json_encode(['error' => 'Method not found']);
                }
            } else {
                echo json_encode(['error' => 'Invalid request method']);
            }
        } else {
            // Web page logic (as it is in your current code)
            $isAdmin = false;
            if (!empty($URL[0]) && strtolower($URL[0]) === 'admin') {
                $isAdmin = true;
                unset($URL[0]);
                $URL = array_values($URL);
            }

            $controllerPath = $isAdmin ? "../app/controllers/admin/" : "../app/controllers/user/";
            $filename = $controllerPath . ucfirst($URL[0] ?? 'Dashboard') . ".php";
            if (file_exists($filename)) {
                require_once($filename);
                $this->controller = ucfirst($URL[0] ?? 'Dashboard');
                unset($URL[0]);
            } else {
                require_once("../app/controllers/_404.php");
                $this->controller = '_404';
            }

            $controller = new $this->controller;

            if (!empty($URL[1])) {
                if (method_exists($controller, $URL[1])) {
                    $this->method = $URL[1];
                    unset($URL[1]);
                }
            }

            call_user_func_array([$controller, $this->method], $URL);
        }
    }
}
