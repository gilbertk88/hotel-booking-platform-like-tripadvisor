<?php
/* @var $this PlansController */
/* @var $model Plans */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Plans', 'url'=>array('index')),
	array('label'=>'Create Plans', 'url'=>array('create')),
	array('label'=>'Update Plans', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Plans', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plans', 'url'=>array('admin')),
);
?>

<h1>View Plans #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		
	),
)); ?>
