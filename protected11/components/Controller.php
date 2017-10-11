<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

	public $layout = '//layouts/index';
	public $infoPages = array();
	public $menuTitle;
	public $menu = array();
	public $breadcrumbs = array();
	public $pageKeywords;
	public $pageDescription;
	public $adminTitle = '';
	public $aData;
	public $modelName;

	public $seoTitle;
	public $seoDescription;
	public $seoKeywords;

	/* advertising */
	public $advertPos1 = array();
	public $advertPos2 = array();
	public $advertPos3 = array();
	public $advertPos4 = array();
	public $advertPos5 = array();
	public $advertPos6 = array();

	public $apInComparison = array();
	public $assetsGenPath;
	public $assetsGenUrl;

    protected function beforeAction($action) {
		//echo Yii::app()->request->csrfToken;
		Yii::app()->clientScript->registerScript('ajax-csrf', '
			$.ajaxPrefilter(function(options, originalOptions, jqXHR){
				if(originalOptions.type){
					var type = originalOptions.type.toLowerCase();
				} else {
					var type = "";
				}

				if(type == "post" && typeof originalOptions.data === "object"){
					options.data = $.extend(originalOptions.data, { "'.Yii::app()->request->csrfTokenName.'": "'.Yii::app()->request->csrfToken.'" });
					options.data = $.param(options.data);
				}
			});
		', CClientScript::POS_END, array());

		if (!Yii::app()->user->getState('isAdmin')) {
			$currentController = Yii::app()->controller->id;
			$currentAction = Yii::app()->controller->action->id;

			if (!($currentController == 'site' && ($currentAction == 'login' || $currentAction == 'logout'))) {
				if (issetModule('service')){
					$serviceInfo = Service::model()->findByPk(Service::SERVICE_ID);
					if ($serviceInfo && $serviceInfo->is_offline == 1) {
						$allowIps = explode(',', $serviceInfo->allow_ip);
						$allowIps = array_map("trim", $allowIps);

						if (!in_array(Yii::app()->request->userHostAddress, $allowIps)) {
							$this->renderPartial('//../modules/service/views/index', array('page' => $serviceInfo->page), false, true);
							Yii::app()->end();
						}
					}
				}
			}
		}

		/* start  get page banners */
		if (issetModule('advertising') && !param('useBootstrap')) {
			$advert = new Advert;
			$advert->getAdvertContent();
		}
		/* end  get page banners */

		return parent::beforeAction($action);
	}

	function init() {

		if (!file_exists(ALREADY_INSTALL_FILE) && !(Yii::app()->controller->module && Yii::app()->controller->module->id == 'install')) {
			$this->redirect(array('/install'));
		}

		setLang();

		$this->assetsGenPath = Yii::getPathOfAlias('webroot.assets');
		$this->assetsGenUrl = Yii::app()->getBaseUrl(true).'/assets/';

		Yii::app()->user->setState('menu_active', '');

		if (isFree()) {
			$this->pageTitle = param('siteTitle');
			$this->pageKeywords = param('siteKeywords');
			$this->pageDescription = param('siteDescription');
		}
		else {
			if(issetModule('seo')){
				$this->pageTitle = Seo::getSeoValue('siteName');
				$this->pageKeywords = Seo::getSeoValue('siteKeywords');
				$this->pageDescription = Seo::getSeoValue('siteDescription');
			}
			else {
				$this->pageTitle = tt('siteName', 'seo');
				$this->pageKeywords = tt('siteKeywords', 'seo');
				$this->pageDescription = tt('siteDescription', 'seo');
			}
		}

		Yii::app()->name = $this->pageTitle;

		if(Yii::app()->getModule('menumanager')){
			if(!(Yii::app()->controller->module && Yii::app()->controller->module->id == 'install')){
				$this->infoPages = Menu::getMenuItems();
			}
		}

		$subItems = array();

		if(!Yii::app()->user->isGuest && !Yii::app()->user->getState('isAdmin')){
			if(param('useUserads')){
				$subItems = array(
					array(
						'label' => tt('Manage apartments', 'apartments'),
						'url' => array('/userads/main/index'),
					),
				);
			}

			if(issetModule('payment')){
				$subItems[] = array(
					'label' => tc('MODULE of Payments & Payment systems '),
					'url' => array('/usercpanel/main/payments'),
				);
				$subItems[] = array(
					'label' => tc('Add funds to account'),
					'url' => Yii::app()->createUrl('/paidservices/main/index', array('paid_id' => PaidServices::ID_ADD_FUNDS)),
				);
			}
			if(issetModule('comparisonList')){
				$subItems[] = array(
					'label' => tt('Comparison list', 'comparisonList'),
					'url' => array('/comparisonList/main/index'),
				);
			}
		}

        $urlAddAd = (Yii::app()->user->isGuest && issetModule('guestad')) ? array('/guestad/main/create') : array('/userads/main/create');

		$this->aData['userCpanelItems'] = array(
			array(
				'label' => tt('Add ad', 'common'),
				'url' => $urlAddAd,
				'visible' => param('useUserads', 0) == 1
			),
			array(
				'label' => '|',
				'visible' => param('useUserads', 0) == 1
			),
			array('label' => tt('Contact us', 'common'), 'url' => array('/contactform/main/index')),
			array('label' => '|'),
			array(
				'label' => tt('Reserve apartment', 'common'),
				'url' => array('/booking/main/mainform'),
				'visible' => Yii::app()->user->getState('isAdmin') === null,
				'linkOptions' => array('class' => 'fancy'),
			),
			array('label' => '|', 'visible' => Yii::app()->user->getState('isAdmin') === null),
			array(
				'label' => Yii::t('common', 'Control panel'),
				'url' => array('/usercpanel/main/index'),
				'visible' => Yii::app()->user->getState('isAdmin') === null,
				'items' => $subItems,
				'submenuOptions'=>array(
					'class'=>'sub_menu_dropdown'
				),
			),
			array('label' => '|', 'visible' => Yii::app()->user->getState('isAdmin') === null && !Yii::app()->user->isGuest),
			array('label' => tt('Logout', 'common'), 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
		);

		$this->aData['topMenuItems'] = $this->infoPages;

		// comparison list
		if (issetModule('comparisonList')) {
			if (!Yii::app()->user->isGuest) {
				$resultCompare = ComparisonList::model()->findAllByAttributes(
					array(
						'user_id' => Yii::app()->user->id,
					)
				);
			}
			else {
				$resultCompare = ComparisonList::model()->findAllByAttributes(
					array(
						'session_id' => Yii::app()->session->sessionId,
					)
				);
			}

			if ($resultCompare) {
				foreach($resultCompare as $item) {
					$this->apInComparison[] = $item->apartment_id;
				}
			}
		}

		parent::init();
	}

	public static function disableProfiler() {
		if (Yii::app()->getComponent('log')) {
			foreach (Yii::app()->getComponent('log')->routes as $route) {
				if (in_array(get_class($route), array('CProfileLogRoute', 'CWebLogRoute', 'YiiDebugToolbarRoute'))) {
					$route->enabled = false;
				}
			}
		}
	}

	public function createLangUrl($lang='en', $params = array()){
		$langs = Lang::getActiveLangs();

		if(count($langs) > 1 && issetModule('seo') && isset(SeoFriendlyUrl::$seoLangUrls[$lang])){
			if (count($params))
				return SeoFriendlyUrl::$seoLangUrls[$lang].'?'.http_build_query($params);

			return SeoFriendlyUrl::$seoLangUrls[$lang];
		}

		$route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
		$params = array_merge($_GET, $params);
		$params['lang'] = $lang;
		return $this->createUrl('/'.$route, $params);
	}

	public function excludeJs(){
		//Yii::app()->clientscript->scriptMap['*.js'] = false;
		Yii::app()->clientscript->scriptMap['jquery.js'] = false;
		Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
		Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
		Yii::app()->clientscript->scriptMap['bootstrap.min.js'] = false;
	}

	public static function getCurrentRoute(){
		$moduleId = isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id.'/' : '';
		return trim($moduleId.Yii::app()->controller->getId().'/'.Yii::app()->controller->getAction()->getId());
	}

	protected function afterRender($view, &$output) {
		eval(base64_decode('ZXZhbChiYXNlNjRfZGVjb2RlKCdhV1lnS0dselJuSmxaU2dwS1NCN0Nna2tkWEpzSUQwZ0oyaDBkSEE2THk5dGIyNXZjbUY1TG01bGRDOXdjbTlrZFdOMGN5ODJMVzl3Wlc0dGNtVmhiQzFsYzNSaGRHVW5Pd29KSkhSbGVIUWdQU0FuVUc5M1pYSmxaQ0JpZVNjN0NnbHBaaUFvV1dscE9qcGhjSEFvS1MwK2JHRnVaM1ZoWjJVZ1BUMGdKM0oxSnlCOGZDQlphV2s2T21Gd2NDZ3BMVDVzWVc1bmRXRm5aU0E5UFNBbmRXc25LU0I3Q2drSkpIVnliQ0E5SUNkb2RIUndPaTh2Ylc5dWIzSmhlUzV5ZFM5d2NtOWtkV04wY3k4MkxXOXdaVzR0Y21WaGJDMWxjM1JoZEdVbk93b0pDU1IwWlhoMElEMGdKOUNnMExEUXNkQyswWUxRc05DMTBZSWcwTDNRc0NjN0NnbDlDZ29KY0hKbFoxOXRZWFJqYUY5aGJHd2dLQ2NqUEhBZ1kyeGhjM005SW5Oc2IyZGhiaUkrS0M0cUtUd3ZjRDRqYVhOVkp5d2dKRzkxZEhCMWRDd2dKRzFoZEdOb1pYTWdLVHNLQ1dsbUlDZ2dhWE56WlhRb0lDUnRZWFJqYUdWeld6RmRXekJkSUNrZ0ppWWdJV1Z0Y0hSNUtDQWtiV0YwWTJobGMxc3hYVnN3WFNBcElDa2dld29KQ1NScGJuTmxjblE5Snp4d0lITjBlV3hsUFNKMFpYaDBMV0ZzYVdkdU9pQmpaVzUwWlhJN0lHMWhjbWRwYmpvZ01Ec2djR0ZrWkdsdVp6b2dNRHNpUGljdUpIUmxlSFF1SnlBOFlTQm9jbVZtUFNJbkxpUjFjbXd1SnlJZ2RHRnlaMlYwUFNKZllteGhibXNpUGs5d1pXNGdVbVZoYkNCRmMzUmhkR1U4TDJFK1BDOXdQaWM3Q2drSkpHOTFkSEIxZEQxemRISmZjbVZ3YkdGalpTZ2tiV0YwWTJobGMxc3dYVnN3WFN3Z0pHMWhkR05vWlhOYk1GMWJNRjB1SkdsdWMyVnlkQ3dnSkc5MWRIQjFkQ2s3Q2dsOUNnbGxiSE5sSUhzS0NRa2thVzV6WlhKMFBTYzhaR2wySUdOc1lYTnpQU0ptYjI5MFpYSWlQanh3SUhOMGVXeGxQU0owWlhoMExXRnNhV2R1T2lCalpXNTBaWEk3SUcxaGNtZHBiam9nTURzZ2NHRmtaR2x1WnpvZ01Ec2lQaWN1SkhSbGVIUXVKeUE4WVNCb2NtVm1QU0luTGlSMWNtd3VKeUlnZEdGeVoyVjBQU0pmWW14aGJtc2lQazl3Wlc0Z1VtVmhiQ0JGYzNSaGRHVThMMkUrUEM5d1Bqd3ZjRDQ4TDJScGRqNG5Pd29KQ1NSdmRYUndkWFE5YzNSeVgzSmxjR3hoWTJVb0p6eGthWFlnYVdROUlteHZZV1JwYm1jaUp5d2dKR2x1YzJWeWRDNG5QR1JwZGlCcFpEMGliRzloWkdsdVp5SW5MQ0FrYjNWMGNIVjBLVHNLQ1gwS0NYVnVjMlYwS0NSMWNtd3BPd29KZFc1elpYUW9KSFJsZUhRcE93b0pkVzV6WlhRb0pHMWhkR05vWlhNcE93b0pkVzV6WlhRb0pHbHVjMlZ5ZENrN0NuMD0nKSk7'));
	}

	public function setSeo(SeoFriendlyUrl $seo){
		$this->seoTitle = $seo->getStrByLang('title');
		$this->seoDescription = $seo->getStrByLang('description');
		$this->seoKeywords = $seo->getStrByLang('keywords');
	}

	public function actionDeleteVideo($id = null, $apId = null) {
		if (Yii::app()->user->isGuest)
			throw404();

		if (!$id && !$apId)
			throw404();

		if (Yii::app()->user->getState('isAdmin')) {
			$modelVideo = ApartmentVideo::model()->findByPk($id);
			$modelVideo->delete();

			$this->redirect(array('/apartments/backend/main/update', 'id' => $apId));
		}
		else {
			$modelApartment = Apartment::model()->findByPk($apId);
			if($modelApartment->owner_id != Yii::app()->user->id){
				throw404();
			}

			$modelVideo = ApartmentVideo::model()->findByPk($id);
			$modelVideo->delete();

			$this->redirect(array('/userads/main/update', 'id' => $apId));
		}
	}
	public function actionDeletePanorama($id = null, $apId = null) {
		if (Yii::app()->user->isGuest)
			throw404();

		if (!$id && !$apId)
			throw404();

		if (Yii::app()->user->getState('isAdmin')) {
			$modelPanorama = ApartmentPanorama::model()->findByPk($id);
			$modelPanorama->delete();

			$this->redirect(array('/apartments/backend/main/update', 'id' => $apId));
		}
		else {
			$modelApartment = Apartment::model()->findByPk($apId);
			if($modelApartment->owner_id != Yii::app()->user->id){
				throw404();
			}

			$modelPanorama = ApartmentPanorama::model()->findByPk($id);
			$modelPanorama->delete();

			$this->redirect(array('/userads/main/update', 'id' => $apId));
		}
	}
}