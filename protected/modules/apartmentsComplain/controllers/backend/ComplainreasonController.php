<?php
/**********************************************************************************************
 *                            CMS Open Real Estate
 *                              -----------------
 *	version				:	1.7.2
 *	copyright			:	(c) 2013 Monoray
 *	website				:	http://www.monoray.ru/
 *	contact us			:	http://www.monoray.ru/contact
 *
 * This file is part of CMS Open Real Estate
 *
 * Open Real Estate is free software. This work is licensed under a GNU GPL.
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Open Real Estate is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 ***********************************************************************************************/

class ComplainreasonController extends ModuleAdminController{
	public $modelName = 'ApartmentsComplainReason';
	public $redirectTo = array('admin');

	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.apartmentsComplain.views.backend.reason');
	}

	public function actionAdmin() {
		$this->getMaxSorter();
		$this->getMinSorter();

		parent::actionAdmin();
	}

	public function actionView($id) {
		$this->redirect($this->redirectTo);
	}
}
