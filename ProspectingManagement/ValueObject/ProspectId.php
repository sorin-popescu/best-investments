<?php

namespace ProspectingManagement\ValueObject;

class ProspectId
{
    private $prospectId;

    public function __construct(string $prospectId)
    {
        $this->prospectId = $prospectId;
    }

    public function __toString(): string
    {
        return $this->prospectId;
    }
}