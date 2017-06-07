<?php
echo '<?php'; ?>

class <?php echo $this->className; ?>ParameterTest extends CTestCase
{
    protected $parameter;
    protected $searchProvider;

    protected function setUp()
    {
        $this->parameter = new <?php echo $this->className; ?>Parameter();
        $this->searchProvider = new DBProvider('mysql');
        $this->parameter->id = 0;
    }

    protected function tearDown()
    {
        unset($this->parameter); // start from scratch for each test.
        unset($this->searchProvider);
    }

    /**
     * @covers <?php echo $this->className; ?>Parameter::query()
     */
    public function testQuery()
    {
        $correctOps = array(
            // Add correct operators here
        );
        $invalidOps = array(
            // Add invalid operators here.
        );

        // Ensure the query is correct for each operator.
        foreach ($correctOps as $operator) {
            $this->parameter->operation = $operator;
            //$sqlValue = "RENDER_QUERY_HERE";
            //$this->assertEquals($sqlValue, $this->parameter->query($this->searchProvider));
        }

        // Ensure that a HTTP exception is raised if an invalid operation is specified.
        $this->setExpectedException(CHttpException::class);
        foreach ($invalidOps as $operator) {
            $this->parameter->operation = $operator;
            $this->parameter->query($this->searchProvider);
        }
        $this->markTestIncomplete('TODO');
    }

    /**
     * @covers <?php echo $this->className; ?>Parameter::bindValues()
     */
    public function testBindValues()
    {
        $this->parameter->textValue = 5;
        $expected = array(
<?php if (!empty($this->attributeList)):
    foreach (explode(',', $this->attributeList) as $attribute):?>
        "<?php echo $this->alias; ?>_<?php echo $attribute; ?>_0" => $this-><?php echo $attribute; ?>,
<?php endforeach; endif;?>
        );

        // Ensure that all bind values are returned.
        $this->assertEquals($expected, $this->parameter->bindValues());
    }

    /**
     * @covers <?php echo $this->className; ?>Parameter::alias()
     */
    public function testAlias()
    {
        // Ensure that the alias correctly utilises the ID.
        $expected = '<?php echo $this->alias ?>_0';
        $this->assertEquals($expected, $this->parameter->alias());
    }

    /**
     * @covers <?php echo $this->className; ?>Parameter::join()
     */
    public function testJoin()
    {
        $this->parameter->operation = '=';
        $innerSql = $this->parameter->query($this->searchProvider);

        // Ensure that the JOIN string is correct.
        //$expected = "RENDER_JOIN_HERE";
        //$this->assertEquals($expected, $this->parameter->join('<?php echo $this->alias; ?>_1', array('id' => 'id'), $this->searchProvider));
        $this->markTestIncomplete('TODO');
    }
}
