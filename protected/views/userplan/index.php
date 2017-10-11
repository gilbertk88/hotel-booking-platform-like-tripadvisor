<?php
/* @var $this UserplanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userplans',
);

$this->menu=array(
	array('label'=>'Create Userplan', 'url'=>array('create')),
	array('label'=>'Manage Userplan', 'url'=>array('admin')),
);
?>

<h1>Userplans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
