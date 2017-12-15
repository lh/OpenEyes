<meta charset="utf-8" />
<?php
//Because the wonderful way the namespace is created means if you don't include your file in the assets template
//the namespace doesn't exist and gets overwritten.
?>
<script type="text/javascript">var OpenEyes = OpenEyes || {};</script>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="viewport" content="width=1230, user-scalable=1" />
<meta name="format-detection" content="telephone=no">

<?php if (Yii::app()->params['disable_browser_caching']) {?>
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="pragma" content="no-cache" />
<?php }?>

<link rel="icon" href="<?php echo Yii::app()->createUrl('favicon.ico')?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo Yii::app()->createUrl('favicon.ico')?>"/>

<script type="text/javascript">
	var baseUrl = '<?php echo Yii::app()->baseUrl?>';
</script>