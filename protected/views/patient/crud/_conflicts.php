<?php
/**
 * @var $patients Patient[]
 */
?>

<div id="conflicts" class="large-4 column end">
    <div class="row field-row">
        <div class="box generic">
            <?php if (isset($patients)): ?>
                <div class="row field-row">
                    <div class="large-12 column end">
                        <p>This patient has the same date of birth as one or more patients in the system that share a
                            similar
                            name.
                            Please check the patient records below to ensure <u><?php echo $name; ?></u> isn't already
                            in the
                            system.</p>
                    </div>
                </div>
                <div class="row field-row">
                    <div class="large-12 column end">
                        <table>
                            <thead>
                            <tr>
                                <th><?php echo Patient::model()->getAttributeLabel('hos_num'); ?></th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <td><?php echo CHtml::link($patient->hos_num,
                                            Yii::app()->controller->createUrl('patient/view', array('id' => $patient->id)), array('target' => '_blank')); ?></td>
                                    <td>
                                        <?php echo CHtml::link($patient->getFullName(),
                                            Yii::app()->controller->createUrl('patient/view', array('id' => $patient->id)), array('target' => '_blank')); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p>No conflicts found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
