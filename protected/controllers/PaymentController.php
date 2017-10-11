<?php

class PaymentController extends Controller
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
			/*'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request*/
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Payment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payment']))
		{
			$model->attributes=$_POST['Payment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->userid=Yii::app()->user->id;
		$this->planid=$planid;
		$this->amount=$amount;
		$this->date=data('Y-m-d');
		$this->status='0';
		if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		
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

		if(isset($_POST['Payment']))
		{
			$model->attributes=$_POST['Payment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionCallback($id)
	{
		$model=$this->loadModel($id);
if(isset($_GET['pesapal_transaction_tracking_id'])){
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	require_once(Yii::app()->basePath . '/views/payment/OAuth.php');
	$consumer_key="onpM4VFAaAG2sSo0rmsOTydM9p85Dgm7";//Register a merchant account on
                   //demo.pesapal.com and use the merchant key for testing.
                   //When you are ready to go live make sure you change the key to the live account
                   //registered on www.pesapal.com!
	$consumer_secret="OnlQymY1+sKPliIJHPCAa+eE+/o=";// Use the secret from your test
                   //account on demo.pesapal.com. When you are ready to go live make sure you 
                   //change the secret to the live account registered on www.pesapal.com!
	$statusrequestAPI = 'https://www.pesapal.com/api/querypaymentstatus';//change to      
					   //https://www.pesapal.com/api/querypaymentstatus' when you are ready to go live!

	// Parameters sent to you by PesaPal IPN
	$pesapalNotification=$_GET['pesapal_notification_type'];
	$pesapalTrackingId=$_GET['pesapal_transaction_tracking_id'];
	$pesapal_merchant_reference=$_GET['pesapal_merchant_reference'];
	$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

	if($pesapalNotification=="CHANGE" && $pesapalTrackingId!='')
	{
	   $token = $params = NULL;
	   $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

	   //get transaction status
	   $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
	   $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);
	   $request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);
	   $request_status->sign_request($signature_method, $consumer, $token);

	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $request_status);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($ch, CURLOPT_HEADER, 1);
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	   if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')
	   {
		  $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
		  curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
		  curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
		  curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
	   }

	   $response = curl_exec($ch);

	   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	   $raw_header  = substr($response, 0, $header_size - 4);
	   $headerArray = explode("\r\n\r\n", $raw_header);
	   $header      = $headerArray[count($headerArray) - 1];

	   //transaction status
	   $elements = preg_split("/=/",substr($response, $header_size));
	   $status = $elements[1];
	   
	   $model->status='1';

	   curl_close ($ch);
	   
	   //UPDATE YOUR DB TABLE WITH NEW STATUS FOR TRANSACTION WITH pesapal_transaction_tracking_id $pesapalTrackingId
	   if($model->save())
	   {
		  $resp="pesapal_notification_type=$pesapalNotification&pesapal_transaction_tracking_id=$pesapalTrackingId&pesapal_merchant_reference=$pesapal_merchant_reference";
		  ob_start();
		  echo $resp;
		  ob_flush();
		  $this->redirect(array('plans/view','id'=>$model->id));
	   }
	}
}

		$this->redirect(array('plans/index'));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPesapal($id,$amount)
	{
		$model=new Payment;
		
		//$model->loadModel();
		$_POST['Payment']['userid']=Yii::app()->user->id;
		$_POST['Payment']['planid']=$id;
		$_POST['Payment']['amount']=$amount;
		$_POST['Payment']['date']=date('Y-m-d');
		$_POST['Payment']['status']='0';
		
		//$_POST['Payment']=$pesapal;
		$model->attributes=$_POST['Payment'];
		
		if ($model->save())	
		{
			$dataProvider['desc'] = 'no description'; //$_POST['description'];
			$dataProvider['type'] = 'MERCHANT'; //$_POST['type']; //default value = MERCHANT
			$dataProvider['reference'] =1 ;// $_POST['reference'];//unique order id of the transaction, generated by merchant
			$dataProvider['first_name'] = 'gilbert'; //$_POST['first_name'];
			$dataProvider['last_name'] = 'kabui'; //$_POST['last_name'];
			$dataProvider['email'] = 'gilbertkarogo@gmail.com'; //$_POST['email'];
			$dataProvider['phonenumber'] ='07248484763';
			$this->render('pesapal',array(
	'dataProvider'=>$dataProvider,));
	}
		else
			$this->redirect(array('plans/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Payment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Payment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payment']))
			$model->attributes=$_GET['Payment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Payment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Payment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
