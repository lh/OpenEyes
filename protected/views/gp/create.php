<?php
/* @var $this GpController */
/* @var $model Gp */
/* @var $context String */
$this->pageTitle = 'Create Practitioner';
?>
<h1 class="badge">Practitioner</h1>
<div class="box content admin-content">
  <div class="large-10 column content admin large-centered">
    <div class="box admin">
      <h1 class="text-center">Create Practitioner</h1>
        <?php $this->renderPartial('_form', array('model' => $model, 'context' => $context)); ?>
    </div>
  </div>
</div>
