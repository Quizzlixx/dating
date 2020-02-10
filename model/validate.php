<?php

/**
 * Takes a variable and returns true if it is not empty and contains only letters
 *
 * @param $string
 * @return bool
 */
function validName($string)
{
    return !empty(trim($string)) && ctype_alpha($string);
}

/**
 * Takes a value and determines whether it is a number and it is not empty.
 * Return true if number is between 18 & 118, else return false
 *
 * @param $number
 * @return bool
 */
function validAge($number)
{
    if (!empty(trim($number) && is_numeric($number))) {
        return $number >= 18 && $number <= 118;
    }
    return false;
}

/**
 * Return true if phone number matches pattern
 *
 * @param $number
 * @return false|int
 */
function validPhone($number)
{
    return preg_match('/^[0-9]{10}+$/', $number);
}

/**
 * returns true if email format is valid
 *
 * @param $email
 * @return mixed
 */
function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Checks to see if the selected indoor array is valid
 *
 * @param $indoor
 * @return bool
 */
function validIndoor($indoor)
{
    global $f3;
    if(empty($outdoor)) {
        return true;
    }
    return in_array($indoor, $f3->get('indoor'));
}

/**
 * Checks to see if the selected outdoor array is valid
 *
 * @param $outdoor
 * @return bool
 */
function validOutdoor($outdoor)
{
    global $f3;
    if(empty($outdoor)) {
        return true;
    }
    return in_array($outdoor, $f3->get('outdoor'));
}

function validInterests() {

    global $f3;
    $isValid = true;

    // validate indoor array
    if (!validIndoor($f3->get('selectedIndoor'))) {
        $isValid = false;
        $f3->set("errors['indoor']", "Please select a valid indoor interest.");
    }

    // validate outdoor array
    if(!validOutdoor($f3->get('selectedOutdoor'))) {
        $isValid = false;
        $f3->set("errors['outdoor']", "Please select a valid outdoor interest.");
    }

    return $isValid;
}

/**
 * Checks whether the personal information form is valid
 *
 * @return bool
 */
function validPersonalInformation()
{
    global $f3;
    $isValid = true;

    // validate first name
    if (!validName($f3->get('fName'))) {
        $isValid = false;
        $f3->set("errors['fName']", "Please enter a name.");
    }

    // validate last name
    if (!validName($f3->get('lName'))) {
        $isValid = false;
        $f3->set("errors['lName']", "Please enter a last name.");
    }

    // validate age
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age.");
    }

    // validate phone
    if (!validPhone($f3->get('phone'))) {
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number.");
    }

    return $isValid;
}

/**
 * Checks to see if the profile form is valid.
 *
 * @return bool
 */
function validProfile()
{

    global $f3;
    $isValid = true;

    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email.");
    }

    return $isValid;
}