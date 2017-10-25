<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
?>
<?php
$form->layoutColumns = array(
    'label' => 3,
    'field' => 9,
);
?>

<div class="alert-box alert">
<p class="note"> Please fill in one of these field groups
<ul>
  <li>Then Question and the Response Type Id</li>
    <b>OR</b>
  <li>The Outcome Id</li>
</ul>
</p>
</div>
<div class="row field-row">
  <div class="large-<?php echo $form->layoutColumns['label']; ?> column">
      <?php echo $form->labelEx($model, 'question'); ?>
  </div>
  <div class="large-<?php echo $form->layoutColumns['field']; ?> column end">
      <?php echo $form->textField($model, 'question',
          array('autocomplete' => Yii::app()->params['html_autocomplete'], 'maxlength' => 256,'nolabel' => true)); ?>
  </div>
</div>
<div class="row field-row">
  <div class="large-<?php echo $form->layoutColumns['label']; ?> column">
      <?php echo $form->labelEx($model, 'outcome_id'); ?>
  </div>
  <div class="large-<?php echo $form->layoutColumns['field']; ?> column end">
      <?php echo $form->dropdownlist($model, 'outcome_id', 'OphCoTherapyapplication_DecisionTreeOutcome',
          array('empty' => '- Please select -', 'nolabel' => true)); ?>
  </div>
</div>

<div class="row field-row">
  <div class="large-<?php echo $form->layoutColumns['label']; ?> column">
      <?php echo $form->labelEx($model, 'default_function'); ?>
  </div>
  <div class="large-<?php echo $form->layoutColumns['field']; ?> column end">
      <?php
      $func_list = array();
      foreach ($model->getDefaultFunctions() as $func) {
          $func_list[$func] = $func;
      }
      echo $form->dropdownlist($model, 'default_function', $func_list,
          array('empty' => '- Please select -', 'nolabel' => true)); ?>
  </div>
</div>

<div class="row field-row">
	<div class="large-<?php echo $form->layoutColumns['label'];?> column">
		<?php echo $form->labelEx($model, 'default_value'); ?>
	</div>
	<div class="large-<?php echo $form->layoutColumns['field'];?> column end">
		<?php
            if ($model->response_type && $model->response_type->datatype == 'bool') {
                $this->renderPartial('template_OphCoTherapyapplication_DecisionTreeNode_default_value_bool',
                        array('name' => get_class($model).'[default_value]',
                                'id' => get_class($model).'_default_value',
                                'val' => $model->default_value,
                        ));
            } else {
                $this->renderPartial('template_OphCoTherapyapplication_DecisionTreeNode_default_value_default',
                        array('name' => get_class($model).'[default_value]',
                        'id' => get_class($model).'_default_value',
                        'val' => $model->default_value,
                ));
            }
        ?>
	</div>
</div>

<div class="row field-row">
  <div class="large-<?php echo $form->layoutColumns['label'];?> column">
    <?php echo $form->labelEx($model, 'response_type_id'); ?>
  </div>
  <div class="large-<?php echo $form->layoutColumns['field'];?> column end">
  <?php
$html_options = array(
    'options' => array(),
    'empty' => '- Please select -',
    'nolabel' => true,
);
foreach (OphCoTherapyapplication_DecisionTreeNode_ResponseType::model()->findAll() as $rt) {
    $html_options['options'][(string) $rt->id] = array('data-datatype' => $rt->datatype);
}
echo $form->dropdownlist($model, 'response_type_id', CHtml::listData(OphCoTherapyapplication_DecisionTreeNode_ResponseType::model()->findAll(), 'id', 'label'), $html_options); ?>
  </div>
</div>
<script id="template_default_value_default" type="text/html">
	<?php
        $this->renderPartial('template_OphCoTherapyapplication_DecisionTreeNode_default_value_default',
            array(
                'name' => '{{name}}',
                'id' => '{{id}}',
                'val' => null,
            )
        );
    ?>
</script>
<script id="template_default_value_bool" type="text/html">
	<?php
        $this->renderPartial('template_OphCoTherapyapplication_DecisionTreeNode_default_value_bool',
            array(
                'name' => '{{name}}',
                'id' => '{{id}}',
                'val' => null,
            )
        );
    ?>
</script>
