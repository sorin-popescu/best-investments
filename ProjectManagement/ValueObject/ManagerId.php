<?php

namespace ProjectManagement\ValueObject;


class ManagerId
{
    private $managerId;

    public function __construct(int $managerId)
    {
        $this->managerId = $managerId;
    }

    public function __toString(): string
    {
        return $this->managerId;
    }
}
