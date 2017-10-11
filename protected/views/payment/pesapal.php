<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payments',
);

$this->menu=array(
	array('label'=>'Create Payment', 'url'=>array('create')),
	array('label'=>'Manage Payment', 'url'=>array('admin')),
);
?>

<h1>Payments</h1>

<?php $this->renderPartial('lipa');?>
