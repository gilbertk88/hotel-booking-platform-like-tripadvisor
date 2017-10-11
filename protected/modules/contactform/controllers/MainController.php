<?php


class MainController extends ModuleUserController{
	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.contactform.views');
	}

	public function actions() {
		return array(
			'captcha' => array(
				'class' => 'MathCCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	public function actionIndex(){
		$this->render('contactform');
	}
	public function actionQuote(){
		$this->render('Quoteform');
	}
}