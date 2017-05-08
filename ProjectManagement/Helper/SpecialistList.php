<?php

namespace ProjectManagement\Helper;

use ProjectManagement\ValueObject\SpecialistId;

class SpecialistList
{
    private $array;

    public function __construct()
    {
        $this->array = [];
    }

    public function add(SpecialistId $specialistId)
    {
        $this->array[] = $specialistId;
    }

    public function remove(SpecialistId $specialistId)
    {
        $key = array_search($specialistId, $this->array);
        unset($this->array[$key]);
    }

    public function contains(SpecialistId $specialistId)
    {
        return array_search($specialistId, $this->array) === true;
    }

    public function doesNotContain(SpecialistId $specialistId)
    {
        return array_search($specialistId, $this->array) === false;
    }
}
