<form id="search-form" action="<?php echo Yii::app()->controller->createUrl('/quicksearch/main/mainsearch');?>" method="get">
    <div class="searchform-back">

        <div class="searchform-index" align="left">
            <div class="index-header-form" id="search_form">
                <?php $this->renderPartial('_search_form', array('isInner' => 0)); ?>
            </div>

            <div class="index-search-button-line">
                <a href="javascript: void(0);" id="more-options-link"><?php echo tc('More options'); ?></a>
                <a href="javascript: void(0);" onclick="$('#search-form').submit();" id="btnleft" class="btnsrch"><?php echo tc('Search'); ?></a>
            </div>
        </div>
    </div>
</form>

<?php
$content = $this->renderPartial('_search_js', array(
	'isInner' => 0
	),
	true,
	false
);
Yii::app()->clientScript->registerScript('search-params-index-search', $content, CClientScript::POS_HEAD, array(), true);
?>



