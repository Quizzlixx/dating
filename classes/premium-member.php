<?php

class PremiumMember extends Member
{
    public $_inDoorInterests = array();
    public $_outDoorInterests = array();

    /**
     * PremiumMember constructor.
     * @param $fName
     * @param $lName
     * @param $age
     * @param $gender
     * @param $phone
     * @param array $_inDoorInterests
     * @param array $_outDoorInterests
     */
    public function __construct($fName, $lName, $age, $gender, $phone)
    {
        parent::__construct($this->setFName($fName), $this->setLName($lName), $this->setAge($age), $this->setGender($gender),
            $this->setPhone($phone));
    }


    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}
