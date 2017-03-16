<?php

namespace ProjectManagement\ValueObject;

class ClientId
{
    private $clientId;

    public function __construct()
    {
        $this->clientId = '1234';
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}
