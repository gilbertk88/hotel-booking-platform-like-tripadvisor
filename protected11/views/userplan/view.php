<?php
/* @var $this UserplanController */
/* @var $model Userplan */

$this->breadcrumbs=array(
	'Userplans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Userplan', 'url'=>array('index')),
	array('label'=>'Create Userplan', 'url'=>array('create')),
	array('label'=>'Update Userplan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Userplan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userplan', 'url'=>array('admin')),
);
?>

<h1>View Userplan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'planId',
		'expiryDate',
		'dateActivated',
	),
)); ?>
