<?php

class ApartmentsWidget extends CWidget {
	public $usePagination = 1;
	public $criteria = null;
	public $count = null;
	public $widgetTitle = null;

	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.apartments.views');
	}

	public function run() {
		Yii::import('application.modules.apartments.helpers.apartmentsHelper');
		$result = apartmentsHelper::getApartments(param('countListitng'.User::getModeListShow(), 10), $this->usePagination, 0, $this->criteria);

		if($this->count){
			$result['count'] = $this->count;
		}
		else {
			$result['count'] = $result['apCount'];
		}

		$this->render('widgetApartments_list', $result);
	}
}