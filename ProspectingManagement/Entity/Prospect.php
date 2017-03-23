<?php

namespace ProspectingManagement\Entity;

use ProjectManagement\ValueObject\PotentialSpecialist;

class Prospect
{
    private $potentialSpecialist;

    private $status;

    public function __construct()
    {
    }

    public function notInterested()
    {
        $this->status = 'not interested';
    }

    public function interested()
    {

    }
}
