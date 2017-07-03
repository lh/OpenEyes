<?php
echo '<?php'; ?>

class <?php echo $this->className; ?>ParameterTest extends CDbTestCase
{
    protected $parameter;
    protected $searchProvider;
    protected $invalidProvider;

    protected function setUp()
    {
        $this->parameter = new <?php echo $this->className; ?>Parameter();
        // $this->searchProvider = new SearchProvider('#add_provider_id_here#');
        // $this->invalidProvider = new DBProvider('invalid');
        $this->parameter->id = 0;
    }

    protected function tearDown()
    {
        unset($this->parameter); // start from scratch for each test.
        // unset($this->searchProvider);
        // unset($this->invalidProvider);
    }

    /**
     * @covers DBProvider::search()
     * @covers DBProvider::executeSearch()
     */
    public function testSearch()
    {
        // TODO: Use fixtures to populate the relevant database tables with dummy data.
        // $parameters = array();

        // TODO: Populate the case search parameter attributes here.
        // $results = $this->searchProvider->search($parameters);

        $this->markTestIncomplete('TODO');
    }
}
