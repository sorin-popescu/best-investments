<?php

namespace ProspectingManagement\Entity;

use ProspectingManagement\ValueObject\ProspectStatus;

class Prospect
{
    private $id;

    private $status;

    public function __construct(ProspectId $prospectId)
    {
        $this->id = $prospectId;
        $this->status =ProspectStatus::interested();
    }

    public static function get(ProspectId $prospectId)
    {
        return new Prospect($prospectId);
    }
}
