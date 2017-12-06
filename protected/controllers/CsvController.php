<?php
/**
 * Created by PhpStorm.
 * User: fivium-isaac
 * Date: 12/1/17
 * Time: 3:18 PM
 */

\Yii::import('application.modules.OETrial.models.*');

class CsvController extends BaseController
{
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
        if ($context === 'trials')$this->importTrials();
        if ($context === 'patients')$this->importPatients();
    }

    private function importTrials()
    {
        $transaction = Yii::app()->db->beginTransaction();
        $errors = null;
        $row_num = 0;
        foreach ($_SESSION['table_data'] as $trial) {
            $row_num++;
            $errors = $this->createNewTrial($trial);
            if(!empty($errors))break;
        }
        if (empty($errors)){
            $transaction->commit();
            $this->redirect(Yii::app()->createURL('OETrial/trial'));
        } else {
            $transaction->rollback();
            array_unshift($errors, 'Errors with trial on line '.$row_num);
            $this->render(
                'upload',
                array(
                    'errors' => $errors,
                    'context' => 'trials',
                )
            );
        }

    }

    public function createNewTrial($trial)
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
            $trial['trial_type'] = 'INTERVENTION';
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

    public function importPatients()
    {
        $errors = array();
        $transaction = Yii::app()->db->beginTransaction();
        $row_num = 0;

        foreach ($_SESSION['table_data'] as $patient) {
            $row_num++;
            $errors = $this->createNewPatient($patient);
            if(!empty($errors))break;
        }

        if (empty($errors)){
            $transaction->commit();
            $this->redirect(Yii::app()->createURL('site/index'));
        } else {
            $transaction->rollback();
            array_unshift($errors, 'Errors with patient on line '.$row_num);
            $this->render(
                'upload',
                array(
                    'errors' => $errors,
                    'context' => 'patients',
                )
            );
        }
    }

    public function createNewPatient($patient)
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
            array('var_name' => 'gp_id'                         , 'default' => null,),
            array('var_name' => 'date_of_death'                 , 'default' => null,),
            array('var_name' => 'practice_id'                   , 'default' => null,),
            array('var_name' => 'ethnic_group_id'               , 'default' => null,),
            array('var_name' => 'archive_no_allergies_date'     , 'default' => null,),
            array('var_name' => 'archive_no_family_history_date', 'default' => null,),
            array('var_name' => 'archive_no_risks_date'         , 'default' => null,),
            array('var_name' => 'deleted'                       , 'default' => null,),
            array('var_name' => 'nhs_num_status_id'             , 'default' => null,),
            array('var_name' => 'is_deceased'                   , 'default' => null,),
            array('var_name' => 'is_local'                      , 'default' => null,),
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

        return $errors;
    }

}