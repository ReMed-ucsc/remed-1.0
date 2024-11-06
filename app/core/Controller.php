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
}
