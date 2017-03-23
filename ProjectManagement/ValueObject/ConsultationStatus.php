<?php

namespace ProjectManagement\ValueObject;

class ConsultationStatus
{
    const OPENED = 'opened';
    const CLOSED = 'closed';

    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    public static function opened()
    {
        return new ConsultationStatus(self::OPENED);
    }

    public static function closed()
    {
        return new ConsultationStatus(self::CLOSED);
    }

    public function isOpened()
    {
        return $this->status === self::OPENED;
    }

    public function isClosed()
    {
        return $this->status === self::CLOSED;
    }
}
