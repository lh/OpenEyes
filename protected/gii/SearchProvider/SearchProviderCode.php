<?php

/**
 * Created by PhpStorm.
 * User: andre
 * Date: 26/05/2017
 * Time: 4:20 PM
 */
class SearchProviderCode extends CCodeModel
{
    public $className;

    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('className', 'required'),
            array('className', 'match', 'pattern' => '/^\w+$/'),
            array('className', 'sticky')
        ));
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'className' => 'Search Provider Class Name',
        ));
    }

    public function prepare()
    {
        $providerPath = Yii::getPathOfAlias('application.components.' . $this->className) . '.php';
        $providerCode = $this->render($this->templatePath.'/search_provider.php');
        $interfacePath = Yii::getPathOfAlias('application.components.' . $this->className) . 'Interface.php';
        $interfaceCode = $this->render($this->templatePath.'/search_provider_interface.php');
        $this->files[] = new CCodeFile($providerPath, $providerCode);
        $this->files[] = new CCodeFile($interfacePath, $interfaceCode);
    }
}