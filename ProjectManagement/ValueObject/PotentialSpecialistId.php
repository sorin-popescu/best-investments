<?php

namespace ProjectManagement\ValueObject;

class PotentialSpecialistId
{
    private $potentialSpecialistId;

    public function __construct(string $potentialSpecialistId)
    {
        $this->potentialSpecialistId = $potentialSpecialistId;
    }

    public function __toString(): string
    {
        return $this->potentialSpecialistId;
    }
}
