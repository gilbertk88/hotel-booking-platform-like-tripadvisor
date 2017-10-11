<?php
$this->pageTitle .= ' - '.'Get a Free Quote';

Yii::import('application.modules.contactform.components.*');
$this->widget('ContactquoteWidget', array('page' => 'contactform'));
