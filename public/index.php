<?php

session_start();

require("../app/core/init.php");

// Set error reporting only in development mode not in production mode
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App;
$app->loadController();
