<?php
/* @var boolean $sent */
/* @var string $error_message */
?>

<div class="box reports">
  <div class="report-fields">
    <h2>Pending Therapy Applications Report</h2>
      <?php if ($sent): ?>
        <span>Report sent</span>
      <?php else: ?>
        <form>
          <button type="submit" name="report" value="generate">Generate</button>
        </form>
          <?php if ($error_message !== null): ?>
          <div class="alert-box alert with-icon">
            <p>An error occurred when sending the report: <br/>
              <strong><?php echo $error_message; ?></strong></p>
            <p>Please contact an administrator. The "Therapy Applications Alert Recipients" setting may be incorrect.</p>
          </div>
          <?php endif; ?>
      <?php endif; ?>
  </div>
</div>
