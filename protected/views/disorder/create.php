<?php
/* @var DisorderController $this */
/* @var Practice $model */
$this->pageTitle = 'Create Disorder';
?>
<h1 class="badge">Disorder</h1>
<div class="box content admin-content">
  <div class="large-10 column content admin large-centered">
    <div class="box admin">
      <h1 class="text-center">Create Disorder</h1>
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
  </div>
</div>
