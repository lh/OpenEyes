<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2017
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2017, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */
?>

<?php
$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
    'doodleToolBarArray' => array(
        array('PalpebralConjunctivitis', 'STFB'),
    ),
    'onReadyCommandArray' => array(
        array('addDoodle', array('TarsalPlates')),
        array('deselectDoodles', array()),
    ),
    'listenerArray' => array('medicalLidsListener'),
    'idSuffix' => $side.'_'.$element->elementType->id,
    'side' => ($side == 'right') ? 'R' : 'L',
    'mode' => 'edit',
    'model' => $element,
    'attribute' => $side.'_eyedraw',
    'template' => 'OEEyeDrawWidget_InlineToolbar',
    'maxToolbarButtons' => 7,
    'autoReport' => CHtml::modelName($element) . '_'.$side.'_ed_report',
    //'autoReportEditable' => false,
    'fields' => $this->renderPartial($element->form_view.'_OEEyeDraw_fields', array(
        'form' => $form,
        'side' => $side,
        'element' => $element,
    ), true),
));
?>

<?php Yii::app()->clientScript->registerScriptFile("{$this->assetPath}/js/MedicalLids.js", CClientScript::POS_HEAD); ?>

