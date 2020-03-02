<?php
/**
 * Kerrie Low
 * 1.20.20
 * Full Stack Software Development
 * http://www.klow.greenriverdev.com/328/dating/
 */
// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// requires
require_once('vendor/autoload.php');

// start session
session_start();

// instantiate F3
$f3 = Base::instance();

// f3 debugging ON
$f3->set('DEBUG', 3);

// instantiate controller objects
$db = new DatingDatabase();
$controller = new DatingController($f3);

// arrays
$f3->set('genders', array('male', 'female'));

$f3->set('seekingArr', array('cats', 'dogs'));

$f3->set('speciesArr', array('cat', 'dog'));

$f3->set('indoors', array('puzzles' => 'Puzzles', 'mazes' => 'Mazes', 'training' => 'Training',
    'baking' => 'Pet-friendly Baking Class', 'cooking' => 'Pet-friendly Cooking Class',
    'dining' => 'Pet-friendly Dining', 'play' => 'Play Dates'));

$f3->set('outdoors', array('hiking' => 'Hiking', 'biking' => 'Biking', 'swimming' => 'Swimming',
    'walking' => 'Walking', 'running' => 'Running', 'agility' => 'Agility',
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
    $GLOBALS['controller']->home();
});

// personal information route
$f3->route('GET|POST /personal-information', function ($f3) {
    $GLOBALS['controller']->personalInformation($f3);
});

// profile route
$f3->route('GET|POST /profile', function ($f3) {
    $GLOBALS['controller']->profile($f3);
});

// interests route
$f3->route('GET|POST /interests', function ($f3) {
    $GLOBALS['controller']->interests($f3);
});

// summary route
$f3->route('GET|POST /summary', function () {
    $GLOBALS['controller']->summary();
});

// admin route
$f3->route('GET /admin', function () {
    $GLOBALS['controller']->admin();
});

// details route
$f3->route('GET|POST /detail', function () {
    $GLOBALS['controller']->detail();
});

// run f3
$f3->run();