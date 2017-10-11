<?php

class PlansController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout= '//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view'),
				'users'=>array('admin'),
			),
			array('allow',  //allow authenticated users to access index
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  //allow authenticated users to access index
				'actions'=>array('index','admin','delete','create','update','view'),
				'users'=>array('*'),
				'message'=>'UPS!! You do have access to this page. Talk to the admin to resolve this',
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->modelName = 'Apartment';
		$model = new $this->modelName;
		
		//$this->loadModel($id);
		$this->render('view',array('model'=>$model ,));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Plans;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Plans']))
		{
			$model->attributes=$_POST['Plans'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	 * handle payment a new model.
	 * the browser will be redirected to the 'payment/create' page.
	 */
	public function actionPay($id)
	{
		$model=$this->loadModel($id);
		
		//$model = new payment;
		$this->redirect(array('payment/pesapal/index/id/'.$model->id.'/amount/'.$model->amount));
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Plans']))
		{
			$model->attributes=$_POST['Plans'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Plans');
		$dataId=Yii::app()->user->id;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'dataId'=>$dataId,
			
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Plans('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Plans']))
			$model->attributes=$_GET['Plans'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Plans the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Plans::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Plans $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plans-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
