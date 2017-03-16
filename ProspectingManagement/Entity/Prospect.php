<?php

namespace ProspectingManagement\Entity;

use ProjectManagement\ValueObject\PotentialSpecialist;

class Prospect
{
    private $potentialSpecialist;

    private $status;

    public function __construct(PotentialSpecialist $potentialSpecialist)
    {
        $this->potentialSpecialist = $potentialSpecialist;
    }

    public function register()
    {
        $this->status = 'registered';
        return new Specialist($this->potentialSpecialist);
    }

    public function notInterested()
    {
        $this->status = 'not interested';
    }
}