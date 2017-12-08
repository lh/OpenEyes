<?php
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
if (isset($errors) and $errors !== null) {
    echo '<pre>';
    var_dump($errors);
    echo '</pre>';
}
echo CHtml::submitButton('Submit');
$this->endWidget();

