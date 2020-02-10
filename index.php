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

// requires
require_once('vendor/autoload.php');
require_once('model/validate.php');

// instantiate F3
$f3 = Base::instance();

// arrays
$f3->set('indoor', array('puzzles' => 'Puzzles', 'mazes' => 'Mazes', 'training' => 'Training',
    'baking' => 'Pet-friendly Baking Class', 'cooking' => 'Pet-friendly Cooking Class', 'dining' => 'Pet-friendly Dining',
    'play' => 'Play Dates'));
$f3->set('outdoor', array('hiking' => 'Hiking', 'biking' => 'Biking', 'swimming' => 'Swimming', 'walking' => 'Walking',
    'fetch' => 'Fetch', 'running' => 'Running', 'agility' => 'Agility', 'herding' => 'Herding', 'parks' => 'Off-Leash Parks',
    'obedience' => 'Obedience'));
$f3->set('sizes', array('teacup' => 'Teacup (4 pounds or less)', 'toy' => 'Toy (5 - 12 pounds)', 'small' => 'Small (12 - 22 pounds)',
    'medium' => 'Medium (24 - 57 pounds)', 'large' => 'Large (59 - 99 pounds)', 'giant' => 'Giant (100 pounds or more)'));

// define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// personal information route
$f3->route('GET|POST /personal-information', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // get data from form
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];

        // put data in hive
        $f3->set('fName', $fName);
        $f3->set('lName', $lName);
        $f3->set('age', $age);
        $f3->set('phone', $phone);

        // if form is valid, reroute
        if(validPersonalInformation()) {

            // write data to session
            $_SESSION['fName'] = $fName;
            $_SESSION['lName'] = $lName;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;

            // reroute
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personal-information.html');
});

// profile route
$f3->route('GET|POST /profile', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // get variables from post array
        $email = $_POST['email'];

        // add data to the hive
        $f3->set('email', $email);

       if(validProfile()) {

           //write data to session
           $_SESSION['email'] = $email;

           // reroute
           $f3->reroute('/interests');
       }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

// interests route
$f3->route('GET|POST /interests', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $selectedIndoor = !empty($_POST['indoor']) ? $_POST['indoor'] : array();
        $selectedOutdoor = !empty($_POST['outdoor']) ? $_POST['outdoor'] : array();

        // add data to the hive
        $f3->set('selectedIndoor', $selectedIndoor);
        $f3->set('selectedOutdoor', $selectedOutdoor);

        // validate arrays
        if(validInterests()) {
            // write data to session
            $_SESSION['indoor'] = $selectedIndoor;
            $_SESSION['outdoor'] = $selectedOutdoor;

            // reroute to summary
            $f3->reroute('/summary');
        }

    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

// summary route
$f3->route('GET|POST /summary', function () {

    $view = new Template();
    echo $view->render('views/summary.html');
});

// run f3
$f3->run();