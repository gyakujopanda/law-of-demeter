<?php

namespace TellDontAsk\Bad;

use TellDontAsk\Doctor;
use TellDontAsk\HospitalVisitor;

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
        if (false === $doctor->isMyOrganOk($this)) {
            $doctor->doSurgery($this);
        }
    }
}