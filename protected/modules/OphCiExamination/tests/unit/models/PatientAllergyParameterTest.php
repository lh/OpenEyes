<?php

/**
 * Class PatientAllergyParameterTest
 */

class PatientAllergyParameterTest extends CDbTestCase
{
    /**
     * @var PatientAllergyParameter
     */
    protected $object;

    /**
     * @var DBProvider
     */
    protected $searchProvider;

    protected $fixtures = array(
        'patient' => 'Patient',
        'allergy' => 'Allergy',
        'et_ophciexamination_allergies' => ':et_ophciexamination_allergies',
        'ophciexamination_allergy_entry' => OEModule\OphCiExamination\models\AllergyEntry::class,
        'event' => 'Event',
        'episode' => 'Episode',
    );

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PatientAllergyParameter();
        $this->searchProvider = new DBProvider('mysql');
        $this->object->id = 0;
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->object, $this->searchProvider);
    }

    /**
     * @covers PatientAllergyParameter::query()
     */
    public function testQuery()
    {
        $this->object->textValue = 5;

        $correctOps = array(
            '=',
            '!=',
        );
        $invalidOps = array(
            'NOT LIKE',
        );

        $sqlValue = 'SELECT DISTINCT p.id 
FROM patient p 
LEFT JOIN patient_allergy_assignment paa
  ON paa.patient_id = p.id
LEFT JOIN allergy a
  ON a.id = paa.allergy_id
WHERE a.name = :p_al_textValue_0';

        // Ensure the query is correct for each operator.
        foreach ($correctOps as $operator) {
            $this->object->operation = $operator;
            if ($operator === '!=')
            {
                $sqlValue = "SELECT DISTINCT p1.id
FROM patient p1
WHERE p1.id NOT IN (
  $sqlValue
)";
            }

            $this->assertEquals($sqlValue, $this->object->query($this->searchProvider));
        }

        // Ensure that a HTTP exception is raised if an invalid operation is specified.
        $this->setExpectedException(CHttpException::class);
        foreach ($invalidOps as $operator) {
            $this->object->operation = $operator;
            $this->object->query($this->searchProvider);
        }
    }

    /**
     * @covers PatientAllergyParameter::bindValues()
     */
    public function testBindValues()
    {
        $this->object->textValue = 5;
        $expected = array(
            'p_al_textValue_0' => $this->object->textValue,
        );

        // Ensure that all bind values are returned.
        $this->assertEquals($expected, $this->object->bindValues());
    }

    public function testSearch()
    {
        $this->object->textValue = 'allergy 1';
        $this->object->operation = '=';

        $expected = array($this->patient('patient1'));

        $results = $this->searchProvider->search(array($this->object));

        $ids = array();
        foreach ($results as $result) {
            $ids[] = $result['id'];
        }
        $patients = Patient::model()->findAllByPk($ids);

        $this->assertEquals($expected, $patients);

        $this->object->operation = '!=';

        $expected = array();

        for ($i = 2; $i < 10; $i++) {
            $expected[] = $this->patient("patient$i");
        }

        $results = $this->searchProvider->search(array($this->object));

        $ids = array();
        foreach ($results as $result) {
            $ids[] = $result['id'];
        }
        $patients = Patient::model()->findAllByPk($ids);

        $this->assertEquals($expected, $patients);
    }

}
