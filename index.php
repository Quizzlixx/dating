<?php
/**
 * Kerrie Low
 * 1.20.20
 * Full Stack Software Development
 * http://www.klow.greenriverdev.com/328/dating/
 */
// start session
session_start();

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

// instantiate F3
// :: means static method
$f3 = Base::instance();

// define a default route
// -> calls an instance method
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

// personal information route
$f3->route('GET /personal-information', function() {
    $view = new Template();
    echo $view -> render('views/personal-information.html');
});


// profile route
$f3->route('POST /profile', function() {
    var_dump($_POST);
    var_dump($_SESSION);

    $view = new Template();
    echo $view -> render('views/personal-information.html');
});

// interests route
$f3->route('POST /interests', function() {
    var_dump($_POST);
    var_dump($_SESSION);

    $view = new Template();
    echo $view -> render('views/personal-information.html');
});

// run f3
$f3->run();