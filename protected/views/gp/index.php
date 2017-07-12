<?php
/* @var $this GpController */
/* @var $dataProvider CActiveDataProvider */
$dataProvided = $dataProvider->getData();
$this->pageTitle = 'Practitioners';
?>

<h1 class="badge">Practitioners</h1>

<div class="row data-row">
  <div class="large-8 column">
    <div class="box generic">
      <table id="gp-grid" class="grid">
        <thead>
        <tr>
          <th>Name</th>
          <th>Telephone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvided as $gp): ?>
          <tr id="r<?php echo $gp->id; ?>" class="clickable">
            <td><?php echo $gp->getCorrespondenceName(); ?></td>
            <td><?php echo $gp->contact->primary_phone; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php if (Yii::app()->user->checkAccess('TaskCreateGp')):?>
    <div class="large-4 column end">
      <div class="row">
        <div class="large-12 column end">
          <div class="box generic">
            <p><?php echo CHtml::link('Create Practitioner', $this->createUrl('/gp/create')); ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>


<script type="text/javascript">
  $('#gp-grid tr.clickable').click(function () {
    window.location.href = '<?php echo Yii::app()->controller->createUrl('/gp/view')?>/' + $(this).attr('id').match(/[0-9]+/);
    return false;
  });
</script>

