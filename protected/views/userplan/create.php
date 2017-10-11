<?php
/* @var $this UserplanController */
/* @var $model Userplan */

$this->breadcrumbs=array(
	'Userplans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userplan', 'url'=>array('index')),
	array('label'=>'Manage Userplan', 'url'=>array('admin')),
);
?>

<h1>Create Userplan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>