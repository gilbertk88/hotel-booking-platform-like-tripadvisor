<?php

class ContactquoteWidget extends CWidget {
	public $page;

	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.contactform.views');
	}

	public function run() {
		Yii::import('application.modules.contactform.models.ContactForm');
		$model = new ContactForm;
		$model->scenario = 'insert';

		if(isset($_POST['ContactForm'])){
			$model->attributes=$_POST['ContactForm'];

			if(!Yii::app()->user->isGuest){
				$model->email = Yii::app()->user->email;
				$model->username = Yii::app()->user->username;
			}

			if($model->validate()){
				$notifier = new Notifier;
				$notifier->raiseEvent('onNewContactform', $model);

				Yii::app()->user->setFlash('success', tt('Thanks_for_message', 'contactform'));
				$model = new ContactForm; // clear fields
			} else {
                $model->unsetAttributes(array('verifyCode'));
				Yii::app()->user->setFlash('error', tt('Error_send', 'contactform'));
			}
		}

		$this->render('widgetquoteform', array('model' => $model));
	}
}