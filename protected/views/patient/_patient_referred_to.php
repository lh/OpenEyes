<?php
/**
 * Created by PhpStorm.
 * User: Zhaolian
 * Date: 8/11/2017
 * Time: 2:43 PM
 */
?>
<section class="box patient-info js-toggle-container">
    <h3 class="box-title">Referred to:</h3>
    <a href="#" class="toggle-trigger toggle-hide js-toggle">
		<span class="icon-showhide">
			Show/hide this section
		</span>
    </a>
    <div class="js-toggle-body">
        <div class="row data-row">
            <div class="large-4 column">
                <div class="data-label">Name:</div>
            </div>
            <div class="large-8 column">
                <div class="data-value">
                    <?php echo $patientuserreferral->getUserName(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
