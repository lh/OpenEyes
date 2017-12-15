<?php
/* @var DisorderController $this */
/* @var CActiveDataProvider $dataProvider */
/* @var string $search_term */
$this->pageTitle = 'Disorders';

$dataProvided = $dataProvider->getData();
$items_per_page = $dataProvider->getPagination()->getPageSize();
$page_num = $dataProvider->getPagination()->getCurrentPage();
$from = ($page_num * $items_per_page) + 1;
$to = min(($page_num + 1) * $items_per_page, $dataProvider->totalItemCount);
?>

<h1 class="badge">Disorders</h1>

<div class="row data-row">
  <div class="large-8 column">
    <div class="box generic">
      <div class="row">
        <div class="large-6 column">
          <h2>
            Disorders: viewing <?php echo $from ?> - <?php echo $to ?>
            of <?php echo $dataProvider->totalItemCount ?>
          </h2>
        </div>
        <div class="large-4 column">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'disorder-search-form',
                'method' => 'get',
                'action' => Yii::app()->createUrl('/disorder'),
            )); ?>
            <?php echo CHtml::textField('search_term', $search_term,
                array('placeholder' => 'Enter search query...')); ?>
            <?php $this->endWidget(); ?>
        </div>
      </div>

      <table id="disorder-grid" class="grid">
        <thead>
        <tr>
          <th>Term</th>
          <th>Specialty</th>
        </tr>
        </thead>
        <tbody>
        <?php /* @var Disorder $disorder */
        foreach ($dataProvided as $disorder): ?>
          <tr id="r<?php echo $disorder->id; ?>" class="clickable">
            <td><?php echo CHtml::encode($disorder->term); ?></td>
            <td><?php echo CHtml::encode($disorder->specialty ? $disorder->specialty->name : 'Systemic'); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot class="pagination-container">
        <tr>
          <td colspan="7">
              <?php
              $this->widget('LinkPager', array(
                  'pages' => $dataProvider->getPagination(),
                  'maxButtonCount' => 15,
                  'cssFile' => false,
                  'selectedPageCssClass' => 'current',
                  'hiddenPageCssClass' => 'unavailable',
                  'htmlOptions' => array(
                      'class' => 'pagination',
                  ),
              ));
              ?>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>
    <?php if (Yii::app()->user->checkAccess('TaskManageDisorder')): ?>
      <div class="large-4 column end">
        <div class="row">
          <div class="large-12 column end">
            <div class="box generic">
              <p><?php echo CHtml::link('Create a new Disorder', $this->createUrl('create')); ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
</div>


<script type="text/javascript">
  $('#disorder-grid tr.clickable').click(function () {
    window.location.href = '<?php echo Yii::app()->controller->createUrl('view')?>/' + $(this).attr('id').match(/[0-9]+/);
    return false;
  });
</script>

