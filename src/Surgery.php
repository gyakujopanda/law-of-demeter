<?php

namespace TellDontAsk;

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

    public function doSurgery(HospitalVisitor $patient)
    {
        $patientId = $patient->getId();

        if (! array_key_exists($patientId, $this->medicalChart)) {
            throw new Exception("チャートにない患者です: {$patientId}");
        }

        if (false === $this->isPatientOrganOk($patientId)) {
            $this->performIncision();
            $this->removeACancer();
            $this->performSuture();

            $this->medicalChart[$patientId] = [
                'healthiness' => true,
                'diagnosis' => null,
            ];

            $patient->setHealthiness(true);
        }
    }

    private function isPatientOrganOk(string $patientId)
    {
        return $this->medicalChart[$patientId]['healthiness'];
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