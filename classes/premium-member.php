<?php

class PremiumMember extends Member
{
    public $_inDoorInterests = array();
    public $_outDoorInterests = array();

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
