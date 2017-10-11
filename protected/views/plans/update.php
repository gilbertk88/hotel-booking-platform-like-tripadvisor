<?php
/* @var $this PlansController */
/* @var $model Plans */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plans', 'url'=>array('index')),
	array('label'=>'Create Plans', 'url'=>array('create')),
	array('label'=>'View Plans', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Plans', 'url'=>array('admin')),
);
?>

<h1>Update Plans <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>