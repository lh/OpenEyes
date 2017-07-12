<?php

class PracticeController extends BaseController
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
        $contact = new Contact();
        $address = new Address();
        $practice = new Practice();

        $contact->attributes = $_POST['Contact'];
        $address->attributes = $_POST['Address'];
        $practice->attributes = $_POST['Practice'];
        list($contact,$practice,$address) = $this->performGpSave($contact, $practice,$address);

        echo CJSON::encode(array('label'=> $practice->getAddressLines()
        ,'value'=> $practice->getPrimaryKey()));
    }

    public function performGpSave(Contact $contact, Practice $practice,Address $address)
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            if( $contact->save() ){
                $practice->contact_id = $contact->getPrimaryKey();
                $address->contact_id = $contact->id;
                if($practice->save()  && $address->save()) {
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
        return array($contact, $practice,$address);
    }
}