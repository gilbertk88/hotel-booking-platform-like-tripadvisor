<?php


class BeginRequest {

	const TIME_UPDATE = 86400;

	public static function updateStatusAd() {
		if (Yii::app()->request->getIsAjaxRequest() || !issetModule('paidservices')) {
			return false;
		}

		if (!file_exists(ALREADY_INSTALL_FILE)) {
			return false;
		}

		$data = Yii::app()->statePersister->load();

		// ÐžÐ±Ð½Ð¾Ð²Ð»Ñ�ÐµÐ¼ Ñ�Ñ‚Ð°Ñ‚ÑƒÑ�Ñ‹ 1 Ñ€Ð°Ð· Ð² Ñ�ÑƒÑ‚ÐºÐ¸
		if (isset($data['next_check_status'])) {
			if ($data['next_check_status'] < time()) {
				$data['next_check_status'] = time() + self::TIME_UPDATE;
				Yii::app()->statePersister->save($data);

				self::checkStatusAd();

				// Ð¾Ð±Ð½Ð¾Ð²Ð»Ñ�ÐµÐ¼ ÐºÑƒÑ€Ñ�Ñ‹ Ð²Ð°Ð»ÑŽÑ‚
				Currency::model()->parseCbr();
			}
		} else {
			$data['next_check_status'] = time() + self::TIME_UPDATE;
			Yii::app()->statePersister->save($data);

			self::checkStatusAd();
		}
	}

	public static function checkStatusAd() {
		$activePaids = ApartmentPaid::model()->findAll('date_end <= NOW() AND status=' . ApartmentPaid::STATUS_ACTIVE);

		foreach ($activePaids as $paid) {
			$paid->status = ApartmentPaid::STATUS_NO_ACTIVE;

			if ($paid->paid_id == PaidServices::ID_SPECIAL_OFFER || $paid->paid_id == PaidServices::ID_UP_IN_SEARCH) {
				$apartment = Apartment::model()->findByPk($paid->apartment_id);

				if ($apartment) {
					$apartment->scenario = 'update_status';

					if ($paid->paid_id == PaidServices::ID_SPECIAL_OFFER) {
						$apartment->is_special_offer = 0;
						$apartment->update(array('is_special_offer'));
					}

					if ($paid->paid_id == PaidServices::ID_UP_IN_SEARCH) {
						$apartment->date_up_search = new CDbExpression('NULL');
						$apartment->update(array('date_up_search'));
					}
				}
			}

			if (!$paid->update(array('status'))) {
				//deb($paid->getErrors());
			}
		}

        $adEndActivity = Apartment::model()->with('user')->findAll('t.date_end_activity <= NOW() AND t.activity_always != 1 AND (t.active=:status OR t.owner_active=:status)', array(':status' => Apartment::STATUS_ACTIVE));
        foreach($adEndActivity as $ad){
            $ad->scenario = 'update_status';
            if(isset($ad->user) && $ad->user->isAdmin == 1){
                $ad->active = Apartment::STATUS_INACTIVE;
            } else {
                $ad->active = Apartment::STATUS_INACTIVE;
                $ad->owner_active = Apartment::STATUS_INACTIVE;
            }
            $ad->save(false);
        }
	}
}