<?php

namespace  ProjectManagement\Aggregate;

use ProjectManagement\Entity\Consultation;
use ProjectManagement\Helper\ConsultationList;
use ProjectManagement\Helper\SpecialistList;
use ProjectManagement\ValueObject\ClientId;
use ProjectManagement\ValueObject\ConsultationId;
use ProjectManagement\ValueObject\ManagerId;
use ProjectManagement\ValueObject\ProjectReference;
use ProjectManagement\ValueObject\ProjectStatus;
use ProjectManagement\ValueObject\SpecialistId;
use ProjectManagement\ValueObject\Status;

class Project
{
    private $name;

    /**
     * @var
     */
    private $deadline;

    private $reference;

    /**
     * @var ClientId
     */
    private $clientId;

    /**
     * @var ProjectStatus
     */
    private $status;

    /**
     * @var SpecialistList
     */
    private $unapprovedSpecialistList;


    /**
     * @var SpecialistList
     */
    private $approvedSpecialistList;

    /**
     * @var ConsultationList
     */
    private $consultationList;

    /**
     * @var ManagerId
     */
    private $managerId;

    private function __construct(string $name, \DateTime $deadline, ClientId $clientId)
    {
        //TODO: publish event to notify project is setup
        $this->name = $name;
        $this->deadline = $deadline;
        $this->reference = ProjectReference::generate();
        $this->clientId = $clientId;
        $this->status = ProjectStatus::draft();
        $this->unapprovedSpecialistList = new SpecialistList();
        $this->approvedSpecialistList = new SpecialistList();
    }

    /**
     * @param string $name
     * @param \DateTime $deadline
     * @param ClientId $clientId
     * @return Project
     */
    public static function setUp(string $name, \DateTime $deadline, ClientId $clientId): Project
    {
        return new Project($name, $deadline, $clientId);
    }

    /**
     * @param ManagerId $managerId
     * @throws \Exception
     */
    public function start(ManagerId $managerId)
    {
        if (!$this->status->isDraft()) {
            throw new \Exception('Project not in draft');
        }

        $this->managerId = $managerId;
        $this->status = ProjectStatus::active();
    }

    /**
     * @param SpecialistId $specialistId
     * @throws \Exception
     */
    public function addSpecialist(SpecialistId $specialistId)
    {
        if (!$this->status->isActive())
        {
            throw new \Exception('Project not active');
        }

        if ($this->unapprovedSpecialistList->contains($specialistId))
        {
            throw new \Exception('Specialist already added to project');
        }

        if ($this->approvedSpecialistList->contains($specialistId))
        {
            throw new \Exception('Specialist already added to project');
        }

        $this->approvedSpecialistList->add($specialistId);
    }

    /**
     * @param SpecialistId $specialistId
     * @throws \Exception
     */
    public function approveSpecialist(SpecialistId $specialistId)
    {
        if (!$this->status->isActive())
        {
            throw new \Exception('Project not active');
        }

        if ($this->unapprovedSpecialistList->doesNotContain($specialistId))
        {
            throw new \Exception('Specialist not on project');
        }

        if ($this->approvedSpecialistList->contains($specialistId))
        {
            throw new \Exception('Specialist already approved');
        }

        $this->approvedSpecialistList->add($specialistId);
    }

    /**
     * @param \DateTime $startTime
     * @param SpecialistId $specialistId
     * @throws \Exception
     */
    public function scheduleConsultation(\DateTime $startTime, SpecialistId $specialistId)
    {
        if (!$this->status->isActive()) {
            throw new \Exception('Project not active');
        }

        if ($this->approvedSpecialistList->doesNotContain($specialistId)) {
            throw new \Exception('Specialist not approved for this project');
        }

        $this->consultationList->add(Consultation::schedule($startTime, $specialistId));
    }

    public function reportConsultation(ConsultationId $consultationId, int $time)
    {
        $consultation = $this->consultationList->getConsultation($consultationId);
        $consultation->report($time);
    }

    public function discardConsultation(ConsultationId $consultationId)
    {
        $consultation = $this->consultationList->getConsultation($consultationId);
        $consultation->discard();
    }

    public function close()
    {
        if ($this->status->isNotActive()) {
            throw new \Exception('The project is not active');
        }

        if ($this->consultationList->hasOpenedConsultation()) {
            throw new \Exception('Some consultations are still opened');
        }

        $this->status = ProjectStatus::closed();
    }
}
