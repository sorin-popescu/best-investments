<?php

namespace ProjectManagement\ValueObject;

class SpecialistId
{
    private $specialistId;

    public function __construct(string $specialistId)
    {
        $this->specialistId = $specialistId;
    }

    public function __toString(): string
    {
        return $this->specialistId;
    }
}
