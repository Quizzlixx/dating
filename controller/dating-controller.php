<?php

class DatingController
{
    private $_f3;

    /**
     * DatingController constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function personalInformation($f3)
    {
//        var_dump($_POST);
//        echo "<br>";
//        var_dump($_SESSION);

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
                    $member = new PremiumMember($fName, $lName, $age, $gender, $phone);
                } else {
                    $member = new Member($fName, $lName, $age, $gender, $phone);
                }

                // save object to session variable
                $_SESSION['member'] = $member;

                // reroute
                $f3->reroute('/profile');
            }
        }

        $view = new Template();
        echo $view->render('views/personal-information.html');
    }

    public function profile($f3)
    {
//        var_dump($_POST);
//        echo "<br>";
//        var_dump($_SESSION);

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
    }

    public function interests($f3)
    {
//        var_dump($_POST);
//        echo "<br>";
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
    }

    public function summary()
    {
//        var_dump($_POST);
//        echo "<br>";
//        var_dump($_SESSION);

        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
        $_SESSION = array();
    }
}
