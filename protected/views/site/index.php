<!-- SLIDER -->
		<img id="cycle-loader" src="./home_files/spinner.gif" alt="loader" style="display: none;">

		<ul id="slider" class="mc-cycle" style="width: 1406px; height: ; display: block;">
			
			
			
			
			
			
		<div class="mc-image " title="" style="background-image: url(<?php echo Yii::app()->baseUrl; ?>/home_files/wildlife-168.jpg); background-color: rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; display: block; z-index: 7; width: 1366px; height: ; opacity: 1;" data-href="">
				
				<div class="caption">

					<div class="block">
						<h1><img src="/hotel/images/home.png"><h1>
					</div>

					<div class="block">
						<h2>Find the Best</h2>
					</div>

					<div class="block">
					<p>
							Tour Agents<br>
							Tour Packages<br>
							Hotels & Casinos </br>
							Zoos & Parks</br>
							
					</p>
					</div>

					<div class="block">
						<a class="btn btn-warning" href="<?php echo  Yii::app()->request->baseUrl; ?>/search" target="">SEE LISTINGS</a>
					</div>
					

				</div>
				<?php if(Yii::app()->user->isGuest) {?>
			<div id="index-register">
						<?php
						$form=$this->beginWidget('CActiveForm', array(
						'action' => Yii::app()->controller->createUrl('/site/register'),
						'id'=>'user-register-form',
						'enableAjaxValidation'=>false,
						)); ?>
						<?php echo $form->errorSummary($model); ?>
						<div class="row">
							<?php echo '<b>Let us keep you posted on the best</b> '; ?>
						</div><br>
						<div class="row">
							<?php //echo $form->labelEx($model,'username'); ?>
							<?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>128,'placeholder'=>'Your name *')); ?>
							<?php echo $form->error($model,'username'); ?>
						</div><br>

						<div class="row">
							<?php //echo $form->labelEx($model,'email'); ?>
							<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>128,'placeholder'=>'E-mail *')); ?>
							<?php echo $form->error($model,'email'); ?>
						</div><br>

						<div class="row">
							<?php //echo $form->labelEx($model,'phone'); ?>
							<?php echo $form->textField($model,'phone',array('size'=>40,'maxlength'=>15,'placeholder'=>'Phone number *')); ?>
							<?php echo $form->error($model,'phone'); ?>
						</div><br>

							
						<div class="row submit">
							<?php echo CHtml::submitButton(Yii::t('common', 'Registration')); ?>
						</div>
						
						<?php $this->endWidget(); ?>
						<div style="background:white; margin-top:10px; padding:5px;border-radius:5px;" ><?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); ?> </div>
				</div>
				<?php  } ?>
		
		</div>
		</ul>
		<!-- /SLIDER -->