<?php

/**
 * Class DatingValidator
 */
class DatingValidator
{
    /**
     * @var
     */
    private $_f3;
    /**
     * @var array
     */
    private $_errors;

    /**
     * DatingValidator constructor.
     * @param $f3
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
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

        // if the $_errors array is empty, then we have valid data
        return empty($this->_errors);
    }

    /**
     * Checks if the personal information form is valid
     *
     * @return bool
     */
    public function validProfile()
    {
        $this->validEmail($_POST['email']);

        // if the $_errors array is empty, then we have valid data
        return empty($this->_errors);
    }

    /**
     * checks if the interest arrays are valid
     */
    public function validInterests()
    {
        $this->validIndoor($_POST['indoor'], $this->_f3);
        $this->validOutdoor($_POST['outdoor'], $this->_f3);

        // if the $_errors array is empty, then we have valid data
        return empty($this->_errors);
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
     * @param $f3
     * @return void
     */
    public function validIndoor($indoor, $f3)
    {
        echo "<br>Indoor:";
        var_dump($f3->get('indoors'));
        echo "<br>Selected: ";
        var_dump($indoor);

//        if (!array_key_exists($indoor, $f3->get('indoors'))) {
//            $this->_errors['indoor'] = "Invalid selection.";
//        }
        foreach ($indoor as $activity) {
            if (!array_key_exists($activity, $f3->get('indoors'))) {
                $this->_errors['outdoor'] = "Invalid selection.";
            }
        }
    }

    /**
     * Checks to see if the selected outdoor array is valid
     *
     * @param $outdoor
     * @param $f3
     * @return void
     */
    public function validOutdoor($outdoor, $f3)
    {
        echo "<br>Outdoor:";
        var_dump($f3->get('outdoors'));
        echo "<br>Selected: ";
        var_dump($outdoor);

        foreach ($outdoor as $activity) {
            if (!array_key_exists($activity, $f3->get('outdoors'))) {
                $this->_errors['outdoor'] = "Invalid selection.";
            }
        }
    }
}