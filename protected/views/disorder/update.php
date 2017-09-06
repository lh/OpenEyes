<?php
/* @var DisorderController $this */
/* @var Disorder $model */
$this->pageTitle = 'Update Disorder';
?>

<h1 class="badge">Disorder</h1>
<div class="box content admin-content">
  <div class="large-10 column content admin large-centered">
    <div class="box admin">
      <h1 class="text-center">Update Disorder Details</h1>
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
  </div>
</div>
