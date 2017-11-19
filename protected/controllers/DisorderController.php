<?php

/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
class DisorderController extends BaseController
{
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('autoComplete', 'details', 'isCommonOphthalmic'),
                'roles' => array('OprnViewClinical'),
            ),
            array(
                'allow',
                'actions' => array('index', 'view'),
                'roles' => array('TaskViewDisorder'),
            ),
            array(
                'allow',
                'actions' => array('create', 'update'),
                'roles' => array('TaskManageDisorder'),
            ),
            array(
                'deny',  // deny all other users
                'users' => array('*'),
            ),

        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Disorder the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        /* @var Disorder $model */
        $model = Disorder::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $disorder = new Disorder();
        $disorder->is_ophthalmic = true;
        $this->performAjaxValidation(array($disorder));

        if (isset($_POST['Disorder'])) {
            $disorder->attributes = $_POST['Disorder'];

            if ($disorder->is_ophthalmic === '1' &&
                (null === $disorder->specialty_id || empty($disorder->specialty_id))) {
                $disorder->specialty_id = Specialty::model()->find('name = "Ophthalmology"')['id'];
            }

            if ($disorder->save()) {
                $this->redirect($this->createUrl('view', array('id' => $disorder->id)));
            }
        }

        $this->render('create', array(
            'model' => $disorder,
        ));
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel|array $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'disorder-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $disorder = $this->loadModel($id);
        // The disorder is ophthalmic if the specialty is set to "Ophthalmology"
        $disorder->is_ophthalmic = $disorder->specialty != null && $disorder->specialty->code == 130;

        $this->performAjaxValidation($disorder);

        if (isset($_POST['Disorder'])) {
            $disorder->attributes = $_POST['Disorder'];

            if ($disorder->is_ophthalmic) {
                $disorder->specialty_id = Specialty::model()->find('code = :code', array(':code' => 130))->id;
            }

            if ($disorder->save()) {
                $this->redirect($this->createUrl('/disorder/view', array('id' => $disorder->id)));
            }
        }

        $this->render('update', array(
            'model' => $disorder,
        ));
    }

    /**
     * Lists all models.
     * @param string $search_term
     */
    public function actionIndex($search_term = null)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'term';

        if ($search_term !== null) {
            $criteria->addSearchCondition('LOWER(term)', strtolower($search_term), true, 'OR');
            $criteria->addSearchCondition('LOWER(fully_specified_name)', strtolower($search_term), true, 'OR');
        }

        $dataProvider = new CActiveDataProvider('Disorder', array('criteria' => $criteria));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'search_term' => $search_term,
        ));
    }

    /**
     * Generate array structure of disorder for JSON structure return
     *
     * @param Disorder $disorder
     * @return array
     */
    protected function disorderStructure(Disorder $disorder)
    {
        return array(
            'label' => $disorder->term,
            'value' => $disorder->term,
            'id' => $disorder->id,
            'is_diabetes' => Disorder::model()->ancestorIdsMatch(array($disorder->id), Disorder::$SNOMED_DIABETES_SET),
            'is_glaucoma' => (strpos(strtolower($disorder->term), 'glaucoma') !== false),
        );
    }


    /**
     * Lists all disorders for a given search term.
     */
    public function actionAutocomplete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $criteria = new CDbCriteria();
            $params = array();
            if (isset($_GET['term']) && $term = $_GET['term']) {
                $criteria->addCondition('LOWER(term) LIKE :term');
                $params[':term'] = '%' . strtolower(strtr($term, array('%' => '\%'))) . '%';
            }
            $criteria->order = 'term';

            // Limit results
            $criteria->limit = '200';
            if (@$_GET['code']) {
                if (@$_GET['code'] == 'systemic') {
                    $criteria->addCondition('specialty_id is null');
                } else {
                    $criteria->join = 'join specialty on specialty_id = specialty.id AND specialty.code = :specode';
                    $params[':specode'] = $_GET['code'];
                }
            }

            $criteria->params = $params;

            $disorders = Disorder::model()->active()->findAll($criteria);
            $return = array();
            foreach ($disorders as $disorder) {
                $return[] = $this->disorderStructure($disorder);
            }
            echo CJSON::encode($return);
        }
    }

    /**
     * @param $type
     */
    public function actionGetCommonlyUsedDiagnoses($type)
    {
        $return = array();
        if ($type === 'systemic') {
            foreach (CommonSystemicDisorder::getDisorders() as $disorder) {
                $return[] = $this->disorderStructure($disorder);
            };
        }

        echo CJSON::encode($return);
        Yii::app()->end();

    }

    public function actionDetails()
    {
        if (!isset($_REQUEST['name'])) {
            echo CJavaScript::jsonEncode(false);
        } else {
            $disorder = Disorder::model()->find('fully_specified_name = ? OR term = ?',
                array($_REQUEST['name'], $_REQUEST['name']));
            if ($disorder) {
                echo $disorder->id;
            } else {
                echo CJavaScript::jsonEncode(false);
            }
        }
    }

    public function actionIsCommonOphthalmic($id)
    {
        $firm = Firm::model()->findByPk(Yii::app()->session['selected_firm_id']);

        if ($cd = CommonOphthalmicDisorder::model()->find('disorder_id=? and subspecialty_id=?',
            array($id, $firm->serviceSubspecialtyAssignment->subspecialty_id))) {
            echo "<option value=\"$cd->disorder_id\" data-order=\"{$cd->display_order}\">" . $cd->disorder->term . '</option>';
        }
    }
}
