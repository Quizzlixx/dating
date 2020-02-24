<?php

/**
 * Class DatingValidator
 */
class DatingValidator
{
    /**
     * @var array
     */
    private $_errors;

    /**
     * DatingValidator constructor.
     */
    public function __construct()
    {
        $this->_errors = array();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * Checks whether the personal information form is valid
     *
     * @return bool
     */
    public function validPersonalInformation()
    {
        $this->validFName($_POST['fName']);
        $this->validLName($_POST['lName']);
        $this->validAge($_POST['age']);
        $this->validPhone($_POST['phone']);

        // if the $_errors array is empty. then we have valid data
        return empty($this->_errors);
    }

    /**
     * @return bool
     */
    public function validProfile()
    {
        $this->validEmail($_POST['email']);

        return empty($this->_errors);
    }

    public function validInterests()
    {

        global $f3;
        $isValid = true;

        // validate indoor array
        if (!validIndoor($f3->get('indoor'))) {
            $isValid = false;
            $f3->set("errors['indoor']", "Please select a valid indoor interest.");
        }

        // validate outdoor array
        if (!validOutdoor($f3->get('indoor'))) {
            $isValid = false;
            $f3->set("errors['outdoor']", "Please select a valid outdoor interest.");
        }

        return $isValid;
    }

    /**
     * Takes a variable and returns true if it is not empty and contains only letters
     *
     * @param $first
     * @return void
     */
    public function validFName($first)
    {
        // first name is required
        if (empty(trim($first))) {
            $this->_errors['fName'] = "First name is required.";
        }
    }

    /**
     * Takes a variable and returns true if it is not empty and contains only letters
     *
     * @param $last
     * @return void
     */
    public function validLName($last)
    {
        // last name is required
        if (empty(trim($last))) {
            $this->_errors['lName'] = "Last name is required.";
        }
    }

    /**
     * Takes a value and determines whether it is a number and it is not empty.
     * Return true if number is between 18 & 118, else return false
     *
     * @param $age
     * @return void
     */
    public function validAge($age)
    {
        // if the age is empty or not a number
        if (empty(trim($age) || !is_numeric($age))) {
            $this->_errors['age'] = "Valid age is required.";
        }

        // if the age is < 18 or > 118
        if ($age < 18 || $age > 118) {
            $this->_errors['age'] = "Valid age is required.";
        }
    }

    /**
     * Return true if phone number matches pattern
     *
     * @param $number
     * @return void
     */
    public function validPhone($number)
    {
        if (!preg_match('/^[0-9]{10}+$/', $number)) {
            $this->_errors['phone'] = "Valid phone number is required.";
        }
    }

    /**
     * returns true if email format is valid
     *
     * @param $email
     * @return mixed
     */
    public function validEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_errors['email'] = "Valid email is required";
        }
    }

    /**
     * Checks to see if the selected indoor array is valid
     *
     * @param $indoor
     * @return void
     */
    public function validIndoor($indoor)
    {
        if (!in_array($indoor, $f3->get('indoor'))) {
            $this->_errors['indoor'] = "Invalid selection.";
        }
    }

    /**
     * Checks to see if the selected outdoor array is valid
     *
     * @param $outdoor
     * @return void
     */
    public function validOutdoor($outdoor)
    {
        if (!in_array($outdoor, $f3->get('outdoor'))) {
            $this->_errors['outdoor'] = "Invalid selection.";
        }
    }
}