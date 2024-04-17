<?php

namespace TellDontAsk;

interface HospitalVisitor
{
    public function getId(): string;
    public function setHealthiness(bool $state);
    public function getHealthiness(): string;
    public function visitDoctor(Doctor $doctor): string;
    public function requestMedicalTreatment(Doctor $doctor);
}