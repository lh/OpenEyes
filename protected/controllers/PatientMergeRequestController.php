<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class PatientMergeRequestController extends BaseController
{
    public $firm;
    
    /**
     * @var string the default layout for the views
     */
    public $layout = '//layouts/main';
    
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'create', 'view', 'merge', 'editConflict', 'search', 'delete', 'update'),
                'roles' => array('Patient Merge'),
            ),
            
            array('allow',
                'actions' => array('index', 'create', 'view', 'search', 'update'),
                'roles' => array('Patient Merge Request'),
            ),
            
        );
    }
    
    public function init()
    {
        Yii::app()->assetManager->registerScriptFile('js/patient_merge.js');
    }

    public function beforeAction($action)
    {
        parent::storeData();
        $this->firm = Firm::model()->findByPk($this->selectedFirmId);
        return parent::beforeAction($action);
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $filters = Yii::app()->request->getParam('PatientMergeRequestFilter');
        
        // Do not show already merged ones
        $showMerged = ' AND status !=' . PatientMergeRequest::STATUS_MERGED;

        if( $filters['show_merged'] && $filters['show_merged'] == 1 ){
            $showMerged = '';
        }
        
        $dataProvider = new CActiveDataProvider('PatientMergeRequest', array(
            'criteria'=>array(
                'condition' => 'deleted=0' . $showMerged
            )
        ));
        
        $pagination = new CPagination($dataProvider->itemCount);
        $pagination->pageSize = 25;
        
        
        $this->render('//patientmergerequest/index', array(
            'dataProvider'=>$dataProvider,
            'pagination' => $pagination,
            'filters' => $filters
        ));
    }
    
    public function actionCreate()
    {
        
        $model = new PatientMergeRequest;
        
        $patientMergeRequest = Yii::app()->request->getParam('PatientMergeRequest', null);
            
        if($patientMergeRequest) {
            
            // the Primary and Secondary user cannot be the same user , same database record I mean
            if( ( !empty($patientMergeRequest['secondary_id']) && !empty($patientMergeRequest['primary_id']) )&& $patientMergeRequest['secondary_id'] == $patientMergeRequest['primary_id']){
                Yii::app()->user->setFlash("warning.merge_error", "The Primary and Secondary patient cannot be the same. Record cannot be merged into itself.");
            } else {
                
                if ( empty($patientMergeRequest['secondary_id']) || empty($patientMergeRequest['primary_id'])){
                    Yii::app()->user->setFlash("warning.merge_error", "Both Primary and Secondary patients have to be selected.");
                } else {
                    $model->attributes = $patientMergeRequest;
                    if($model->save()){
                        $this->redirect(array('index'));
                    }
                }
            }
        }
       
        $this->render('//patientmergerequest/create',array(
            'model' => $model,
            
        ));
    }
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        
        $log = array();
        foreach(json_decode($model->merge_json, true)['log'] as $key => $log_row){
            $log[] = array(
                'id' => $key,
                'log' => $log_row
            );
        }
        
        $this->render('//patientmergerequest/view', array(
            'model' => $model,
            'dataProvider' => new CArrayDataProvider( $log ),
        ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
    */
   public function actionUpdate($id)
   {
           $model = $this->loadModel($id);

           if(isset($_POST['PatientMergeRequest']))
           {
                $model->attributes=$_POST['PatientMergeRequest'];
                if( $model->status == PatientMergeRequest::STATUS_MERGED ){
                    $this->redirect(array('view','id' => $model->id));
                } else if($model->save()){
                   // will return to the index page
                }
           }
           
           $this->redirect(array('index'));
   }
    
    /**
     * Merging patients
     * @param integer $id the ID of the model to be displayed
     */
    public function actionMerge($id)
    {
        $mergeRequest = $this->loadModel($id);
        
        $mergeHandler = new PatientMerge;
        
        // if the personal details are conflictng (DOB and Gender at the moment) we need extra confirmation
        $personalDetailsConflictConfirm = $mergeHandler->comparePatientDetails($mergeRequest->primaryPatient, $mergeRequest->secondaryPatient);
        
        if(isset($_POST['PatientMergeRequest']) && isset($_POST['PatientMergeRequest']['confirm'])){
                
            // if personal details are not conflictin than its fine, 
            // but if there is a conflict we need the extra confirmation
            if( !$personalDetailsConflictConfirm['isConflict'] || ($personalDetailsConflictConfirm['isConflict'] && isset($_POST['PatientMergeRequest']['personalDetailsConflictConfirm'])) ){

                // Load data from PatientMergeRequest AR record
                $mergeHandler->load($mergeRequest);

                if($mergeHandler->merge()){
                    $msg = "Merge Request " . $mergeRequest->secondaryPatient->hos_num . " INTO " . $mergeRequest->primaryPatient->hos_num . "(hos_num) successfully done.";
                    $mergeHandler->addLog($msg);
                    $mergeRequest->status = $mergeRequest::STATUS_MERGED;
                    $mergeRequest->merge_json = json_encode( array( 'log' => $mergeHandler->getLog() ) );
                    $mergeRequest->save();
                    Audit::add('Patient Merge', $msg);
                    $this->redirect(array('view', 'id' => $mergeRequest->id));
                } else {
                    $msg = "Merge Request " . $mergeRequest->secondaryPatient->hos_num . " INTO " . $mergeRequest->primaryPatient->hos_num . " FAILED.";
                    $mergeHandler->addLog($msg);
                    $mergeRequest->status = $mergeRequest::STATUS_CONFLICT;
                    $mergeRequest->merge_json = json_encode( array( 'log' => $mergeHandler->getLog() ) );
                    $mergeRequest->save();
                    Yii::app()->user->setFlash('warning.search_error', "Merge failed.");
                    $this->redirect(array('index'));
                }
            }
        }
        
        $primary = Patient::model()->findByPk($mergeRequest->primary_id);
        $secondary = Patient::model()->findByPk($mergeRequest->secondary_id);
        
        $this->render('//patientmergerequest/merge', array(
            'model' => $mergeRequest,
            'personalDetailsConflictConfirm' => $personalDetailsConflictConfirm['isConflict'],
            'primaryPatientJSON' => CJavaScript::jsonEncode(array(
                            'id' => $primary->id,
                            'first_name' => $primary->first_name,
                            'last_name' => $primary->last_name,
                            'age' => ($primary->isDeceased() ? 'Deceased' : $primary->getAge()),
                            'gender' => $primary->getGenderString(),
                            'genderletter' => $primary->gender,
                            'dob' => ($primary->dob) ? $primary->NHSDate('dob') : 'Unknown',
                            'hos_num' => $primary->hos_num, 
                            'nhsnum' => $primary->nhsnum,
                            'all-episodes' => htmlentities (str_replace(array("\n", "\r", "\t"), '', $this->getEpisodesHTML($primary) ) ),
                        )
                    ),
            
            'secondaryPatientJSON' => CJavaScript::jsonEncode(array(
                            'id' => $secondary->id,
                            'first_name' => $secondary->first_name,
                            'last_name' => $secondary->last_name,
                            'age' => ($secondary->isDeceased() ? 'Deceased' : $secondary->getAge()),
                            'gender' => $secondary->getGenderString(),
                            'genderletter' => $secondary->gender,
                            'dob' => ($secondary->dob) ? $secondary->NHSDate('dob') : 'Unknown',
                            'hos_num' => $secondary->hos_num,
                            'nhsnum' => $secondary->nhsnum,
                            'all-episodes' => htmlentities (str_replace(array("\n", "\r", "\t"), '', $this->getEpisodesHTML($secondary) ) ),
                        )
                    ),
            
        ));
    }
    
    public function actionDelete()
    {        
        if( isset($_POST['patientMergeRequest']) ){

            foreach (PatientMergeRequest::model()->findAllByPk($_POST['patientMergeRequest']) as $request) {
              
                $request->deleted = 1;
               
                if ( $request->save() ) {
                    Audit::add('Patient Merge', 'Patient Merge Request Deleted: ');
                }
            }
        }
    }
    
    
    
 /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PatientMergeRequest the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = PatientMergeRequest::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
   
    public function actionSearch()
    {
        $term = trim(\Yii::app()->request->getParam("term", ""));
        $result = array();
        
        $patientSearch = new PatientSearch();
        
        if($patientSearch->isValidSearchTerm($term)){
            $dataProvider = $patientSearch->search($term);
            foreach($dataProvider->getData() as $patient){
                
                $result[] =  array(
                    'id' => $patient->id,
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'age' => ($patient->isDeceased() ? 'Deceased' : $patient->getAge()),
                    'gender' => $patient->getGenderString(),
                    'genderletter' => $patient->gender,
                    'dob' => ($patient->dob) ? $patient->NHSDate('dob') : 'Unknown',
                    'hos_num' => $patient->hos_num, 
                    'nhsnum' => $patient->nhsnum,
                    'all-episodes' => $this->getEpisodesHTML($patient)
                );
            }
        }
        
       echo CJavaScript::jsonEncode($result);
       Yii::app()->end();
       
   }
   
    public function getEpisodesHTML($patient)
    {
       
       $episodes = $patient->episodes;
    
        $episodes_open = 0;
        $episodes_closed = 0;

        foreach ($episodes as $episode) {
            if ($episode->end_date === null) {
                $episodes_open++;
            } else {
                $episodes_closed++;
            }
        }
        
        
                
       $html = $this->renderPartial('//patient/_patient_all_episodes',array(
                                                    'episodes' => $episodes,
                                                    'ordered_episodes' => $patient->getOrderedEpisodes(),
                                                    'legacyepisodes' => $patient->legacyepisodes,
                                                    'episodes_open' => $episodes_open,
                                                    'episodes_closed' => $episodes_closed,
                                                    'firm' => $this->firm,
                                            ), true);
       
       // you don't know how much I hate this str_replace here, but now it seems a painless method to remove a class
       return str_replace("box patient-info episodes", "box patient-info", $html);
   }
   
   
}
