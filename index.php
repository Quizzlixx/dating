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

// include model
//include('model/validate.php');

// instantiate F3
$f3 = Base::instance();

// define a default route
$f3 -> route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

// personal information route
$f3 -> route('GET /personal-information', function() {
    $view = new Template();
    echo $view -> render('views/personal-information.html');
});

// profile route
$f3 -> route('POST /profile', function() {
//    var_dump($_POST);
//    var_dump($_SESSION);

    $_SESSION['fName'] = $_POST['fName'];
    $_SESSION['lName'] = $_POST['lName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];

    $view = new Template();
    echo $view -> render('views/profile.html');
});

// interests route
$f3 -> route('POST /interests', function() {
//    var_dump($_POST);
//    var_dump($_SESSION);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['size'] = $_POST['size'];
    $_SESSION['vaccination'] = $_POST['vaccination'];
    $_SESSION['pName'] = $_POST['pName'];
    $_SESSION['species'] = $_POST['species'];
    $_SESSION['biography'] = $_POST['biography'];


    $view = new Template();
    echo $view -> render('views/interests.html');
});

// summary route
$f3 -> route('POST /summary', function() {
//    var_dump($_POST);
//    var_dump($_SESSION);
    $_SESSION['indoor[]'] = $_POST['indoor[]'];
    $_SESSION['outdoor[]'] = $_POST['outdoor[]'];

    $activity = "";
    foreach ($_POST as $indoor) {
        if (is_array($indoor)) {
            foreach ($indoor as $item) {
//                echo $item;
                $activity .= $item . " ";
            }
        }
    }
    $_SESSION['activity'] = $activity;

    $view = new Template();
    echo $view -> render('views/summary.html');
});

// run f3
$f3 -> run();