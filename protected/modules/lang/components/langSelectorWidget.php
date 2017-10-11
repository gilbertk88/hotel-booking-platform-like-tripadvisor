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

class langSelectorWidget extends CWidget
{
    public $type = 'dropdown';
    public $languages;

    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.modules.lang.views');
    }

    public function run()
    {
        $this->render('langSelectorFormWidget', array(
                'currentLang' => Yii::app()->language,
                'languages' => ($this->languages) ? $this->languages : Lang::getActiveLangs(true),
                'type' => $this->type
            )
        );
    }
}
?>