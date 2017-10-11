<div class="white"><?php
/* @var $this PlansController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Plans',
);

$this->menu=array(
	array('label'=>'Create Plans', 'url'=>array('create')),
	array('label'=>'Manage Plans', 'url'=>array('admin')),
);
?>


<table>
<th><h2>Plans</h2></th>
<tr>
<td><b><?php echo 'PLAN'; ?></b> </td>
<td><b><?php echo 'No. OF LISTING'; ?></b> </td>
<td><b><?php echo 'AMOUNT'; ?></b> </td>
</tr>
<?php 


$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>
<div>