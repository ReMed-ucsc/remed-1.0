<?php

// Autoload classes when they are called
spl_autoload_register(function ($className) {
    require_once '../app/models/' . ucfirst($className) . '.php';
});

require('config.php');
require('functions.php');
require('Database.php');
require('Controller.php');
require('Model.php');
require('App.php');
