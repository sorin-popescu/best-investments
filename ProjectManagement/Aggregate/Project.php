<?php

namespace  ProjectManagement\Aggregate;

use ProjectManagement\Entity\Consultation;
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

    private $unapprovedSpecialistList;

    private $approvedSpecialistList;

    private $consultationList;

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
            throw new \Exception('Project not in draft');
        }

        $this->managerId = $managerId;
        $this->status = Status::active();
    }

    public function addSpecialist(SpecialistId $specialistId)
    {
        if (!$this->status->isActive())
        {
            throw new \Exception('Project not active');
        }

        if (in_array($specialistId, $this->unapprovedSpecialistList))
        {
            throw new \Exception('Already added to project');
        }

        if (in_array($specialistId, $this->approvedSpecialistList))
        {
            throw new \Exception('Already added to project');
        }

        $this->unapprovedSpecialistList[] = $specialistId;
    }

    public function scheduleConsultation($startTime, int $specialistId)
    {
        if (!$this->status->isActive()) {
            throw new \Exception('Project not active');
        }

        if (in_array($specialistId, $this->unapprovedSpecialistList)) {
            throw new \Exception('Specialist not approved for this project');
        }

        $this->consultationList = new Consultation($startTime, $specialistId);
    }

    public function approveSpecialist(SpecialistId $specialistId)
    {
        if (!$this->status->isActive())
        {
            throw new \Exception('Project not active');
        }

        if (!in_array($specialistId, $this->unapprovedSpecialistList))
        {
            throw new \Exception('Specialist not on project');
        }

        $this->approvedSpecialistList[] = $specialistId;
    }
}
