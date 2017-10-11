<?php
/* @var $this PlansController */
/* @var $data Plans */
?>


    <tr>
	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>-->
	

	<td>
	<?php echo CHtml::encode($data->name); ?>
	</td>
	<td>
	<?php echo CHtml::encode($data->numberofadverts); ?>
	</td>
	<td>
	<?php echo CHtml::encode($data->amount); ?>
	</td>
	<td>
	<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?> -->
	</td>
	<td>
	<a href='<?php echo Yii::app()->baseUrl.'/plans/pay/index/id/'.$data->id; ?> '>SELECT</a>
	</td>
	</tr>

