<?php

class GpController extends BaseController
{
    public function filters()
    {
        return array(
            'accessControl',
            'ajaxOnly + create',
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('create'),
                'users' => array('@'),
            ),
        );
    }
    public function actionCreate()
    {

        $gp = new Gp();
        $contact = new Contact();

       $contact->attributes = $_POST['Contact'];
       list($contact, $gp) = $this->performGpSave($contact, $gp);

       echo CJSON::encode(array('label'=> $contact->getFullName()
       ,'value'=> $gp->getPrimaryKey()));

    }

    private function performGpSave(Contact $contact, Gp $gp)
    {
        $transaction = Yii::app()->db->beginTransaction();
      try {
            if( $contact->save() ){
                $gp->contact_id = $contact->getPrimaryKey();
                $gp->nat_id = 0;
                $gp->obj_prof = 0;



                if($gp->save() ) {
                    $transaction->commit();
                }
                else {
                    $transaction->rollback();
                }
            }
            else {
                $transaction->rollback();
            }




        } catch (Exception $ex) {
            OELog::logException($ex);
            $transaction->rollback();
        }


        return array($contact, $gp);
    }

}