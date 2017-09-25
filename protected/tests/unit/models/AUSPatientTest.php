<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/09/17
 * Time: 2:11 PM
 */

class AUSPatientTest extends CDbTestCase
{
    protected $fixtures = array('patient' => 'Patient');
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUniqueMedicareNo()
    {
        //create a patient as a duplicate of one in the database
        $patient_dup = new Patient;
        $patient_dup->attributes = $this->patient['patient1'];

        //change the things we don't want it to fail on
        $patient_dup->id = NULL;
        $patient_dup->pas_key = NULL;
        $patient_dup->hos_num = 65465465;

        //fail to save with duplication
        $this->assertFalse($patient_dup->save());
        $this->assertSame('Medicare Number "" has already been taken.' //remove the actual number
            , preg_replace('/\d+/', '' , $patient_dup->getErrors('nhs_num')[0]));

        //remove duplication and save successfully
        $patient_dup->nhs_num = 65465445;
        $this->assertTrue($patient_dup->save());
    }

    public function testUniqueHosNo()
    {
        //create a patient as a duplicate of one in the database
        $patient_dup = new Patient;
        $patient_dup->attributes = $this->patient['patient1'];

        //change the things we don't want it to fail on
        $patient_dup->id = NULL;
        $patient_dup->pas_key = NULL;
        $patient_dup->nhs_num = 65465465;

        //fail to save with duplication
        $this->assertFalse($patient_dup->save());
        $this->assertSame('CERA Number "" has already been taken.'
            , preg_replace('/\d+/', '' , $patient_dup->getErrors('hos_num')[0]));

        //remove duplication and save successfully
        $patient_dup->hos_num = 65465445;
        $this->assertTrue($patient_dup->save());
    }
}