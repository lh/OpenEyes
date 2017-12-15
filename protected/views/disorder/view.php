<?php
/* @var DisorderController $this */
/* @var Disorder $model */

$this->pageTitle = 'View Disorder';
?>

<h1 class="badge">Disorder Summary</h1>
<div class="row data-row">
  <div class="large-8 column">
    <section class="box patient-info js-toggle-container">
      <h3 class="box-title">Disorder Information:</h3>
      <a href="#" class="toggle-trigger toggle-hide js-toggle">
        <span class="icon-showhide">
            Show/hide this section
        </span>
      </a>
      <div class="js-toggle-body">
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model, 'term'); ?></div>
          </div>
          <div class="large-9 column end">
            <div class="data-value">
                <?php echo CHtml::encode($model->term); ?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model, 'fully_specified_name'); ?></div>
          </div>
          <div class="large-9 column end">
            <div class="data-value">
                <?php echo CHtml::encode($model->fully_specified_name); ?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model, 'specialty_id'); ?></div>
          </div>
          <div class="large-9 column end">
            <div class="data-value">
                <?php echo CHtml::encode($model->specialty ? $model->specialty->name : 'Systemic'); ?>
            </div>
          </div>
        </div>
        <div class="row data-row">
          <div class="large-3 column">
            <div class="data-label"><?php echo CHtml::activeLabel($model, 'active'); ?></div>
          </div>
          <div class="large-9 column end">
            <div class="data-value">
                <?php echo $model->active ? 'Active' : 'Not Active' ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    <?php if (Yii::app()->user->checkAccess('TaskManageDisorder')): ?>
      <div class="large-4 column end">
        <div class="box generic">
          <div class="row">
            <div class="large-12 column end">
              <p><?php echo CHtml::link('Update Disorder Details',
                      $this->createUrl('update', array('id' => $model->id))); ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
</div>
