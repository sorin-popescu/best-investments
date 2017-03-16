<?php

namespace ProjectManagement\ValueObject;


class Status
{
    const DRAFT = 'draft';
    const STARTED = 'started';

    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    public static function draft()
    {
        return new Status(self::DRAFT);
    }

    public static function started()
    {
        return new Status('started');
    }

    public function isDraft()
    {
        return $this->status == self::DRAFT;
    }

    public function isStarted()
    {
        return $this->status == self::STARTED;
    }
}
