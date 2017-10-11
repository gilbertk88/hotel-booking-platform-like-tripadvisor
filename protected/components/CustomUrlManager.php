<?php
/**********************************************************************************************
 *                            CMS Open Real Estate
 *                              -----------------
 *    version                :    1.7.2
 *    copyright            :    (c) 2013 karogo
 *    website                :    http://www.karogo.ru/
 *    contact us            :    http://www.karogo.ru/contact
 *
 * This file is part of CMS Open Real Estate
 *
 * Open Real Estate is free software. This work is licensed under a GNU GPL.
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Open Real Estate is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 ***********************************************************************************************/
class CustomUrlManager extends CUrlManager {

    public function init() {
        $langs = Lang::getActiveLangs();

        $countLangs = count($langs);

        $langRoute = ($countLangs > 1 || ($countLangs == 1 && param('useLangPrefixIfOneLang'))) ? '<lang:'.implode('|',$langs).'>' : '';

        $rules = array(
            'sitemap.xml'=>'sitemap/main/viewxml',
            'yandex_export_feed.xml'=>'yandexRealty/main/viewfeed',

            'version'=>'/site/version',

            'sell'=>'quicksearch/main/mainsearch/type/2',
            'rent'=>'quicksearch/main/mainsearch/type/1',
			
			'site/uploadimage/' => 'site/uploadimage/',
			$langRoute . '/site/uploadimage/' => 'site/uploadimage/', 

			'min/serve/g/' => 'min/serve/',
			$langRoute . '/min/serve/g/' => 'min/serve/',

            '<module:\w+>/backend/<controller:\w+>/<action:\w+>'=>'<module>/backend/<controller>/<action>', // CGridView ajax

            $langRoute . '/property/<id:\d+>'=>'apartments/main/view',
            $langRoute . '/property/<url:[-a-zA-Z0-9_+\.]{1,255}>'=>'apartments/main/view',
            $langRoute . '/news'=>'news/main/index',
            $langRoute . '/news/<id:\d+>'=>'news/main/view',
            $langRoute . '/news/<url:[-a-zA-Z0-9_+\.]{1,255}>'=>'news/main/view',
            $langRoute . '/faq'=>'articles/main/index',
            $langRoute . '/faq/<id:\d+>'=>'articles/main/view',
            $langRoute . '/faq/<url:[-a-zA-Z0-9_+\.]{1,255}>'=>'articles/main/view',
            $langRoute . '/contact-us'=>'contactform/main/index',
            $langRoute . '/specialoffers'=>'specialoffers/main/index',
            $langRoute . '/sitemap'=>'sitemap/main/index',
            $langRoute . '/page/<id:\d+>'=>'menumanager/main/view',
            $langRoute . '/page/<url:[-a-zA-Z0-9_+\.]{1,255}>'=>'menumanager/main/view',
            $langRoute . '/search' => 'quicksearch/main/mainsearch',
			$langRoute . '/comparisonList' => 'comparisonList/main/index',

            $langRoute . '/rss' => 'rss/main/subscribe',
            $langRoute . '/rss/<feed:\w+>'=>'rss/main/read',

            $langRoute . '/service-<serviceId:\d+>' => 'quicksearch/main/mainsearch',

            $langRoute . '/<controller:(quicksearch|specialoffers)>/main/index' => '<controller>/main/index',
            $langRoute . '/' => 'site/index',
            $langRoute . '/<_m>/<_c>/<_a>*' => '<_m>/<_c>/<_a>',
            $langRoute . '/<_c>/<_a>*' => '<_c>/<_a>',
            $langRoute . '/<_c>' => '<_c>',

            '/property/'=>'quicksearch/main/mainsearch',
            $langRoute . '/property/'=>'quicksearch/main/mainsearch',

        );

        if($langRoute){
            $rules[$langRoute] = '';
        }

        $this->addRules($rules);

        return parent::init();
    }

    public function createUrl($route, $params = array(), $ampersand = '&') {
		if ($route != 'min/serve' && $route != 'site/uploadimage') { 
			$langs = Lang::getActiveLangs();
			$countLangs = count($langs);

			if (!isFree() && empty($params['lang']) && ($countLangs > 1 || ($countLangs == 1 && param('useLangPrefixIfOneLang')))) {
				$params['lang'] = Yii::app()->language;
			}
		}

        return parent::createUrl($route, $params, $ampersand);
    }
}