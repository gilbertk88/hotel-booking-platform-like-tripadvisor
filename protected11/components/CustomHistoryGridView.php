<?php
/**********************************************************************************************
 *                            CMS Open Real Estate
 *                              -----------------
 *	version				:	1.7.2
 *	copyright			:	(c) 2013 karogo
 *	website				:	http://www.karogo.ru/
 *	contact us			:	http://www.karogo.ru/contact
 *
 * This file is part of CMS Open Real Estate
 *
 * Open Real Estate is free software. This work is licensed under a GNU GPL.
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Open Real Estate is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 ***********************************************************************************************/

Yii::import('ext.selgridview.BootSelGridView');

class CustomHistoryGridView extends BootSelGridView {
	//public $pager = array('class'=>'itemPaginator');
	public $template = "{summary}\n{pager}\n{items}\n{pager}";

	public $type = 'striped bordered condensed';
}