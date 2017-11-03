<?php

/**
 * Class DBProviderTest
 */

class DBProviderTest extends CDbTestCase
{
    /**
     * @var DBProvider search provider.
     */
    protected $provider;

    public function setUp()
    {
        $this->provider = new DBProvider('mysql');
    }

    public function tearDown()
    {
        unset($this->provider);
    }

    /**
     * @covers DBProvider::executeSearch()
     * @covers DBProvider::search()
     */
    public function testSearch()
    {
        // executeSearch is a protected function so it needs to be run via DBProvider's parent function, search.
        $testParameter1 = new PatientAgeParameter();
        $testParameter1->id = 0;
        $testParameter1->operation = '>=';
        $testParameter1->textValue = 5;

        $testParameter2 = new PatientAgeParameter();
        $testParameter2->operation = '<=';
        $testParameter2->textValue = 80;
        $testParameter2->id = 1;

        $results = $this->provider->search(array($testParameter1, $testParameter2));

        $this->assertNotEmpty($results);
    }

    /**
     * @covers SearchProvider::__get()
     */
    public function testMagicMethods()
    {
        // Ensure that the provider ID can be retrieved by simply referring to it.
        $this->assertEquals('mysql', $this->provider->providerID);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testMagicMethodException()
    {
        $value = $this->provider->fakeProp;
    }
}