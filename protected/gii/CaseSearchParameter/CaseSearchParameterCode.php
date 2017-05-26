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

    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('className, name, alias', 'required'),
            array('className, alias', 'match', 'pattern' => '/^\w+$/'),
        ));
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'className' => 'Parameter Class Name',
            'name' => 'Parameter Name',
            'alias' => 'SQL alias prefix'
        ));
    }

    public function prepare()
    {
        $path = Yii::getPathOfAlias('application.modules.OECaseSearch.models.' . $this->className) . '.php';
        $code = $this->render($this->templatePath.'/case_search_parameter.php');
        $this->files[] = new CCodeFile($path, $code);
    }
}