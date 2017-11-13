<?php
/* @var $this GpController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    \Yii::app()->assetManager->RegisterScriptFile('js/Gp.js');

    $form = $this->beginWidget('CActiveForm', array(
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
    <div class="column">
      <div class="row field-row">
        <div class="column"><?php echo $form->labelEx($model, 'title'); ?></div>
        <div class="column end">
            <?php echo $form->textField($model, 'title', array('size' => 30, 'maxlength' => 20)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
      </div>
      <div class="row field-row">
        <div class="column"><?php echo $form->labelEx($model, 'first_name'); ?></div>
        <div class="column end">
        <?php echo $form->textField($model, 'first_name', array('size' => 30, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'first_name'); ?>
        </div>
      </div>

      <div class="row field-row">
        <div class="column"><?php echo $form->labelEx($model, 'last_name'); ?></div>
        <div class="column end">
            <?php echo $form->textField($model, 'last_name', array('size' => 30, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'last_name'); ?>
        </div>
      </div>

      <div class="row field-row">
        <div class="column"><?php echo $form->labelEx($model, 'primary_phone'); ?></div>
        <div class="column end">
            <?php echo $form->telField($model, 'primary_phone', array('size' => 15, 'maxlength' => 20)); ?>
            <?php echo $form->error($model, 'primary_phone'); ?>
        </div>
      </div>

      <div class="row field-row">
        <div class="column">
            <?php echo $form->labelEx($model, 'Role'); ?>
        </div>
        <div class="column end">
            <?php echo $form->error($model, 'contact_label_id'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'contact_label_id',
                'id' => 'autocomplete_contact_label_id',
                'source' => "js:function(request, response) {
                                $.getJSON('/gp/contactLabelList', {
                                   term : request.term
                                }, response);
                        }",
                'options' => array(
                    'select' => "js:function(event, ui) {
                                removeSelectedContactLabel();
                                addItem('selected_contact_label_wrapper', ui);   
                                $('#autocomplete_contact_label_id').val('');
                                return false;
                                }",
                    'response' => 'js:function(event, ui){
                          if(ui.content.length === 0){
                            $("#no_contact_label_result").show();
                          } else {
                            $("#no_contact_label_result").hide();
                          }
                        }',
                ),
                'htmlOptions' => array(
                    'placeholder' => 'search Roles',
                ),
            ));
            ?>
        </div>
      </div>
      <div id="selected_contact_label_wrapper" class="row field-row <?php echo $model->label ? '' : 'hide' ?>">
        <div class="column selected_contact_label end alert-box">
          <span class="name">
            <?php echo isset($model->label) ? $model->label->name : ''; ?>
          </span>
          <a href="javascript:void(0)" class="remove right" style="color:blue">remove</a>
        </div>
          <?php echo CHtml::hiddenField('Contact[contact_label_id]'
              , $model->contact_label_id, array('class' => 'hidden_id')); ?>
      </div>
      <div id="no_contact_label_result" class="row field-row hide">
        <div class="large-offset-4  column selected_gp end">No result
        </div>
      </div>
    </div>
  </div>

  <div class="row buttons text-right">
      <?php if ($context !== 'AJAX') {
          echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
      } else {
          echo CHtml::ajaxButton('Add',
              Yii::app()->controller->createUrl('gp/create', array('context' => 'AJAX')),
              array(
                  'type' => 'POST',
                  'error' => 'js:function(){
                 new OpenEyes.UI.Dialog.Alert({
                 content: "First name and Last name cannot be blank."
                }).open();
              }',
                  'success' => 'js:function(event){
                 removeSelectedGP();
                 addGpItem("selected_gp_wrapper",event);
                 $("#gpdialog").closest(".ui-dialog-content").dialog("close");
              }',
                  'complete' => 'js:function(){
                  $("#gp_form")[0].reset();
            }',
              )
          );
      }
      ?>
  </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->