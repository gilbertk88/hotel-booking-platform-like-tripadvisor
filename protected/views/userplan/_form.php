<?php
/* @var $this UserplanController */
/* @var $model Userplan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userplan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userId'); ?>
		<?php echo $form->textField($model,'userId',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'planId'); ?>
		<?php echo $form->textField($model,'planId',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'planId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expiryDate'); ?>
		<?php echo $form->textField($model,'expiryDate'); ?>
		<?php echo $form->error($model,'expiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateActivated'); ?>
		<?php echo $form->textField($model,'dateActivated'); ?>
		<?php echo $form->error($model,'dateActivated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->