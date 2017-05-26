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
    <?php echo $form->textField($model, 'className', array('size' => 65)); ?>
    <div class="tooltip">
        Parameter class name must only contain word characters.
    </div>
    <?php echo $form->error($model, 'className'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 65)); ?>
    <div class="tooltip">
        This value is displayed on-screen.
    </div>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'alias'); ?>
    <?php echo $form->textField($model, 'alias', array('size' => 65)); ?>
    <div class="tooltip">
        SQL alias prefix must only contain word characters and underscores.
    </div>
    <?php echo $form->error($model, 'alias'); ?>
</div>

<?php $this->endWidget(); ?>
