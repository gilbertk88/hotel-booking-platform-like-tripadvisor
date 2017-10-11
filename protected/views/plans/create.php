<?php
/* @var $this PlansController */
/* @var $model Plans */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plans', 'url'=>array('index')),
	array('label'=>'Manage Plans', 'url'=>array('admin')),
);
?>

<h1>Create Plans</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>