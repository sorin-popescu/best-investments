<?php

namespace ProjectManagement\ValueObject;

class ClientId
{
    private $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function __toString(): string
    {
        return $this->clientId;
    }
}
