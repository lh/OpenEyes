<?php
/* @var $this PracticeController */
/* @var $model Practice */
/* @var $contact Contact */
/* @var $address Address */
/* @var $form CActiveForm */
?>
<?php
$countries = CHtml::listData(Country::model()->findAll(), 'id', 'name');
$address_type_ids = CHtml::listData(AddressType::model()->findAll(), 'id', 'name');
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'practice-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    )); ?>

    <p class="note text-right">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary(array($contact, $model, $address)); ?>
    <div class="row field-row">
        <div class="large-6 column">
            <div class="row field-row">
                <div class="large-3 column"><?php echo $form->labelEx($contact, 'first_name'); ?></div>
                <div class="large-4 column end">
                    <?php echo $form->textField($contact, 'first_name', array('size' => 40, 'maxlength' => 100)); ?>
                    <?php echo $form->error($contact, 'first_name'); ?>
                </div>
            </div>
            <div class="row field-row">
                <div class="large-3 column"><?php echo $form->labelEx($model, 'phone'); ?></div>
                <div class="large-4 column end">
                    <?php echo $form->telField($model, 'phone', array('size' => 15, 'maxlength' => 64)); ?>
                    <?php echo $form->error($model, 'phone'); ?>
                </div>
            </div>
        </div>
        <div class="large-6 column">
            <?php $this->renderPartial('../patient/_form_address', array(
                'form' => $form,
                'address' => $address,
                'countries' => $countries,
            )); ?>
        </div>
    </div>
    <div class="row buttons text-right">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->