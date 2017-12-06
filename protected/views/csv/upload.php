<?php
/**
 * Created by PhpStorm.
 * User: fivium-isaac
 * Date: 12/4/17
 * Time: 7:58 AM
 */

$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'action' => Yii::app()->createURL('csv/preview', array('context' => $context)),
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);

echo $form->fileField(new Csv(), 'csvFile');
if(isset($errors) and $errors !== null) {
    echo '<pre>';
    var_dump($errors);
    echo '</pre>';
}
echo CHtml::submitButton('Submit');
$this->endWidget();

