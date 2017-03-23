<?php
/**
 * Created by PhpStorm.
 * User: sorin.popescu
 * Date: 23/03/2017
 * Time: 15:22
 */

namespace ProjectManagement\Entity;


use ProjectManagement\ValueObject\ConsultationStatus;

class Consultation
{
    private $startTime;

    private $specialistId;

    private $status;

    private function __construct($startTime, $specialistId)
    {
        $this->startTime = $startTime;
        $this->specialistId = $specialistId;
        $this->status = ConsultationStatus::opened();
    }

    public static function schedule($startTime, $specialistId)
    {
        return new Consultation($startTime, $specialistId);
    }

    public function close()
    {
        if ($this->status->isClosed()) {
            throw new \Exception('Consultation already closed');
        }
        $this->status = ConsultationStatus::closed();
    }
}
