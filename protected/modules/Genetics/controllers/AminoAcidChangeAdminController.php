<?php

/**
 * Class AminoAcidChangeAdminController
 *
 * Admin controller class for PedigreeAminoAcidChangeType
 */
class AminoAcidChangeAdminController extends BaseAdminController
{
    /**
     * @var string
     */
    public $layout = 'genetics';

    protected $itemsPerPage = 100;

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('Edit', 'Delete'),
                'roles' => array('Genetics Admin'),
            ),
            array('allow',
                'actions' => array('List', 'View'),
                'roles' => array('Genetics Admin'),
            ),
        );
        
        //return array(array('allow', 'roles' => array('Genetics Admin')));
    }

    public function actionView($id)
    {
        $admin = $this->loadModel($id);
        $this->render('view', array('model' => $admin));
    }

    /**
     * Lists PedigreeAminoAcidChangeType.
     *
     * @throws CHttpException
     */
    public function actionList()
    {
        $admin = new Admin(PedigreeAminoAcidChangeType::model(), $this);
        $admin->setModelDisplayName('Amino Acid Change Type');
        $admin->setListFields(array(
            'id',
            'change',
        ));
        $admin->searchAll();
        $admin->getSearch()->setItemsPerPage($this->itemsPerPage);
        $admin->getSearch()->setDefaultResults(false);
        $admin->listModel();
    }

    /**
     * Edits or adds a Amino Acid Change Type.
     *
     * @param bool|int $id
     *
     * @throws CHttpException
     */
    public function actionEdit($id = false)
    {
        $admin = new Admin(PedigreeAminoAcidChangeType::model(), $this);
        if ($id) {
            $admin->setModelId($id);
        }
        $admin->setModelDisplayName('Amino Acid Change Type');
        $admin->setEditFields(array(
            'referer' => 'referer',
            'change' => 'text',
        ));
        $admin->setCustomCancelURL(Yii::app()->request->getUrlReferrer());    

        $valid = $admin->editModel(false);

        if (Yii::app()->request->isPostRequest) {        
            if ($valid) {
                Yii::app()->user->setFlash('success', "Amino Acid Change Type Saved");
                $url = '/Genetics/aminoAcidChangeAdmin/view/'.$admin->getModel()->id;
                $this->redirect($url);
            } else {
                $admin->render($admin->getEditTemplate(), array('admin' => $admin, 'errors' => $admin->getModel()->getErrors()));
            }
        }
    }

    /**
     * Deletes rows for the model.
     */
    public function actionDelete()
    {
        $admin = new Admin(PedigreeAminoAcidChangeType::model(), $this);
        $admin->deleteModel();
    }
    
     /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param int $id the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = PedigreeAminoAcidChangeType::model()->findByPk((int) $id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}