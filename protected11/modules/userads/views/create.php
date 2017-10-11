<h1><?php echo tt('Add apartment', 'apartments');?></h1>

<?php
$baseUrl=Yii::app()->baseUrl;
echo '<div   style="float:right;"class="btn btn-default"><a href="'.$baseUrl.'/plans/index">UPGRADE</a></div>';
$this->pageTitle .= ' - '.tt('Add apartment', 'apartments');

$this->widget('zii.widgets.CMenu', array(
	'items' => array(
		array('label'=>tt('Manage apartments', 'apartments'), 'url'=>array('index')),
	)
));

$this->renderPartial('_form',array(
	'model'=>$model,
	'supportvideoext' => $supportvideoext,
	'supportvideomaxsize' => $supportvideomaxsize,
));
