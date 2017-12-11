<?php
\Yii::import('application.modules.OETrial.models.*');

class CsvController extends BaseController
{
    static $contexts = array(
        'trials' => array(
            'successAction' => 'OETrial/trial',
            'createAction' => 'createNewTrial',
            'errorMsg' => 'Errors with trial on line ',
        ),
        'patients' => array(
            'successAction' => 'site/index',
            'createAction' => 'createNewPatient',
            'errorMsg' => 'Errors with patient on line ',
        ),
        'trialPatients' => array(
            'successAction' => 'OETrial/trial',
            'createAction' => 'createNewTrialPatient',
            'errorMsg' => 'Errors with trial patient on line ',
        ),
    );

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('upload', 'preview', 'import'),
                'users' => array('@'),
            )
        );
    }

    public function actionUpload($context)
    {
        $this->render('upload', array('context' => $context));
    }

    public function actionPreview($context)
    {
        $table = array();
        $headers = array();
        if (isset($_FILES['Csv']['tmp_name']['csvFile']) and $_FILES['Csv']['tmp_name']['csvFile'] !== "") {
            if (($handle = fopen($_FILES['Csv']['tmp_name']['csvFile'], "r")) !== false) {
                if (($line = fgetcsv($handle, 0, ",")) !== FALSE) {
                    foreach ($line as $header) {
                        $headers[] = $header;
                    }
                }

                while (($line = fgetcsv($handle, 0, ",")) !== FALSE) {
                    $row = array();
                    $header_count = 0;
                    foreach ($line as $cel) {
                        $row[$headers[$header_count++]] = $cel;
                    }
                    $table[] = $row;
                }
                fclose($handle);
            }
        }
        $_SESSION['table_data'] = $table;
        $this->render('preview', array('table' => $table, 'context' => $context));

    }

    public function actionImport($context)
    {
        $transaction = Yii::app()->db->beginTransaction();
        $errors = null;
        $row_num = 0;
        $createAction = self::$contexts[$context]['createAction'];
        foreach ($_SESSION['table_data'] as $row) {
            $row_num++;
            $errors = $this->$createAction($row);
            if(!empty($errors))break;
        }
        if (empty($errors)){
            $transaction->commit();
            $this->redirect(Yii::app()->createURL(self::$contexts[$context]['successAction']));
        } else {
            $transaction->rollback();
            array_unshift($errors, self::$contexts[$context]['errorMsg'].$row_num);
            $this->render(
                'upload',
                array(
                    'errors' => $errors,
                    'context' => $context,
                )
            );
        }
    }

    private function createNewTrial($trial)
    {
        $errors = array();
        \Yii::log('createNewTrial called on '.var_export($trial,true));
        if (!isset($trial['name']) or $trial['name'] === '') {
            $errors[] = 'Trial has no name';
            return $errors;
        }
        //check that trial does not exist
        $new_trial = Trial::model()->findByAttributes(array('name' => $trial['name']));
        if ($new_trial !== null) {
            return $errors;
        }
        //create new trial
        $new_trial = new Trial();
        $new_trial->name = $trial['name'];
        if (!isset($trial['trial_type'])) {
            $trial['trial_type'] = Trial::TRIAL_TYPE_INTERVENTION;
        }
        $new_trial->trial_type = $trial['trial_type'];
        $new_trial->description = isset($trial['description']) ? $trial['description'] : null;
        $new_trial->owner_user_id = Yii::app()->user->id;
        $new_trial->is_open = isset($trial['is_open']) ? $trial['is_open'] : false;
        $new_trial->started_date = isset($trial['started_date']) ? $trial['started_date'] : null;
        $new_trial->closed_date = isset($trial['closed_date']) ? $trial['closed_date'] : null;
        $new_trial->external_data_link = isset($trial['external_data_link']) ? $trial['external_data_link'] : null;
        $new_trial->pi_user_id = Yii::app()->user->id;

        if (!$new_trial->save()) {
            $errors = $new_trial->getErrors();
        }

        return $errors;
    }

    private function createNewPatient($patient)
    {
        $errors = array();

        if(isset($patient['CERA_number'])){
            $new_patient = Patient::model()->findByAttributes(array('hos_num' => $patient['CERA_number']));
            if ($new_patient !== null){
                return $errors;
            }
        }

        $contact = new Contact();
        $contact_cols = array(
            array('var_name' => 'nick_name'       , 'default' => null,),
            array('var_name' => 'primary_phone'   , 'default' => null,),
            array('var_name' => 'title'           , 'default' => null,),
            array('var_name' => 'first_name'      , 'default' => null,),
            array('var_name' => 'last_name'       , 'default' => null,),
            array('var_name' => 'maiden_name'     , 'default' => null,),
            array('var_name' => 'qualifications'  , 'default' => null,),
            array('var_name' => 'contact_label_id', 'default' => null,),
        );

        foreach ($contact_cols as $col){
            $contact->$col['var_name'] = isset($patient[$col['var_name']]) ? $patient[$col['var_name']] : $col['default'];
        }

        if(!$contact->save()){
            return $contact->getErrors();
        }

        $address = new Address();
        $address_cols = array(
            array('var_name' => 'address1'       , 'default' => null,),
            array('var_name' => 'address2'       , 'default' => null,),
            array('var_name' => 'city'           , 'default' => null,),
            array('var_name' => 'postcode'       , 'default' => null,),
            array('var_name' => 'county'         , 'default' => null,),
            array('var_name' => 'country_id'     , 'default' => 15,),
            array('var_name' => 'email'          , 'default' => null,),
            array('var_name' => 'date_start'     , 'default' => null,),
            array('var_name' => 'date_end'       , 'default' => null,),
            array('var_name' => 'address_type_id', 'default' => null,),
        );

        foreach ($address_cols as $col){
            $address->$col['var_name'] = isset($patient[$col['var_name']]) ? $patient[$col['var_name']] : $col['default'];
        }
        $address->contact_id = $contact->id;

        if(!$address->save()){
            return $address->getErrors();
        }

        $new_patient = new Patient();
        $patient_cols = array(
            array('var_name' => 'pas_key'                       , 'default' => null,),
            array('var_name' => 'dob'                           , 'default' => null,),
            array('var_name' => 'gender'                        , 'default' => 'U',),
            array('var_name' => 'nhs_num'                       , 'default' => null,),
            array('var_name' => 'date_of_death'                 , 'default' => null,),
            array('var_name' => 'practice_id'                   , 'default' => null,),
            array('var_name' => 'ethnic_group_id'               , 'default' => null,),
            array('var_name' => 'archive_no_allergies_date'     , 'default' => null,),
            array('var_name' => 'archive_no_family_history_date', 'default' => null,),
            array('var_name' => 'archive_no_risks_date'         , 'default' => null,),
            array('var_name' => 'deleted'                       , 'default' => null,),
            array('var_name' => 'nhs_num_status_id'             , 'default' => null,),
            array('var_name' => 'is_deceased'                   , 'default' => null,),
            array('var_name' => 'is_local'                      , 'default' => 1,),
            array('var_name' => 'patient_source'                , 'default' => 0,),
        );

        foreach ($patient_cols as $col){
            $new_patient->$col['var_name'] = isset($patient[$col['var_name']]) ? $patient[$col['var_name']] : $col['default'];
        }
        $new_patient->contact_id = $contact->id;
        $new_patient->hos_num = isset($patient['CERA_number']) ? $patient['CERA_number'] : Patient::getNextCeraNumber();

        if(!$new_patient->save()){
            return $new_patient->getErrors();
        }
        //patient contact assignments

        //referred to
        if(isset($patient['referred_to_first_name']) or isset($patient['referred_to_last_name'])){
            if(isset($patient['referred_to_first_name']) and isset($patient['referred_to_last_name'])) {
                $referred_to = null;
                //Find if exists
                $referred_to = User::model()->findByAttributes(array(
                    'first_name' => $patient['referred_to_first_name'],
                    'last_name' => $patient['reffered_to_last_name'],
                ));
                if ($referred_to === null) {
                    $errors[] = 'Cannot find referred to user';
                    return $errors;
                }
                $pat_ref = new PatientUserReferral();
                $pat_ref->user = $referred_to;
                if (!$pat_ref->save()) {
                    $errors[] = 'Count not save referred to user';
                    array_unshift($errors, $pat_ref->getErrors());
                    return $errors;
                }
            } else {
                $errors[] = 'Both names must be present to import referred_to for this patient';
                return $errors;
            }
        }

        //optom
        if(isset($patient['optom_first_name']) or isset($patient['optom_last_name'])){
            if(isset($patient['optom_first_name']) and isset($patient['optom_last_name'])) {
                $optom_label = ContactLabel::model()->findByAttributes(array('name' => 'Optometrist'));
                $optom_contact = Contact::model()->findByAttributes(array(
                    'contact_label_id' => $optom_label->id,
                    'first_name' => $patient['optom_first_name'],
                    'last_name' => $patient['optom_last_name'],
                ));
                if ($optom_contact === null) {
                    $optom_contact = new Contact();
                    $optom_contact->first_name = $patient['optom_first_name'];
                    $optom_contact->last_name = $patient['optom_last_name'];
                    $optom_contact->label = $optom_label;
                    if (!$optom_contact->save()) {
                        $errors[] = 'Could not save new optometrist contact';
                        array_unshift($errors, $optom_contact->getErrors());
                        return $errors;
                    }
                }
                $pat_con = new PatientContactAssignment();
                $pat_con->contact = $optom_contact;
                if (!$pat_con->save()) {
                    $errors[] = 'Could not save optometrist contact assignment';
                    array_unshift($errors, $pat_con->getErrors());
                    return $errors;
                }
                $new_gp = new Gp();
                $new_gp->obj_prof = 0;
                $new_gp->nat_id = 0;
                $new_gp->contact = $pat_con;
                if (!$new_gp->save()) {
                    $errors[] = 'Could not save new practitioner contact';
                    array_unshift($errors, $new_gp->getErrors());
                    return $errors;
                }
            } else {
                $errors[] = 'Both names must be present to import optom';
                return $errors;
            }
        }

        //opthal
        if(isset($patient['opthal_first_name']) or isset($patient['opthal_last_name'])){
            if(isset($patient['opthal_first_name']) and isset($patient['opthal_last_name'])) {
                $opthal_label = ContactLabel::model()->findByAttributes(array('name' => 'Ophthalmologist'));
                $opthal_contact = Contact::model()->findByAttributes(array(
                    'contact_label_id' => $opthal_label->id,
                    'first_name' => $patient['opthal_first_name'],
                    'last_name' => $patient['opthal_last_name'],
                ));
                if ($opthal_contact === null) {
                    $opthal_contact = new Contact();
                    $opthal_contact->first_name = $patient['opthal_first_name'];
                    $opthal_contact->last_name = $patient['opthal_last_name'];
                    $opthal_contact->label = $opthal_label;
                    if (!$opthal_contact->save()) {
                        $errors[] = 'Could not save new ophthalmologist contact';
                        array_unshift($errors, $opthal_contact->getErrors());
                        return $errors;
                    }
                }
                $pat_con = new PatientContactAssignment();
                $pat_con->contact = $opthal_contact;
                if (!$pat_con->save()) {
                    $errors[] = 'Could not save ophthalmologist contact assignment';
                    array_unshift($errors, $pat_con->getErrors());
                    return $errors;
                }
                $new_gp = new Gp();
                $new_gp->obj_prof = 0;
                $new_gp->nat_id = 0;
                $new_gp->contact = $pat_con;
                if (!$new_gp->save()) {
                    $errors[] = 'Could not save new opthal contact';
                    array_unshift($errors, $new_gp->getErrors());
                    return $errors;
                }
            } else {
                $errors[] = 'Both names must be present to import ophthalmologist';
                return $errors;
            }
        }

        //Gp
        if(isset($patient['gp_first_name']) or isset($patient['gp_last_name'])){
            if(isset($patient['gp_first_name']) and isset($patient['gp_last_name'])) {
                $gp_label = ContactLabel::model()->findByAttributes(array('name' => 'General Practitioner'));
                $gp_contact = Contact::model()->findByAttributes(array(
                    'contact_label_id' => $gp_label->id,
                    'first_name' => $patient['gp_first_name'],
                    'last_name' => $patient['gp_last_name'],
                ));
                if ($gp_contact === null) {
                    $gp_contact = new Contact();
                    $gp_contact->first_name = $patient['gp_first_name'];
                    $gp_contact->last_name = $patient['gp_last_name'];
                    $gp_contact->label = $gp_label;
                    if (!$gp_contact->save()) {
                        $errors[] = 'Could not save new GP contact';
                        array_unshift($errors, $gp_contact->getErrors());
                        return $errors;
                    }
                    $new_gp = new Gp();
                    $new_gp->obj_prof = 0;
                    $new_gp->nat_id = 0;
                    $new_gp->contact = $gp_contact;
                    if (!$new_gp->save()) {
                        $errors[] = 'Could not save new practitioner contact';
                        array_unshift($errors, $new_gp->getErrors());
                        return $errors;
                    }
                }
                $pat_con = new PatientContactAssignment();
                $pat_con->contact = $gp_contact;
                if (!$pat_con->save()) {
                    $errors[] = 'Could not save general practitioner contact';
                    array_unshift($errors, $pat_con->getErrors());
                    return $errors;
                }
            } else {
                $errors[] = 'Both names are required to import GP';
                return $errors;
            }
        }
        
        //diagnoses
        if(isset($patient['LE_diagnosis']) || isset($patient['RE_diagnosis'])){
            $context = Firm::model()->findByAttributes(array(
                'name' => isset($patient['context']) ? $patient['context'] :  'Medical Retinal firm'
            ));
            $episode = new Episode();
            $episode->firm = $context;
            if(!$episode->save()){
                $errors[] = 'Could not save new episode';
                array_unshift($errors, $episode->getErrors());
                return $errors;
            }

            $event = new Event();
            $event->event_type_id = EventType::model()->findByAttributes(array(
                'name' => 'Examination'
            ))->id;
            $event->episode = $episode;

            if(!$event->save()){
                $errors[] = 'Could not save new event';
                array_unshift($errors, $event->getErrors());
                return $errors;
            }

            $element = new \OEModule\OphCiExamination\models\Element_OphCiExamination_Diagnoses();
            $element->event = $event;

            if(!$element->save()){
                $errors[] = 'could not save diagnoses element';
                array_unshift($errors, $element->getErrors());
            }

            if(isset($patient['LE_diagnosis'])){
                $disorder = Disorder::model()->findByAttributes(array(
                    'fully_specified_name' => $patient['LE_diagnosis']
                ));
                if($disorder === null){
                    $errors[] = 'Could not find left eye diagnosis '.$patient['LE_diagnosis'];
                    return $errors;
                }
                $diagnosis = new \OEModule\OphCiExamination\models\OphCiExamination_Diagnosis();
                $diagnosis->element_diagnoses_id = $element->id;
                $diagnosis->disorder_id = $disorder->id;
                $diagnosis->eye_id = Eye::LEFT;
                if(!$diagnosis->save()){
                    $errors[] = 'Could not save left eye diagnosis';
                    array_unshift($errors, $diagnosis->getErrors());
                    return $errors;
                }
            }
            if(isset($patient['RE_diagnosis'])){
                $disorder = Disorder::model()->findByAttributes(array(
                    'fully_specified_name' => $patient['LE_diagnosis']
                ));
                if($disorder === null){
                    $errors[] = 'Could not find right eye diagnosis '.$patient['RE_diagnosis'];
                    return $errors;
                }
                $diagnosis = new \OEModule\OphCiExamination\models\OphCiExamination_Diagnosis();
                $diagnosis->element_diagnoses_id = $element->id;
                $diagnosis->disorder_id = $disorder->id;
                $diagnosis->eye_id = Eye::RIGHT;
                if(!$diagnosis->save()){
                    $errors[] = 'Could not save right eye diagnosis';
                    array_unshift($errors, $diagnosis->getErrors());
                    return $errors;
                }
            }
        }

        return $errors;
    }

    private function createNewTrialPatient($trial_patient)
    {
        $errors = array();
        //trial
        $trial = null;
        if(isset($trial_patient['trial_name'])){
            $trial = Trial::model()->findByAttributes(array('name' => $trial_patient['trial_name']));
        }
        if ($trial === null){
            $errors[] = 'trial not found, please check the trial name';
            return $errors;
        }

        //patient
        $patient = null;
        if(isset($trial_patient['CERA_number'])){
            $patient = Patient::model()->findByAttributes(array('hos_num' => $trial_patient['CERA_number']));
        }
        if ($patient === null){
            $errors[] = 'patient not found, please check the CERA number';
            return $errors;
        }

        $new_trial_pat = new TrialPatient();
        $trial_pat_cols = array(
            array('var_name' => 'external_trial_identifier', 'default' => null,),
            array('var_name' => 'patient_status'           , 'default' => TrialPatient::STATUS_ACCEPTED,),
            array('var_name' => 'treatment_type'           , 'default' => null,),
            array('var_name' => 'created_date'             , 'default' => null,),
        );

        foreach ($trial_pat_cols as $col){
            $new_trial_pat->$col['var_name'] =
                isset($new_trial_pat[$col['var_name']]) ? $new_trial_pat[$col['var_name']] : $col['default'];
        }

        $new_trial_pat->patient_id = $patient->id;
        $new_trial_pat->trial_id = $trial->id;

        if(!$new_trial_pat->save()){
            return $new_trial_pat->getErrors();
        }
    }

}