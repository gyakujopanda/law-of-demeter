<?php

namespace TellDontAsk;

use TellDontAsk\Bad\Surgery as BadDoctor;
use TellDontAsk\Surgery as GoodDoctor;
use TellDontAsk\Bad\Patient as BadPatient;
use TellDontAsk\Patient as GoodPatient;
use PHPUnit\Framework\TestCase;

class SurgeryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        echo PHP_EOL;
    }

    public function tearDown()
    {
        echo str_repeat('-', 80), PHP_EOL;
        parent::tearDown();
    }

    /** @test */
    public function a_patient_gets_a_surgery_with_asking()
    {
        $patient = new BadPatient();
        $doctor = new BadDoctor();

        echo __METHOD__, PHP_EOL;
        echo '患者が病院で検査を受けます', PHP_EOL;
        echo "{$patient->getId()} 患者の現在の健康状態: {$patient->getHealthiness()}", PHP_EOL;

        $diagnosis = $patient->visitDoctor($doctor);
        echo "{$patient->getId()} 患者の診断名: {$diagnosis}", PHP_EOL;

        echo '患者が自分の大腸状態をみて手術の要否を判断します。', PHP_EOL;
        $patient->requestMedicalTreatment($doctor);

        echo "{$patient->getId()} 患者の現在の健康状態: {$patient->getHealthiness()}", PHP_EOL;

        $this->assertTrue(true);
    }

    /** @test */
    public function a_patient_gets_a_surgery_without_asking()
    {
        $patient = new GoodPatient();
        $doctor = new GoodDoctor();

        echo __METHOD__, PHP_EOL;
        echo '患者が病院で検査を受けます', PHP_EOL;
        echo "{$patient->getId()} 患者の現在の健康状態: {$patient->getHealthiness()}", PHP_EOL;

        $diagnosis = $patient->visitDoctor($doctor);
        echo "{$patient->getId()} 患者の診断名: {$diagnosis}", PHP_EOL;

        echo '患者は医者に手術を要請し、手術の要否は医者が判断します。', PHP_EOL;
        $patient->requestMedicalTreatment($doctor);

        echo "{$patient->getId()} 患者の診断名: {$patient->getHealthiness()}", PHP_EOL;

        $this->assertTrue(true);
    }
}
