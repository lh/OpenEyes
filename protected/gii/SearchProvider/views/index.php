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

<?php $this->endWidget(); ?>
