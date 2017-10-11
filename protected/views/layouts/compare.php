<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo 'Safarinest';//CHtml::encode($this->seoTitle ? $this->seoTitle : $this->pageTitle); ?></title>
	<meta name="description" content="<?php echo CHtml::encode($this->seoDescription ? $this->seoDescription : $this->pageDescription); ?>" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->seoKeywords ? $this->seoKeywords : $this->pageKeywords); ?>" />

	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css', 'screen, projection'); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->
	<link media="screen, projection" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet" />

	<!--[if IE]> <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
</head>

<body>
<?php if (demo()) :?>
	<?php $this->renderPartial('//site/ads-block', array()); ?>
<?php endif; ?>

<div id="container" class="compare-main" <?php echo (demo()) ? 'style="padding-top: 40px;"' : '';?> >
	<div class="logo">
		<a title="<?php echo Yii::t('common', 'Go to main page'); ?>" href="<?php echo Yii::app()->controller->createAbsoluteUrl('/'); ?>">
			<img width="291" height="54" alt="<?php echo CHtml::encode($this->pageDescription); ?>" src="<?php echo Yii::app()->request->baseUrl; ?>/images/pages/logo-open-re.png" id="logo" />
		</a>
	</div>

	<div class="clear"></div>
	<div class="contentCompare">
		<?php echo $content; ?>
		<div class="clear"></div>
	</div>

	<div class="footer">
		<?php echo getGA(); ?>
		<p class="slogan">&copy;&nbsp;<?php echo 'tourfinder , '.date('Y'); ?></p>
		<!-- <?php echo  ' name ' ; ?> -->
	</div>
</div>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
</body>
</html>