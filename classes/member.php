<?php

class Member
{
    private $_fName;
    private $_lName;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_size;
    private $_vaccination;
    private $_pName;
    private $_species;
    private $_bio;
    private $_isPremium = false;

    /**
     * Member constructor.
     * @param $_fName
     * @param $_lName
     * @param $_age
     * @param $_gender
     * @param $_phone
     */
    public function __construct($_fName, $_lName, $_age, $_gender, $_phone)
    {
        $this->_fName = $_fName;
        $this->_lName = $_lName;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }


    /**
     * @return bool
     */
    public function isPremium() {
        return $this->_isPremium;
    }

    /**
     * @return mixed
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * @param mixed $fName
     */
    public function setFName($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return mixed
     */
    public function getLName()
    {
        return $this->_lName;
    }

    /**
     * @param mixed $lName
     */
    public function setLName($lName)
    {
        $this->_lName = $lName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }

    /**
     * @return mixed
     */
    public function getVaccination()
    {
        return $this->_vaccination;
    }

    /**
     * @param mixed $vaccination
     */
    public function setVaccination($vaccination)
    {
        $this->_vaccination = $vaccination;
    }

    /**
     * @return mixed
     */
    public function getPName()
    {
        return $this->_pName;
    }

    /**
     * @param mixed $pName
     */
    public function setPName($pName)
    {
        $this->_pName = $pName;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->_species;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species)
    {
        $this->_species = $species;
    }



}
