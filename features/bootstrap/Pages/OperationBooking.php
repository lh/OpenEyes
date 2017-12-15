<?php
use Behat\Behat\Exception\BehaviorException;
class OperationBooking extends OpenEyesPage {
	protected $path = "/site/OphTrOperationbooking/Default/create?patient_id={parentId}";
	protected $elements = array (
			
			'diagnosisRightEye' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Diagnosis_eye_id_2']" 
			),
			'diagnosisLeftEye' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Diagnosis_eye_id_1']" 
			),
			'diagnosisBothEyes' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Diagnosis_eye_id_3']" 
			),
			'operationDiagnosis' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Diagnosis_disorder_id']" 
			),
			'operationRightEye' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Operation_eye_id_2']" 
			),
			'operationBothEyes' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Operation_eye_id_3']" 
			),
			'operationLeftEye' => array (
					'xpath' => "//input[@id='Element_OphTrOperationbooking_Operation_eye_id_1']" 
			),
			'operationProcedure' => array (
					'xpath' => "//*[@id='select_procedure_id_procs']" 
			),
			'consultantYes' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_consultant_required_1']" 
			),
			'consultantNo' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_consultant_required_0']" 
			),
			'otherdoctorNo' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_any_grade_of_doctor_0']" 
			),
			'preopassessmentNo' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetist_preop_assessment_0']" 
			),
			'AnaestheticTypeTopical' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_1']" 
			),
			'stopmedicationNo' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_stop_medication_0']" 
			),
			'admissiondiscussedYes' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_fast_track_discussed_with_patient_1']" 
			),
			'scheduleOptASAP' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_ScheduleOperation_schedule_options_id_4']"
			),
			'anaestheticTopical' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_1']" 
			),
			'anaestheticLa' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_3']" 
			),
			'anaestheticLac' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_2']" 
			),
			'anaestheticLas' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_4']" 
			),
			'anaestheticGa' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_type_id_5']" 
			),
			'AnaestheticchoicePatientpreference' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_anaesthetic_choice_id_1']" 
			),
			'postOpStatYes' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_overnight_stay_1']" 
			),
			'postOpStatNo' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_overnight_stay_0']" 
			),
			'operationSiteID' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_site_id']" 
			),
			'priorityUrgent' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_priority_id_2']" 
			),
			'priorityRoutine' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_priority_id_1']" 
			),
			'decisionDate' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_decision_date_0']" 
			),
			'operationComments' => array (
					'xpath' => "//*[@id='Element_OphTrOperationbooking_Operation_comments']" 
			),
			'scheduleLater' => array (
					'xpath' => "//*[@id='et_schedulelater']" 
			),
			'scheduleNow' => array (
					//'xpath' => "//*[@id='et_save_and_schedule']"
					'xpath' => "//*[@id='et_save_and_schedule']"
			),
			'duplicateProcedureOk' => array (
					'xpath' => "//*[@class='secondary small confirm ok']" 
			),
			'duplicateProcedureCancel' => array (
					'xpath' => "//*[@class='warning small confirm cancel']" 
			),
			'availableTheatreSlotDate' => array (
					'xpath' => "//*[@class='available']" 
			),
			'availableTheatreSlotDateOutsideRTT' => array (
					'xpath' => "//*[@class='available']"
					//'xpath' => "//*[@class='available outside_rtt']"
			),
			'availableThreeWeeksTime' => array (
					'xpath' => "//*[@id='calendar']//*[contains(text(),'27')]" 
			),
			'nextMonth' => array (
					'css' => '#next_month > a' 
			),
			'availableTheatreSessionTime' => array (
					'xpath' => "//*[@class='timeBlock available bookable']" 
			),
			'noAnaesthetist' => array (
					'xpath' => "//*[@id='bookingSession1824']" 
			),
			'sessionComments' => array (
					'xpath' => "//*[@id='Session_comments']" 
			),
			'sessionOperationComments' => array (
					'xpath' => "//*[@name='Operation[comments]']" 
			),
			'sessionRTTComments' => array (
					'xpath' => "//*[@name='Operation[comments_rtt]']" 
			),
			'confirmSlot' => array (
					'xpath' => "//*[@id='confirm_slot']" 
			),
			'EmergencyList' => array (
					'xpath' => "//select[@id='firm_id']" 
			),
			'currentMonth' => array (
					'css' => "#current_month" 
			),
			'saveButton' => array (
					'xpath' => "//*[@id='et_save']" 
			),
			'chooseWard' => array (
					'xpath' => "//*[@id='Booking_ward_id']" 
			),
			'admissionTime' => array (
					'xpath' => "//*[@id='Booking_admission_time']" 
			),
			'consultantValidationError' => array (
					'xpath' => "//*[@class='alert-box alert with-icon']//*[contains(text(),'Operation: The booked session does not have a consultant present, you must change the session or cancel the booking before making this change')]" 
			) 
	)
	;
	public function diagnosisEyes($eye) {
		if ($eye === 'Right') {
			$this->getElement ( 'diagnosisRightEye' )->click ();
		}
		if ($eye === 'Both') {
			$this->getElement ( 'diagnosisBothEyes' )->click ();
		}
		if ($eye === 'Left') {
			$this->getElement ( 'diagnosisLeftEye' )->click ();
		}
	}
	public function diagnosis($diagnosis) {
		$element = $this->getElement ( 'operationDiagnosis' );
		$this->scrollWindowToElement ( $element );
		$element->setValue ( $diagnosis );
	}
	public function operationEyes($opEyes) {
		if ($opEyes === 'Right') {
			$this->getElement ( 'operationRightEye' )->click ();
		}
		if ($opEyes === 'Both') {
			$this->getElement ( 'operationBothEyes' )->click ();
		}
		if ($opEyes === 'Left') {
			$this->getElement ( 'operationLeftEye' )->click ();
		}
	}
	public function procedure($procedure) {
		$this->getElement ( 'operationProcedure' )->setValue ( $procedure );
		$this->getSession ()->wait ( 2000 );
	}
	public function consultantYes() {
		//$element = $this->getElement ( 'consultantYes' );
		//$this->scrollWindowToElement ( $element );
		//$element->click ();
		$this->getElement ( 'consultantYes' )->click ();
	}
	public function consultantNo() {
		$this->getElement ( 'consultantNo' )->click ();
	}
	public function otherdoctorNo() {
		$this->getElement ( 'otherdoctorNo' )->click ();
	}
	public function preopassessmentNo() {
		$this->getElement ( 'preopassessmentNo' )->click ();
	}
	public function AnaestheticTypeTopical() {
		$this->getElement ( 'AnaestheticTypeTopical' )->click ();
	}
	public function AnaestheticchoicePatientpreference() {
		$this->getElement ( 'AnaestheticchoicePatientpreference' )->click ();
	}
	public function stopmedicationNo() {
		$this->getElement ( 'stopmedicationNo' )->click ();
	}
	public function admissiondiscussedYes() {
		$this->getElement ( 'admissiondiscussedYes' )->click ();
	}
	public function scheduleOptASAP() {
		$this->getElement ( 'scheduleOptASAP' )->click ();
	}
	public function selectAnaesthetic($type) {
		$element = null;
		if ($type === 'Topical') {
			$element = $this->getElement ( 'anaestheticTopical' );
		}
		if ($type === 'LA') {
			$element = $this->getElement ( 'anaestheticLa' );
		}
		if ($type === 'LAC') {
			$element = $this->getElement ( 'anaestheticLac' );
		}
		if ($type === 'LAS') {
			$element = $this->getElement ( 'anaestheticLas' );
		}
		if ($type === 'GA') {
			$element = $this->getElement ( 'anaestheticGa' );
		}
		// $element->focus();
	//	$this->scrollWindowToElement ( $element );
		$this->getSession ()->wait ( 2000 );
		$element->click ();
		$this->getSession ()->wait ( 3000 );
	}
	public function postOpStayYes() {
		$this->getElement ( 'postOpStatYes' )->click ();
	}
	public function postOpStayNo() {
		$this->getElement ( 'postOpStatNo' )->click ();
	}
	public function operationSiteID($site) {
		$this->getElement ( 'operationSiteID' )->selectOption ( $site );
	}
	public function priorityRoutine() {
		$element = $this->getElement ( 'priorityRoutine' );
		//$this->scrollWindowToElement ( $element );
		$element->click ();
	}
	public function priorityUrgent() {
		$element = $this->getElement ( 'priorityUrgent' );
		//$this->scrollWindowToElement ( $element );
		$element->click ();
	}
	public function decisionDate($date) {
		$this->getElement ( 'decisionDate' )->selectOption ( $date );
		$this->getSession ()->wait ( 3000 );
	}
	public function operationComments($comments) {
		$this->getElement ( 'operationComments' )->setValue ( $comments );
	}
	public function scheduleLater() {
		$this->getElement ( 'scheduleLater' )->click ();
	}
	public function scheduleNow() {
		// $this->getElement('scheduleNow')->keyPress(2191);
		//$this->getSession ()->wait ( 5000 );
		$this->getElement ( 'scheduleNow' )->click ();
		$this->getSession ()->wait ( 8000, "window.$ && $('.event-title').html() == 'Schedule Operation' " );
	}
	public function duplicateProcedureOk() {
        $this->popupOk('duplicateProcedureOk');
    }

	public function EmergencyList() {
		$this->getElement ( 'EmergencyList' )->selectOption ( "EMG" );
		// alert is not happening anymore so call is commented out
		// $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
		$this->getSession ()->wait ( 15000, "window.$ && $('.alert-box.alert').last().html() == 'You are booking into the Emergency List.' " );
	}
	public function nextMonth() {
		$currMonthText = $this->getElement ( 'currentMonth' )->getText ();
		$this->getElement ( 'nextMonth' )->click ();
		$this->getSession ()->wait ( 15000, "window.$ && $('#current_month').html().trim().length > 0 && $('#current_month').html().trim() != '" . $currMonthText . "' " );
	}
	public function availableSlotExactDay($day) {
		$slot = $this->find ( 'xpath', "//*[@id='calendar']//*[number()='" . $day . "']" );
		$this->scrollWindowToElement ( $slot );
		$slot->click ();
		$this->getSession ()->wait ( 15000, "window.$ && $('#calendar td.available.selected_date').html().trim() == '" . $day . "' " );
	}
	public function availableSlot() {
		$slots = $this->findAll ( 'xpath', $this->getElement ( 'availableTheatreSlotDate' )->getXpath () );
		foreach ( $slots as $slot ) {
			$this->scrollWindowToElement ( $slot );
			$slot->click ();
			$this->getSession ()->wait ( 10000, "window.$ && $('.sessionTimes').length > 0" );
			$freeSession = $this->find ( 'css', '.sessionTimes > a > .bookable' );
			if ($freeSession) {
				return true;
			}
		}
		
		throw new \Exception ( 'No available theatre session found' );
	}
	public function availableSlotOutsideRTT() {
		$slots = $this->findAll ( 'xpath', $this->getElement ( 'availableTheatreSlotDateOutsideRTT' )->getXpath () );
		foreach ( $slots as $slot ) {
			$slot->click ();
			$this->getSession ()->wait ( 10000, "window.$ && $('.sessionTimes').length > 0" );
			$freeSession = $this->find ( 'css', '.sessionTimes > a > .bookable' );
			if ($freeSession) {
				return true;
			}
		}
		
		throw new \Exception ( 'No available theatre session Outside RTT found' );
	}
	public function availableSessionTime() {
		$this->waitForElementDisplayBlock ( '.timeBlock.available.bookable' );
		$element = $this->getElement ( 'availableTheatreSessionTime' );
		$this->scrollWindowToElement ( $element );
		$element->click ();
		$this->waitForElementDisplayBlock ( 'Session_comments' );
	}
	public function availableThreeWeeksTime() {
		// $this->getElement('nextMonth')->click();
		$this->getElement ( 'availableThreeWeeksTime' )->click ();
		$this->getElement ( 'noAnaesthetist' )->click ();
	}
	public function sessionComments($sessionComments) {
		$this->getElement ( 'sessionComments' )->setValue ( $sessionComments );
	}
	public function sessionOperationComments($opComments) {
		$this->getElement ( 'sessionOperationComments' )->setValue ( $opComments );
	}
	public function sessionRTTComments($RTTcomments) {
		$this->getElement ( 'sessionRTTComments' )->setValue ( $RTTcomments );
	}
	public function confirmSlot() {
		$this->getElement ( 'confirmSlot' )->click ();
	}
	public function save() {
		$this->getElement ( 'saveButton' )->click ();
		$this->getSession ()->wait ( 5000 );
	}
	public function chooseWard($ward) {
		$this->waitForElementDisplayBlock ( '#Booking_ward_id' );
		$this->getElement ( 'chooseWard' )->selectOption ( $ward );
	}
	public function admissionTime($time) {
		$this->getElement ( 'admissionTime' )->setValue ( $time );
	}
	public function consultantValidationError() {
		return ( bool ) $this->find ( 'xpath', $this->getElement ( 'consultantValidationError' )->getXpath () );
	}
	public function consultantValidationCheck() {
		if ($this->consultantValidationError ()) {
			print "Consultant Validation error has been displayed";
		} else {
			throw new BehaviorException ( "CONSULTANT BOOKING VALIDATION ERROR!!!" );
		}
	}
}
