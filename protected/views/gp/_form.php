<?php
/* @var $this GpController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gp-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    )); ?>

  <p class="note text-right">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

  <div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'title'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->textField($model, 'title', array('size' => 30, 'maxlength' => 20)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
      </div>
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'first_name'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->textField($model, 'first_name', array('size' => 30, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'first_name'); ?>
        </div>
      </div>

      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'last_name'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->textField($model, 'last_name', array('size' => 30, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'last_name'); ?>
        </div>
      </div>

      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'primary_phone'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->telField($model, 'primary_phone', array('size' => 15, 'maxlength' => 20)); ?>
            <?php echo $form->error($model, 'primary_phone'); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row buttons text-right">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->