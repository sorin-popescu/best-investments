<?php

namespace  ProjectManagement\Entity;

use ProjectManagement\ValueObject\ClientId;
use ProjectManagement\ValueObject\ManagerId;
use ProjectManagement\ValueObject\ProjectReference;
use ProjectManagement\ValueObject\SpecialistId;
use ProjectManagement\ValueObject\Status;

class Project
{
    private $name;

    private $deadline;

    private $reference;

    private $clientId;

    private $status;

    private $specialistList;

    /**
     * @var
     */
    private $managerId;

    private function __construct($name, $deadline, ClientId $clientId)
    {
        //TODO: publish event to notify project is setup
        $this->name = $name;
        $this->deadline = $deadline;
        $this->reference = ProjectReference::generate();
        $this->clientId = $clientId;
        $this->status = Status::draft();
    }

    public static function setUp($name, $deadline, ClientId $clientId) {
        return new Project($name, $deadline, $clientId);
    }

    public function start(ManagerId $managerId)
    {
        if (!$this->status->isDraft()) {
            throw new \Exception('Already not in draft');
        }

        $this->managerId = $managerId;
        $this->status = Status::started();
    }

    public function addSpecialist(SpecialistId $specialistId)
    {
        if (!$this->status->isStarted())
        {
            throw new \Exception('Project not started');
        }

        if (in_array($specialistId, $this->specialistList))
        {
            throw new \Exception('Already added');
        }

        $this->specialistList[] = $specialistId;
    }
}
