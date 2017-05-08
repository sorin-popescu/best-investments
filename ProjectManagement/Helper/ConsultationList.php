<?php

namespace ProjectManagement\Helper;

use ProjectManagement\Entity\Consultation;
use ProjectManagement\ValueObject\ConsultationId;

class ConsultationList
{
    private $array;

    public function __construct()
    {
        $this->array =[];
    }

    public function add(Consultation $consultation)
    {
        $this->array[$consultation->getIdentifier()] = $consultation;
    }

    public function getConsultation(ConsultationId $consultationId): Consultation
    {
        return $this->array[$consultationId->__toString()];
    }

    public function hasOpenedConsultation()
    {
        return count(array_filter($this->array, function (Consultation $consultation) {
            $consultation->isOpen();
        })) > 0;
    }
}
