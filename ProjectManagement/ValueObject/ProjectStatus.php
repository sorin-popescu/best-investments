<?php

namespace ProjectManagement\ValueObject;


class ProjectStatus
{
    const DRAFT = 'draft';
    const ACTIVE = 'active';
    const CLOSED = 'closed';

    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    public static function draft()
    {
        return new ProjectStatus(self::DRAFT);
    }

    public static function active()
    {
        return new ProjectStatus(self::ACTIVE);
    }

    public function isDraft()
    {
        return $this->status == self::DRAFT;
    }

    public function isActive()
    {
        return $this->status === self::ACTIVE;
    }
}
