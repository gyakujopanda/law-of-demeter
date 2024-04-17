<?php

namespace TellDontAsk;

class Patient implements HospitalVisitor
{
    private $id;
    private $isHealthy = false;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setHealthiness(bool $state)
    {
        $this->isHealthy = $state;
    }

    public function getHealthiness(): string
    {
        return $this->isHealthy ? '良好' : '不良';
    }

    public function visitDoctor(Doctor $doctor): string
    {
        return $doctor->examinePatient($this);
    }

    public function requestMedicalTreatment(Doctor $doctor)
    {
        $doctor->doSurgery($this);
    }
}