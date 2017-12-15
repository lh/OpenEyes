<?php
use Behat\Behat\Context\ClosuredContextInterface, Behat\Behat\Context\TranslatedContextInterface, Behat\Behat\Context\BehatContext, Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode, Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Mink\Driver\Selenium2Driver;
use \SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use Behat\Behat\Exception\BehaviorException;
class OperationNoteContext extends PageObjectContext {
	public function __construct(array $parameters) {
	}
	
	/**
	 * @Then /^I select an Emergency Operation Note$/
	 */
	public function iSelectAnEmergencyOperationNote() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->emergencyBooking ();
	}
	
	/**
	 * @Given /^I select Create Operation Note$/
	 */
	public function iSelectCreateOperationNote() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->createOperationNote ();
	}
	
	/**
	 * @Then /^I select Procedure Right Eye$/
	 */
	public function iSelectProcedureRightEye() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->procedureRightEye ();
	}
	
	/**
	 * @Then /^I select Procedure Left Eye$/
	 */
	public function iSelectProcedureLeftEye() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->procedureLeftEye ();
	}
	
	/**
	 * @Given /^I select a common Procedure of "([^"]*)"$/
	 */
	public function iSelectACommonProcedureOf($common) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->commonProcedure ( $common );
	}
	
	/**
	 * @Then /^I choose Anaesthetic Type of Topical$/
	 */
	public function iChooseAnaestheticTypeOfTopical() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->typeTopical ();
	}
	
	/**
	 * @Then /^I choose Anaesthetic Type of LA$/
	 */
	public function iChooseAnaestheticTypeOfLa() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->typeLA ();
	}
	
	/**
	 * @Then /^I choose Anaesthetic Type of LAC$/
	 */
	public function iChooseAnaestheticTypeOfLac() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->typeLAC ();
	}
	
	/**
	 * @Then /^I choose Anaesthetic Type of LAS$/
	 */
	public function iChooseAnaestheticTypeOfLas() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->typeLAS ();
	}
	
	/**
	 * @Then /^I choose Anaesthetic Type of GA$/
	 */
	public function iChooseAnaestheticTypeOfGa() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->typeGA ();
	}
	
	/**
	 * @Given /^I choose Given by Anaesthetist$/
	 */
	public function iChooseGivenByAnaesthetist() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->givenAnaesthetist ();
	}
	
	/**
	 * @Given /^I choose Given by Surgeon$/
	 */
	public function iChooseGivenBySurgeon() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->givenSurgeon ();
	}
	
	/**
	 * @Given /^I choose Given by Nurse$/
	 */
	public function iChooseGivenByNurse() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->givenNurse ();
	}
	
	/**
	 * @Given /^I choose Given by Anaesthetist Tehnician$/
	 */
	public function iChooseGivenByAnaesthetistTehnician() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->givenAnaesthetistTechnician ();
	}
	
	/**
	 * @Given /^I choose Given by Other$/
	 */
	public function iChooseGivenByOther() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->givenOther ();
	}
	
	/**
	 * @Then /^I choose Delivery by Retrobulbar$/
	 */
	public function iChooseDeliveryByRetrobulbar() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliveryRetrobulbar ();
	}
	
	/**
	 * @Then /^I choose Delivery by Peribulbar$/
	 */
	public function iChooseDeliveryByPeribulbar() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliveryPeribulbar ();
	}
	
	/**
	 * @Then /^I choose Delivery by Subtenons$/
	 */
	public function iChooseDeliveryBySubtenons() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliverySubtenon ();
	}
	
	/**
	 * @Then /^I choose Delivery by Subconjunctival$/
	 */
	public function iChooseDeliveryBySubconjunctival() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliverySubconjunctival ();
	}
	
	/**
	 * @Then /^I choose Delivery by Topical$/
	 */
	public function iChooseDeliveryByTopical() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliveryTopical ();
	}
	
	/**
	 * @Then /^I choose Delivery by Topical & Intracameral$/
	 */
	public function iChooseDeliveryByTopicalIntracameral() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliveryTopicalIntracameral ();
	}
	
	/**
	 * @Then /^I choose Delivery by Other$/
	 */
	public function iChooseDeliveryByOther() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->deliveryOther ();
	}
	
	/**
	 * @Then /^I choose an Anaesthetic Agent of "([^"]*)"$/
	 */
	public function iChooseAnAnaestheticAgentOf($agent) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->anaestheticAgent ( $agent );
	}
	
	/**
	 * @Then /^I choose a Complication of "([^"]*)"$/
	 */
	public function iChooseAComplicationOf($complication) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->complications ( $complication );
	}
	
	/**
	 * @Given /^I add Anaesthetic comments of "([^"]*)"$/
	 */
	public function iAddAnaestheticCommentsOf($comments) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->anaestheticComments ( $comments );
	}
	
	/**
	 * @Then /^I choose a Surgeon of "([^"]*)"$/
	 */
	public function iChooseASurgeonOf($surgeon) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->surgeon ( $surgeon );
	}
	
	/**
	 * @Given /^I choose a Supervising Surgeon of "([^"]*)"$/
	 */
	public function iChooseASupervisingSurgeonOf($super) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->supervisingSurgeon ( $super );
	}
	
	/**
	 * @Then /^I choose an Assistant of "([^"]*)"$/
	 */
	public function iChooseAnAssistantOf($assistant) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->assistant ( $assistant );
	}
	
	/**
	 * @Then /^I choose Per Operative Drugs of "([^"]*)"$/
	 */
	public function iChoosePerOperativeDrugsOf($drug) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->perOpDrug ( $drug );
	}
	
	/**
	 * @Given /^I choose Operation comments of "([^"]*)"$/
	 */
	public function iChooseOperationCommentsOf($comments) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->operationComments ( $comments );
	}
	
	/**
	 * @Then /^I choose Post Op instructions of "([^"]*)"$/
	 */
	public function iChoosePostOpInstructionsOf($instructions) {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->postOpInstructions ( $instructions );
	}
	
	/**
	 * @Then /^I save the Operation Note$/
	 */
	public function iSaveTheOperationNote() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->saveOpNote ();
	}
	
	/**
	 * @Then /^I save the Operation Note and confirm it has been created successfully$/
	 */
	public function iSaveTheOperationNoteAndConfirmItHasBeenCreatedSuccessfully() {
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->saveOpNoteAndConfirm ();
	}

	/**
	 * @Then /^I click save button$/
	 */
	public function iClickSaveButton()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->saveOpNote();
	}

	/**
	 * @Then /^I should see cataract complications empty error message$/
	 */
	public function iShouldSeeCataractComplicationsEmptyErrorMessage()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->CataractComplicationErrorMessage();
	}

	/**
	 * @Then /^I should see anaesthetic complications empty error message$/
	 */
	public function iShouldSeeAnaestheticComplicationsEmptyErrorMessage()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->AnaestheticComplicationErrorMessage();
	}

	/**
	 * @Then /^I select procedure "([^"]*)" eye$/
	 */
	public function iSelectEyeProcedure($side)
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		if($side==="left")
		{
			$opNote->procedureLeftEye ();
		}
		elseif($side==="right")
		{
			$opNote->procedureRightEye ();
		}
		else
		{
			throw new BehaviorException ( "WARNING!!! Select 'left' or 'right' eye!  WARNING!!" );
		}
	}

	/**
	 * @Then /^I select PCR Risk$/
	 */
	public function iSelectThePCRRisk()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->iSelectPCRRisk();
	}


	/**
	 * @Then /^I should see PCR reference$/
	 */
	public function iShouldSeePCRReference()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->referencePCRRisk();
	}

	/**
	 * @Then /^I click on reference link on PCR block$/
	 */
	public function iClickOnPCRReferenceLink()
	{
		/**
		 *
		 * @var OperationNote $opNote
		 */
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->clickReferencePCRRiskLink();
	}

	/**
	 * @Then /^I set the "([^"]*)" OpNote PCR option "([^"]*)" to be "([^"]*)"$/
	 */
	public function iSetThePcrOptionTo($side, $option, $value)
	{
		/**
		 *
		 * @var Examination $examination
		 */
		$opNote = $this->getPage('OperationNote');
		$opNote->setPcrValue($side, $option, $value);
	}

	/**
	 * @Then /^I select a cataract complication of "([^"]*)"$/
	 */
	public function iSelectCataractComplication($complication)
	{
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->selectCataractComplication($complication);
	}

	/**
	 * @Then /^I select a anaesthetic complication of "([^"]*)"$/
	 */
	public function iSelectAnaestheticComplications($complication)
	{
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->selectAnaestheticComplication($complication);
	}

	/**
	 * @Then /^I select an iol type of "([^"]*)"$/
	 */
	public function iSelectIolType($type)
	{
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->selectIolType($type);
	}

	/**
	 * @Then /^I set an iol power of "([^"]*)"$/
	 */
	public function iSetIolPower($power)
	{
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->setIolPower($power);
	}

	/**
	 * @Then /^I set predicted refraction of "([^"]*)"$/
	 */
	public function iSetPredictedRefraction($power)
	{
		$opNote = $this->getPage ( 'OperationNote' );
		$opNote->setPredictedRefraction($power);
	}
}