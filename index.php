<?php
/**
 * Kerrie Low
 * 1.20.20
 * Full Stack Software Development
 * http://www.klow.greenriverdev.com/328/dating/
 */
// requires
require_once('vendor/autoload.php');
require_once('model/validate.php');

// start session
session_start();

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// instantiate F3
$f3 = Base::instance();

// f3 error reporting on
$f3->set('DEBUG', 3);

// arrays
$f3->set('genders', array('male', 'female'));

$f3->set('seekingArr', array('cats', 'dogs'));

$f3->set('speciesArr', array('cat', 'dog'));

$f3->set('indoors', array('puzzles' => 'Puzzles', 'mazes' => 'Mazes', 'training' => 'Training',
    'baking' => 'Pet-friendly Baking Class', 'cooking' => 'Pet-friendly Cooking Class',
    'dining' => 'Pet-friendly Dining', 'play' => 'Play Dates'));

$f3->set('outdoors', array('hiking' => 'Hiking', 'biking' => 'Biking', 'swimming' => 'Swimming',
    'walking' => 'Walking', 'fetch' => 'Fetch', 'running' => 'Running', 'agility' => 'Agility',
    'herding' => 'Herding', 'parks' => 'Off-Leash Parks', 'obedience' => 'Obedience'));

$f3->set('sizes', array('teacup' => 'Teacup (4 pounds or less)', 'toy' => 'Toy (5 - 12 pounds)',
    'small' => 'Small (12 - 22 pounds)', 'medium' => 'Medium (24 - 57 pounds)', 'large' => 'Large (59 - 99 pounds)',
    'giant' => 'Giant (100 pounds or more)'));

// https://gist.github.com/maxrice/2776900
// modified to be a f3 array
$f3->set('states', array('AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas',
    'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District of Columbia',
    'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana',
    'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland',
    'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri',
    'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey',
    'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio',
    'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina',
    'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia',
    'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming'));

// define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// personal information route
$f3->route('GET|POST /personal-information', function ($f3) {
//    var_dump($_POST);
//    echo "<br>";
    var_dump($_SESSION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // get data from form
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $premium = $_POST['premium'];

        // put data in hive
        $f3->set('fName', $fName);
        $f3->set('lName', $lName);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('premium', $premium);

        // if form is valid, reroute
        if (validPersonalInformation()) {

            // write data to session
            $_SESSION['fName'] = $fName;
            $_SESSION['lName'] = $lName;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;
            $_SESSION['phone'] = $phone;

            // Check for premium membership and create new object
            if ($premium == "on") {
                $member = new PremiumMember();
                $_SESSION['member'] = $member;
                $f3->set('member', $member);
            } else {
                $member = new Member();
                $_SESSION['member'] = $member;
                $f3->set('member', $member);
            }
            // set object properties
            $_SESSION['member']->setFName($fName);
            $_SESSION['member']->setLName($lName);
            $_SESSION['member']->setAge($age);
            $_SESSION['member']->setGender($gender);
            $_SESSION['member']->setPhone($phone);

            // reroute
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personal-information.html');
});

// profile route
$f3->route('GET|POST /profile', function ($f3) {
//    var_dump($_POST);
//    echo "<br>";
    var_dump($_SESSION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // get variables from post array
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $size = $_POST['size'];
        $vaccination = $_POST['vaccination'];
        $pName = $_POST['pName'];
        $species = $_POST['species'];
        $biography = $_POST['biography'];

        // add data to the hive
        $f3->set('email', $email);
        $f3->set('selectedState', $state);
        $f3->set('seeking', $seeking);
        $f3->set('selectedSize', $size);
        $f3->set('vaccination', $vaccination);
        $f3->set('pName', $pName);
        $f3->set('selectedSpecies', $species);
        $f3->set('biography', $biography);

        if (validProfile()) {

            //write data to session
            $_SESSION['email'] = $email;
            $_SESSION['selectedState'] = $state;
            $_SESSION['seeking'] = $seeking;
            $_SESSION['selectedSize'] = $size;
            $_SESSION['vaccination'] = $vaccination;
            $_SESSION['pName'] = $pName;
            $_SESSION['selectedSpecies'] = $species;
            $_SESSION['biography'] = $biography;

            // assign variables to session object
            $_SESSION['member']->setEmail($email);
            $_SESSION['member']->setState($_SESSION['selectedState']);
            $_SESSION['member']->setSeeking($seeking);
            $_SESSION['member']->setSize($_SESSION['selectedSize']);
            $_SESSION['member']->setVaccination($vaccination);
            $_SESSION['member']->setPName($pName);
            $_SESSION['member']->setSpecies($_SESSION['selectedSpecies']);
            $_SESSION['member']->setBio($biography);

            // reroute to interests if premium member
            if ($_SESSION['member']->isPremium()) {
                $f3->reroute('/interests');
            } else {
                $f3->reroute('/summary');
            }
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

// interests route
$f3->route('GET|POST /interests', function ($f3) {
//    var_dump($_POST);
//    echo "<br>";
    var_dump($_SESSION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $selectedIndoor = !empty($_POST['indoor']) ? $_POST['indoor'] : array();
        $selectedOutdoor = !empty($_POST['outdoor']) ? $_POST['outdoor'] : array();

        // add data to the hive
        $f3->set('selectedIndoor', $selectedIndoor);
        $f3->set('selectedOutdoor', $selectedOutdoor);

        // validate arrays
        if (validInterests()) {
            // write data to session
            $_SESSION['indoor'] = $selectedIndoor;
            $_SESSION['outdoor'] = $selectedOutdoor;

            // set interests to session variable
            $_SESSION['member']->setInDoorInterests($selectedIndoor);
            $_SESSION['member']->setOutDoorInterests($selectedOutdoor);

            // reroute to summary
            $f3->reroute('/summary');
        }

    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

// summary route
$f3->route('GET|POST /summary', function () {
//    var_dump($_POST);
//    echo "<br>";
    var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
    $_SESSION = array();
});

// run f3
$f3->run();

session_destroy();
$_SESSION = array();