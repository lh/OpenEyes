<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 26/05/2017
 * Time: 4:21 PM
 */
?>

<?php $form = $this->beginWidget('CCodeForm', array('model' => $model)); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'className'); ?>
    <?php echo $form->textField($model, 'className', array('size' => 65, 'id' => 'class-name')); ?>
    <div class="tooltip">
        Parameter class name must only contain word characters.
    </div>
    <?php echo $form->error($model, 'className'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 65, 'id' => 'name')); ?>
    <div class="tooltip">
        This value is displayed on-screen.
    </div>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'alias'); ?>
    <?php echo $form->textField($model, 'alias', array('size' => 20, 'id' => 'alias')); ?>
    <div class="tooltip">
        SQL alias prefix must only contain word characters and underscores. This should be unique to all other parameter aliases.
    </div>
    <?php echo $form->error($model, 'alias'); ?>
</div>

  <div class="row">
      <?php echo $form->labelEx($model, 'attributeList'); ?>
      <?php echo $form->textField($model, 'attributeList', array('size' => 65)); ?>
    <div class="tooltip">
      Separate each attribute name with a comma. Attribute names must only consist of word characters.
    </div>
      <?php echo $form->error($model, 'attributeList'); ?>
  </div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('ParameterAutoComplete', '
$("#class-name").bind("keyup change", function() {
  var name = $("#name");
  var alias = $("#alias");
  if (!name.data("changed")) {
    var text = $("#class-name").val();
    var output = $("#class-name").val().charAt(0);
    var character = "";
    for (i = 1; i < text.length; i++) {
      character = text.charAt(i);
      if (character === character.toUpperCase()) {
        output = output.concat(" " + character);
      }
      else {
        output = output.concat(character);
      }
    }
    name.val(output);
  }
  if (!alias.data("changed")) {
    var text = $("#class-name").val();
    var output = $("#class-name").val().charAt(0).toLowerCase();
    var character = "";
    for (i = 1; i < text.length; i++) {
      character = text.charAt(i);
      if (character === character.toUpperCase()) {
        output = output.concat("_" + character.toLowerCase());
      }
    }
    alias.val(output);
  }
});
');
