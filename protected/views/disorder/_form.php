<?php
/* @var DisorderController $this */
/* @var Disorder $model */
?>
<?php
?>

<div class="form">

    <?php /* @var CActiveForm $form */
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'disorder-form',
        'enableAjaxValidation' => true,
    )); ?>

  <p class="note text-right">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary(array($model)); ?>
  <div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'term'); ?></div>
        <div class="large-9 column end">
            <?php echo $form->textField($model, 'term', array('size' => 80, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'term'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'fully_specified_name'); ?></div>
        <div class="large-9 column end">
            <?php echo $form->textField($model, 'fully_specified_name', array('size' => 80, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'fully_specified_name'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'is_ophthalmic'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->checkBox($model, 'is_ophthalmic',
                array('onchange' => 'toggleSpecialty(this)')); ?>
            <?php echo $form->error($model, 'is_ophthalmic'); ?>
        </div>
      </div>
    </div>
  </div>
  <div id="specialty_row" class="row field-row"
       <?php if ($model->is_ophthalmic): ?>style="display: none"<?php endif; ?>>
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'specialty_id'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->dropDownList($model, 'specialty_id',
                CHtml::listData(Specialty::model()->findAll('code != 130'), 'id', 'name'),
                array('empty' => 'No Specialty')); ?>
            <?php echo $form->error($model, 'specialty_id'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row field-row">
    <div class="large-6 column">
      <div class="row field-row">
        <div class="large-3 column"><?php echo $form->labelEx($model, 'active'); ?></div>
        <div class="large-4 column end">
            <?php echo $form->checkBox($model, 'active'); ?>
            <?php echo $form->error($model, 'active'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row buttons text-right">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
  function toggleSpecialty(object) {
    var isOtherSpecialty = !$(object).is(':checked');
    $('#specialty_row').toggle(isOtherSpecialty);
  }
</script>