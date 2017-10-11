<?php
/* @var $this UserplanController */
/* @var $model Userplan */

$this->breadcrumbs=array(
	'Userplans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userplan', 'url'=>array('index')),
	array('label'=>'Create Userplan', 'url'=>array('create')),
	array('label'=>'View Userplan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Userplan', 'url'=>array('admin')),
);
?>

<h1>Update Userplan <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>