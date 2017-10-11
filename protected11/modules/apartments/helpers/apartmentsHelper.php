<?php

class apartmentsHelper {
	public static function getApartments($limit = 10, $usePagination = 1, $all = 1, $criteria = null){
		$pages = array();

		Yii::app()->getModule('apartments');

		if($criteria === null){
			$criteria = new CDbCriteria;
		}
		if(!$all){
			$criteria->addCondition('active = '.Apartment::STATUS_ACTIVE);
			if (param('useUserads'))
				$criteria->addCondition('owner_active = '.Apartment::STATUS_ACTIVE);
		}

		$sort = new CSort('Apartment');
		$sort->attributes = array(
			'price' => 'price',
			'date_created' => 'date_created',
		);
		if(!$criteria->order){
			$sort->defaultOrder = 't.date_up_search DESC, t.sorter DESC';
		}
		$sort->applyOrder($criteria);

		$sorterLinks = self::getSorterLinks($sort);
		$criteria->addCondition('t.owner_id = 1 OR t.owner_active = 1');

		$criteria->addInCondition('type', Apartment::availableApTypesIds());

		if($usePagination){
			$pages = new CPagination(Apartment::model()->count($criteria));
			$pages->pageSize = $limit;
			$pages->applyLimit($criteria);
		}
		else{
			$criteria->limit = $limit;
		}

		// find count
		$apCount = Apartment::model()->count($criteria);

//		$apartments = Apartment::model()
//			->cache(param('cachingTime', 1209600), Apartment::getImagesDependency())
//			->with(array('images'))
//			->findAll($criteria);
		return array(
			'pages' => $pages,
			//'apartments' => $apartments,
			'sorterLinks' => $sorterLinks,
			'apCount' => $apCount,
			'criteria' => $criteria
		);
	}

	public static function getSorterLinks($sort){
        $HtmlOption = array('onClick'=>'reloadApartmentList(this.href); return false;');
		$return = array(
			$sort->link('price', tt('Sorting by price', 'quicksearch'), $HtmlOption),
			$sort->link('date_created', tt('Sorting by date created', 'quicksearch'), $HtmlOption),
		);
		return $return;
	}
}
