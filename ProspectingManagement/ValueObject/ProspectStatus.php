<?php

namespace ProspectingManagement\ValueObject;

class ProspectStatus
{
    const INTERESTED = 'interested';
    const NOT_INTERESTED = 'not_interested';
    const REGISTERED = 'registered';

    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    public static function interested()
    {
        return new ProspectStatus(self::INTERESTED);
    }

    public static function notInterested()
    {
        return new ProspectStatus(self::NOT_INTERESTED);
    }

    public static function registered()
    {
        return new ProspectStatus(self::REGISTERED);
    }
}
