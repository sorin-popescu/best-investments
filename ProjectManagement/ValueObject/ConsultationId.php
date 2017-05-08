<?php

namespace ProjectManagement\ValueObject;

class ConsultationId
{
    private $consultationId;

    public function __construct()
    {
        $this->consultationId = uniqid();
    }

    public static function generate()
    {
        return new ConsultationId();
    }

    public function __toString(): string
    {
        return $this->consultationId;
    }
}
