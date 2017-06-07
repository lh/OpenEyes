<?php

/**
 * Created by PhpStorm.
 * User: andre
 * Date: 26/05/2017
 * Time: 4:20 PM
 */
class CaseSearchParameterCode extends CCodeModel
{
    public $className;
    public $alias;
    public $name;
    public $attributeList;

    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('className, name, alias', 'required'),
            array('className, alias', 'match', 'pattern' => '/^\w+$/'),
            array('attributeList', 'match', 'pattern' => '/^[\w,]+$/'),
            array('className, name, alias, attributeList', 'sticky')
        ));
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'className' => 'Parameter Class Name',
            'name' => 'Parameter Name',
            'alias' => 'SQL alias prefix',
            'attributeList' => 'Attributes'
        ));
    }

    public function prepare()
    {
        $parameterPath = Yii::getPathOfAlias('application.modules.OECaseSearch.models.' . $this->className) . 'Parameter.php';
        $parameterCode = $this->render($this->templatePath.'/case_search_parameter.php');
        $testPath = Yii::getPathOfAlias('application.modules.OECaseSearch.tests.unit.models.' . $this->className) . 'Test.php';
        $testCode = $this->render($this->templatePath.'/case_search_parameter_test.php');
        $this->files[] = new CCodeFile($parameterPath, $parameterCode);
        $this->files[] = new CCodeFile($testPath, $testCode);
    }
}