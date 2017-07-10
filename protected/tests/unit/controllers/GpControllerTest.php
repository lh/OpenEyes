<?php
/**
 * Created by PhpStorm.
 * User: Fivium
 * Date: 27/06/2017
 * Time: 2:09 PM
 */
class GpControllerTest extends CDbTestCase
{
    private $controller;

    public $fixtures = array(
        'gps' => 'Gp',
        'contacts' => 'Contact',
    );

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->getMockForAbstractClass('GpController', array('GpControllerTest'));
    }

    public function testPerformGpSave()
    {
        $gp = new Gp();
        $contact = new Contact();
        $contact->setAttributes(array('first_name' => 'John',
            'last_name'=>'Smith'),false);

        list($contact, $gp) = $this->controller->performGpSave($contact,$gp);
        $this->assertInstanceOf('Gp', $gp);
        $this->assertNotNull($gp);
        $this->assertInstanceOf('Contact', $contact);
        $this->assertNotNull($contact);

    }

}