<?php

namespace ProjectManagement\Entity;

use ProjectManagement\ValueObject\ConsultationId;
use ProjectManagement\ValueObject\ConsultationStatus;
use ProjectManagement\ValueObject\SpecialistId;

class Consultation
{
    /**
     * @var ConsultationId
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $startTime;

    /**
     * @var SpecialistId
     */
    private $specialistId;

    /**
     * @var ConsultationStatus
     */
    private $status;

    /**
     * @var int
     */
    private $time;

    /**
     * Consultation constructor.
     * @param \DateTime $startTime
     * @param SpecialistId $specialistId
     */
    private function __construct(\DateTime $startTime, SpecialistId $specialistId)
    {
        $this->startTime = $startTime;
        $this->specialistId = $specialistId;
        $this->status = ConsultationStatus::opened();
        $this->id = ConsultationId::generate();
    }

    /**
     * @param \DateTime $startTime
     * @param SpecialistId $specialistId
     * @return Consultation
     */
    public static function schedule(\DateTime $startTime, SpecialistId $specialistId)
    {
        return new Consultation($startTime, $specialistId);
    }

    /**
     * @param int $time
     * @throws \Exception
     */
    public function report(int $time)
    {
        if ($this->status->isNotOpened()) {
            throw new \Exception('Consultation already confirmed');
        }
        $this->time = $time;
        $this->status = ConsultationStatus::confirmed();
    }

    public function discard()
    {
        $this->status = ConsultationStatus::discarded();
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->id;
    }

    public function isOpen()
    {
        return $this->status === ConsultationStatus::OPENED;
    }
}
