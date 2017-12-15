<?php
/**
 * @var $errors array
 */
?>

<div id="conflicts" class="large-4 column end">
    <div class="row field-row">
        <div class="box generic">
            <div class="row field-row">
                <div class="large-12 column end">
                    <p>Conflicts could not be found due to the following errors:</p>
                    <ul>
                        <?php foreach ($errors as $name => $attribute): ?>
                            <?php foreach ($attribute as $message): ?>
                                <li><?php echo Patient::model()->getAttributeLabel($name) . ": $message"; ?></li>
                            <?php endforeach;
                        endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
