<?php

class TheatreTest extends CDbTestCase
{
	public $model;
	
	public $fixtures = array(
		'theatres' => 'Theatre',
	);
	
	public function setUp()
	{
		parent::setUp();
		$this->model = new Theatre;
	}
	
	public function dataProvider_Search()
	{
		return array(
			array(array('name' => 'Operating Theatre'), 1, array('theatre1')),
			array(array('name' => 'Other Theatre'), 1, array('theatre2')),
			array(array('site_id' => 2), 1, array('theatre3')),
			array(array('site_id' => 10), 0, array())
		);
	}

	/**
	 * @dataProvider dataProvider_Search
	 */
	public function testSearch_WithValidTerms_ReturnsExpectedResults($searchTerms, $numResults, $expectedKeys)
	{
		$theatre = new Theatre;
		$theatre->setAttributes($searchTerms);
		$results = $theatre->search();
		$data = $results->getData();

		$expectedResults = array();
		if (!empty($expectedKeys)) {
			foreach ($expectedKeys as $key) {
				$expectedResults[] = $this->theatres($key);
			}
		}

		$this->assertEquals($numResults, $results->getItemCount());
		$this->assertEquals($expectedResults, $data);
	}
	
	public function testModel()
	{
		$this->assertEquals('Theatre', get_class(Theatre::model()));
	}
	
	public function testTableName()
	{
		$this->assertEquals('theatre', $this->model->tableName());
	}
	
	public function testAttributeLabels()
	{
		$expected = array(
			'id' => 'ID',
			'name' => 'Name',
			'site_id' => 'Site',
		);
		
		$this->assertEquals($expected, $this->model->attributeLabels());
	}
	
	public function testGetDateFilterOptions_ReturnsCorrectData()
	{
		$expected = array(
			'today' => 'Today',
			'week' => 'This week',
			'month' => 'This month',
			'custom' => 'or from'
		);
		
		$this->assertEquals($expected, $this->model->getDateFilterOptions());
	}
}