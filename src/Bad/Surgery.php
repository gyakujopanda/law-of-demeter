<?php

namespace TellDontAsk\Bad;

use TellDontAsk\Doctor;
use TellDontAsk\HospitalVisitor;
use Exception;

class Surgery implements Doctor
{
    private $medicalChart = [];

    public function examinePatient(HospitalVisitor $patient): string
    {
        // ハートコード：病名
        $diagnosis = 'Colon Cancer';

        $this->medicalChart[$patient->getId()] = [
            'healthiness' => false,
            'diagnosis' => $diagnosis,
        ];

        return $diagnosis;
    }

    public function isMyOrganOk(HospitalVisitor $patient)
    {
        $patientId = $patient->getId();

        if (array_key_exists($patientId, $this->medicalChart)) {
            return $this->medicalChart[$patientId]['healthiness'];
        }

        throw new Exception("チャートにない患者です: {$patientId}");
    }

    public function doSurgery(HospitalVisitor $patient)
    {
        $patientId = $patient->getId();

        if (! array_key_exists($patientId, $this->medicalChart)) {
            throw new Exception("チャートにない患者です: {$patientId}");
        }

        $this->performIncision();
        $this->removeACancer();
        $this->performSuture();

        $this->medicalChart[$patientId] = [
            'healthiness' => true,
            'diagnosis' => null,
        ];

        $patient->setHealthiness(true);
    }

    private function performIncision()
    {
        echo '患者の腹を切開する。', PHP_EOL;
    }

    private function removeACancer()
    {
        echo '患者のがんを除去する。', PHP_EOL;
    }

    private function performSuture()
    {
        echo '患者の腹を縫合する。', PHP_EOL;
    }
}