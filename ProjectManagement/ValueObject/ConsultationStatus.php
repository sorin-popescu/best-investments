<?php

namespace ProjectManagement\ValueObject;

class ConsultationStatus
{
    const OPENED = 'opened';
    const CONFIRMED = 'confirmed';
    const DISCARDED = 'discarded';

    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    public static function opened()
    {
        return new ConsultationStatus(self::OPENED);
    }

    public static function confirmed()
    {
        return new ConsultationStatus(self::CONFIRMED);
    }

    public static function discarded()
    {
        return new ConsultationStatus(self::DISCARDED);
    }

    public function isNotOpened()
    {
        return $this->status !== self::OPENED;
    }

    public function isConfirmed()
    {
        return $this->status === self::CONFIRMED;
    }
}
