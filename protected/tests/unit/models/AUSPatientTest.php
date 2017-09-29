<?php
/**
 * Creator: isaac.jackson@fivium.com.au
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


    //create a new patient model with everything in order
    protected function getUnsavedNewPatient($patient_key)
    {
        $new_pat = new Patient;
        $new_pat->attributes = $this->patient[$patient_key];
        $new_pat->id = NULL;
        $new_pat->pas_key = NULL;
        $new_pat->nhs_num = $this->getNDigitRand();
        $new_pat->hos_num = $this->getNDigitRand();

        return $new_pat;
    }

    //create a GP with everything in order
    protected function getGP()
    {
        $new_gp = new Gp();
        $new_gp->obj_prof = $this->getNDigitRand(20);
        $new_gp->nat_id = $this->getNDigitRand(20);
        $new_gp->save();
        return $new_gp;
    }

    protected function getNDigitRand($noDigits = 40)
    {
        $rand_string = mt_rand(1,9);
        for ($i = 1; $i < $noDigits; $i++)
        {
            $rand_string .= mt_rand(0,9);
        }
        return $rand_string;
    }

    public function testUniqueMedicareNo()
    {
        $patient_dup = $this->getUnsavedNewPatient('patient1');
        $patient_dup->nhs_num = $this->patient['patient1']['nhs_num'];

        //fail to save with duplication
        $this->assertFalse($patient_dup->save());
        $this->assertSame('Medicare Number "" has already been taken.' //remove the actual number
            , preg_replace('/\d+/', '' , $patient_dup->getErrors('nhs_num')[0]));

        //remove duplication and save successfully
        $patient_dup->nhs_num = $this->getNDigitRand();
        $this->assertTrue($patient_dup->save());
    }

    public function testUniqueHosNo()
    {
        $patient_dup = $this->getUnsavedNewPatient('patient1');
        $patient_dup->hos_num = $this->patient['patient1']['hos_num'];

        //fail to save with duplication
        $this->assertFalse($patient_dup->save());
        $this->assertSame('CERA Number "" has already been taken.'
            , preg_replace('/\d+/', '' , $patient_dup->getErrors('hos_num')[0]));

        //remove duplication and save successfully
        $patient_dup->hos_num = $this->getNDigitRand();
        $this->assertTrue($patient_dup->save());
    }

    public function testHosNoRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');

        //Remove the CERA/Hospital number
        $new_pat->hos_num = NULL;

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('CERA Number cannot be blank.', $new_pat->getError('hos_num'));

        //Fix the problem, check it works
        $new_pat->hos_num = $this->getNDigitRand();
        $this->assertTrue($new_pat->save());
    }

    public function testFirstNameRequired()
    {
        $scenarios = array('referral', 'self_register', 'other_register');
        foreach ($scenarios as $scenario) {
            $new_pat = $this->getUnsavedNewPatient('patient1');
            $new_pat->contact = new Contact;
            $new_pat->contact->setScenario($scenario);
            $new_pat->contact->last_name = 'something';

            $this->assertFalse($new_pat->contact->save());
            $this->assertSame('First name cannot be blank.', $new_pat->contact->getError('first_name'));

            $new_pat->contact->first_name = 'something';

            $this->assertTrue($new_pat->contact->save());
            $this->assertTrue($new_pat->save());
        }
    }

    public function testLastNameRequired()
    {
        foreach (array('referral', 'self_register', 'other_register') as $scenario) {
            $new_pat = $this->getUnsavedNewPatient('patient1');
            $new_pat->contact = new Contact;
            $new_pat->contact->setScenario($scenario);
            $new_pat->contact->first_name = 'something';

            $this->assertFalse($new_pat->contact->save());
            $this->assertSame('Last name cannot be blank.', $new_pat->contact->getError('last_name'));

            $new_pat->contact->last_name = 'something';

            $this->assertTrue($new_pat->contact->save());
            $this->assertTrue($new_pat->save());
        }
    }

    public function testDoBRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');

        //Remove the DoB
        $new_pat->dob = NULL;

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('Date of Birth cannot be blank.', $new_pat->getError('dob'));

        //Fix the problem, check it works
        $new_pat->dob = date('01/01/1970');
        $this->assertTrue($new_pat->save());
    }

    public function testPatientSourceRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');

        //Remove the patient source
        $new_pat->patient_source = NULL;

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('Patient Source cannot be blank.', $new_pat->getError('patient_source'));

        //Fix the problem, check it works
        $new_pat->patient_source = 0;
        $this->assertTrue($new_pat->save());
    }

    public function testGenderRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');

        //Remove the Gender
        $new_pat->gender = NULL;
        $new_pat->setScenario('self_register');
        $new_pat->dob = '01/01/1970';

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('Gender cannot be blank.', $new_pat->getError('gender'));

        //Fix the problem, check it works
        $new_pat->gender = 'M';
        $this->assertTrue($new_pat->save());
    }

    public function testCountryRequired()
    {
        foreach (array('referral', 'self_register', 'other_register') as $scenario) {
            $new_pat = $this->getUnsavedNewPatient('patient1');
            $new_pat->save();
            //Remove the country
            $new_address = new Address;
            $new_address->setScenario($scenario);
            $new_address->contact_id = $new_pat->contact->id;
            $new_address->email = 'a@b.c';

            //Check that this fails and in the right manner
            $this->assertFalse($new_address->save());
            $this->assertSame('Country cannot be blank.', $new_address->getError('country_id'));

            //Fix the problem, check it works
            $new_address->country_id = 15;
            $this->assertTrue($new_address->save());
        }
    }

    public function testEmailRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');
        $new_pat->save();
        //Remove the email
        $new_address = new Address;
        $new_address->setScenario('self_register');
        $new_address->contact_id = $new_pat->contact->id;
        $new_address->country_id = 15;

        //Check that this fails and in the right manner
        $this->assertFalse($new_address->save());
        $this->assertSame('Email cannot be blank.', $new_address->getError('email'));

        //Fix the problem, check it works
        $new_address->email = 'a@b.c';
        $this->assertTrue($new_address->save());
    }

    public function testReferringPractitionerRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');
        //don't add  the referringPractitioner
        $new_pat->setScenario('referral');
        $new_pat->dob = '01/01/1970';

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('Referring Practitioner cannot be blank.', $new_pat->getError('gp_id'));

        //Fix the problem, check it works
        $new_pat->gp_id = $this->getGP()->id;
        $this->assertTrue($new_pat->save());
    }

    public function testPracticeRequired()
    {
        $new_pat = $this->getUnsavedNewPatient('patient1');
        $new_pat->setScenario('referral');
        $new_pat->gp_id = $this->getGP()->id;
        $new_pat->dob = '01/01/1970';
        //Remove the practice
        $new_pat->practice_id = NULL;

        //Check that this fails and in the right manner
        $this->assertFalse($new_pat->save());
        $this->assertSame('Practice cannot be blank.', $new_pat->getError('practice_id'));

        //Fix the problem, check it works
        $new_pat->practice_id = $this->patient['patient1']['practice_id'];
        $this->assertTrue($new_pat->save());
    }
}