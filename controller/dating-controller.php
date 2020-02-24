<?php

/**
 * Class DatingController
 */
class DatingController
{
    /**
     * @var
     */
    private $_f3;

    /**
     * @var
     */
    private $_val;

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
        var_dump($_SESSION['member']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // instantiate a validator
            $this->_val = new DatingValidator($f3);

            if ($this->_val->validPersonalInformation()) {
                // get form values
                $fName = $_POST['fName'];
                $lName = $_POST['lName'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $phone = $_POST['phone'];
                $premium = $_POST['premium'];

                // Instantiate member object
                if ($premium == "on") {
                    $member = new PremiumMember($fName, $lName, $age, $gender, $phone);
                } else {
                    $member = new Member($fName, $lName, $age, $gender, $phone);
                }

                // put member object in session variable
                $_SESSION['member'] = $member;

                // reroute to profile
                $f3->reroute('/profile');
            } else {
                // Data was not valid
                // Get errors from validator and add to f3 hive
                $this->_f3->set('errors', $this->_val->getErrors());

                // add POST array data to f3 hive for sticky form
                $this->_f3->set('person', $_POST);
            }
        }

        $view = new Template();
        echo $view->render('views/personal-information.html');
    }

    public function profile($f3)
    {
        var_dump($_SESSION['member']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // instantiate a validator
            $this->_val = new DatingValidator($f3);

            if ($this->_val->validProfile()) {
                // get form values
                $email = $_POST['email'];
                $state = $_POST['state'];
                $seeking = $_POST['seeking'];
                $size = $_POST['size'];
                $vaccination = $_POST['vaccination'];
                $pName = $_POST['pName'];
                $species = $_POST['species'];
                $biography = $_POST['biography'];

                // assign variables to session object
                $_SESSION['member']->setEmail($email);
                $_SESSION['member']->setState($state);
                $_SESSION['member']->setSeeking($seeking);
                $_SESSION['member']->setSize($size);
                $_SESSION['member']->setVaccination($vaccination);
                $_SESSION['member']->setPName($pName);
                $_SESSION['member']->setSpecies($species);
                $_SESSION['member']->setBio($biography);

                // reroute to interests if premium member
                if ($_SESSION['member']->isPremium()) {
                    $f3->reroute('/interests');
                } else {
                    $f3->reroute('/summary');
                }

            } else {
                // Data was not valid
                // Get errors from validator and add to f3 hive
                $this->_f3->set('errors', $this->_val->getErrors());

                // add POST array data to f3 hive for sticky form
                $this->_f3->set('person', $_POST);
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    public function interests($f3)
    {
        var_dump($_SESSION['member']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // instantiate a validator
            $this->_val = new DatingValidator($f3);

            if ($this->_val->validInterests()) {
                // get form values
                $indoor = !empty($_POST['indoor']) ? $_POST['indoor'] : array();
                $outdoor = !empty($_POST['outdoor']) ? $_POST['outdoor'] : array();

                // set interests to session variable
                $_SESSION['member']->setInDoorInterests($indoor);
                $_SESSION['member']->setOutDoorInterests($outdoor);

                // reroute to summary
                $f3->reroute('/summary');
            } else {
                // Data was not valid
                // Get errors from validator and add to f3 hive
                $this->_f3->set('errors', $this->_val->getErrors());

                // add POST array data to f3 hive for sticky form
                $this->_f3->set('person', $_POST);
            }
        }

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    public function summary()
    {
        var_dump($_SESSION['member']);

        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
        $_SESSION = array();
    }
}
