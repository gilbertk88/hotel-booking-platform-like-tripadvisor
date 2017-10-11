<?php
/* @var $this UserplanController */
/* @var $data Userplan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planId')); ?>:</b>
	<?php echo CHtml::encode($data->planId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiryDate')); ?>:</b>
	<?php echo CHtml::encode($data->expiryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateActivated')); ?>:</b>
	<?php echo CHtml::encode($data->dateActivated); ?>
	<br />


</div>