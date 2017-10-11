<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
    $cs = Yii::app()->clientScript;
    $baseUrl = Yii::app()->baseUrl;
    ?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->seoTitle ); ?></title>
	<meta name="description" content="<?php echo CHtml::encode($this->seoDescription ? $this->seoDescription : $this->pageDescription); ?>" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->seoKeywords ? $this->seoKeywords : $this->pageKeywords); ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/print.css" media="print" />
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/form.css" />-->
	<link media="screen, projection" type="text/css" href="<?php echo $baseUrl; ?>/css/styles.css" rel="stylesheet" />

	<!--[if IE]> <link href="<?php echo $baseUrl; ?>/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	<link rel="icon" href="<?php echo $baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<?php
    $cs->registerCoreScript('jquery');
    $cs->registerCoreScript('jquery.ui');
    $cs->registerCoreScript('rating');
    $cs->registerCssFile($cs->getCoreScriptUrl().'/rating/jquery.rating.css');
    $cs->registerCssFile($baseUrl . '/css/ui/jquery-ui.multiselect.css');
    $cs->registerCssFile($baseUrl . '/css/redmond/jquery-ui-1.7.1.custom.css');
    $cs->registerCssFile($baseUrl . '/css/ui.slider.extras.css');
    $cs->registerScriptFile($baseUrl . '/js/jquery.multiselect.min.js');
    $cs->registerCssFile($baseUrl . '/css/ui/jquery-ui.multiselect.css');
    $cs->registerScriptFile($baseUrl . '/js/jquery.dropdownPlain.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/common.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/habra_alert.js', CClientScript::POS_END);
    $cs->registerCssFile($baseUrl.'/css/form.css', 'screen, projection');
	
	if(param('useYandexMap') == 1){
        $cs->registerScriptFile(
			'http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&coordorder=longlat&lang='.CustomYMap::getLangForMap(),
			CClientScript::POS_END);
	} else if (param('useGoogleMap') == 1){
        $cs->registerScriptFile('https://maps.google.com/maps/api/js??v=3.5&sensor=false&language='.Yii::app()->language.'', CClientScript::POS_END);
        $cs->registerScriptFile('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js', CClientScript::POS_END);
	}
	if(Yii::app()->user->getState('isAdmin')){
		?><link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/tooltip/tipTip.css" /><?php
	}
	?>
</head>

<body>
<?php
echo $this->getUniqueId();

//echo Yii::app()->request->requestUri; ?>
	<?php if (demo()) :?>
		<?php $this->renderPartial('//site/ads-block', array()); ?>
	<?php endif; ?>

	<div id="container" <?php echo (demo()) ? 'style="padding-top: 40px;"' : '';?> >
		<noscript><div class="noscript"><?php echo Yii::t('common', 'Allow javascript in your browser for comfortable use site.'); ?></div></noscript>
		<div class="logo">
			<a title="<?php echo Yii::t('common', 'Go to main page'); ?>" href="<?php echo Yii::app()->controller->createAbsoluteUrl('/'); ?>">
				<img width="291" height="94" alt="<?php echo CHtml::encode($this->pageDescription); ?>" src="<?php echo $baseUrl; ?>/images/pages/logo-open-re.png" id="logo" />
			</a>
		</div>

		<?php
		
              
          
		if(!isFree()){
            if(count(Lang::getActiveLangs()) > 1){
                $this->widget('application.modules.lang.components.langSelectorWidget', array( 'type' => 'links' ));
            }
            if(count(Currency::getActiveCurrency()) >1){
                $this->widget('application.modules.currency.components.currencySelectorWidget');
            }
		}
		?>
		
		<div id="user-cpanel"  class="menu_item">
			<?php
			   if(!isset($adminView)){
					/*$this->widget('zii.widgets.CMenu',array(
						'id' => 'nav',
						'items'=>$this->aData['userCpanelItems'],
						'htmlOptions' => array('class' => 'dropDownNav'),
					));*/
					?>
					
			<ul class="dropDownNav" id="nav">
			<li class="hover"><a href="<?php echo $baseUrl; ?>/guestad/main/create">List your property</a></li>
			<li class=""><a href="<?php echo $baseUrl; ?>/contact-us">Contact us</a></li>
			<li class=""><a href="<?php echo $baseUrl; ?>/usercpanel/main/index">Dashboard</a></li>
			 <?php if(!Yii::app()->user->isGuest){
			 echo '<li class=""><a class="fancy" href="'.$baseUrl.'/site/logout">Log out</a></li>';}
			?>
			</ul>
					<?php
				} else {
					$this->widget('zii.widgets.CMenu',array(
						'id' => 'dropDownNav',
						'items'=>CMap::mergeArray($this->aData['topMenuItems'], array(array('label' => Yii::t('common', 'Logout'), 'url'=>array('/site/logout')))),
						'htmlOptions' => array('class' => 'dropDownNav adminTopNav'),
					));
				}
			?>
		</div>

		<?php
		if(!isset($adminView)){
		?>
			<div id="search" class="menu_item">
				<?php
					$this->widget('zii.widgets.CMenu',array(
						'id' => 'dropDownNav',
						'items'=>$this->aData['topMenuItems'],
						'htmlOptions' => array('class' => 'dropDownNav'),
					));
					  //$this->widget('application.modules.lang.components.langSelectorWidget', array( 'type' => 'links' ));
				?>
			</div>
		<?php
		} else {
			echo '<hr />';
			?>

			<div class="admin-top-menu">
				<?php
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->aData['adminMenuItems'],
					'encodeLabel' => false,
					'submenuHtmlOptions' => array('class' => 'admin-submenu'),
					'htmlOptions' => array('class' => 'adminMainNav')
				));
				?>
			</div>
		<?php
		}
		?>

		<div class="content">
			<?php echo $content; ?>
			<div class="clear"></div>
		</div>

		<?php
			if(issetModule('advertising')) {
				$this->renderPartial('//../modules/advertising/views/advert-bottom', array());
			}
		?>

		<div class="footer">
			<?php echo getGA(); ?>
			<p class="slogan">&copy;&nbsp;<?php echo  'tourfinder , '.date('Y'); ?></p>
			<!--  -->
		</div>
		
	</div>

	<div id="loading" style="display:none;"><?php echo Yii::t('common', 'Loading content...'); ?></div>
	<?php
    $cs->registerScript('main-vars', '
		var BASE_URL = '.CJavaScript::encode(Yii::app()->baseUrl).';
		var params = {
			change_search_ajax: '.param("change_search_ajax", 1).'
		}
	', CClientScript::POS_HEAD, array(), true);

	if (issetModule('comparisonList')) {
		$cs->registerScript('compare-functions-end', '
			$(document).on("click", "a.compare-label", function() {
				apId = $(this).attr("id");
				apId = apId.replace("compare_label", "");

				if ($(this).attr("data-rel-compare") == "false") {
					if (apId) {
						var checkboxCompare = $("#compare_check"+apId);

						if (checkboxCompare.is(":checked"))
							checkboxCompare.prop("checked", false);
						else {
							checkboxCompare.prop("checked", true);
						}
						addCompare(apId);
					}
				}
			});

			$(document).on("change", ".compare-check", function() {
				apId = $(this).attr("id");
				apId = apId.replace("compare_check", "");

				addCompare(apId);
			});

			function addCompare(apId) {
				apId = apId || 0;

				if (apId) {
					var controlCheckedCompare = $("#compare_check"+apId).prop("checked");

					if (!controlCheckedCompare) {
						deleteCompare(apId);
					}
					else {
						$.ajax({
							type: "POST",
							url: "'.Yii::app()->createUrl('/comparisonList/main/add').'",
							data: {apId: apId},
							beforeSend: function(){

							},
							success: function(html){
								if (html == "ok") {
									$("#compare_label"+apId).html("'.tt('In the comparison list', 'comparisonList').'");
									$("#compare_label"+apId).prop("href", "'.Yii::app()->createUrl('comparisonList/main/index').'");
									$("#compare_label"+apId).attr("data-rel-compare", "true");
								}
								else {
									$("#compare_check"+apId).prop("checked", false);

									if (html == "max_limit") {
										$("#compare_label"+apId).html("'.Yii::t("module_comparisonList", "max_limit", array('{n}' => param('countListingsInComparisonList', 6))).'");
									}
									else {
										$("#compare_label"+apId).html("'.tc("Error").'");
									}
								}
							}
						});
					}
				}
			}

			function deleteCompare(apId) {
				$.ajax({
					type: "POST",
					url: "'.Yii::app()->createUrl('/comparisonList/main/del').'",
					data: {apId: apId},
					success: function(html){
						if (html == "ok") {
							$("#compare_label"+apId).html("'.tt('Add to a comparison list ', 'comparisonList').'");
							$("#compare_label"+apId).prop("href", "javascript:void(0);");
							$("#compare_label"+apId).attr("data-rel-compare", "false");
						}
						else {
							$("#compare_check"+apId).prop("checked", true);
							$("#compare_label"+apId).html("'.tc("Error").'");
						}
					}
				});
			}
		', CClientScript::POS_END, array(), true);
	}

	$this->widget('application.modules.fancybox.EFancyBox', array(
		'target'=>'a.fancy',
		'config'=>array(
				'ajax' => array('data'=>"isFancy=true"),
				'titlePosition' => 'inside',
				'onClosed' => 'js:function(){
					var capClick = $("#yw0_button");
					if(typeof capClick !== "undefined")	capClick.click();
				}'
			),
		)
	);
//var capClick = $("#yw0_button");alert(capClick);
	if(Yii::app()->user->getState('isAdmin')){
		$cs->registerScriptFile($baseUrl.'/js/tooltip/jquery.tipTip.minified.js', CClientScript::POS_HEAD);
		$cs->registerScript('adminMenuToolTip', '
			$(function(){
				$(".adminMainNavItem").tipTip({maxWidth: "auto", edgeOffset: 10, delay: 200});
			});
		', CClientScript::POS_READY);
		?>

		<div class="admin-menu-small <?php echo demo() ? 'admin-menu-small-demo' : '';?> ">
			<a href="<?php echo $baseUrl; ?>/apartments/backend/main/admin">
				<img src="<?php echo $baseUrl; ?>/images/adminmenu/administrator.png" alt="<?php echo Yii::t('common','Administration'); ?>" title="<?php echo Yii::t('common','Administration'); ?>" class="adminMainNavItem" />
			</a>
		</div>
	<?php } ?>
	<div id="social">
<?php $this->widget('application.extensions.social.social', array(
    'style'=>'vertical', 
        'networks' => array(
        'twitter'=>array(
            'data-via'=>'websiteinfogilb', //http://twitter.com/#!/YourPageAccount if exists else leave empty
			 'href'=>'https://www.twitter.com/ezsacco',
            ), 
        /*'googleplusone'=>array(
            "size"=>"large",
            "annotation"=>"none",
        ), */
        'facebook'=>array(
            'href'=>'https://www.facebook.com/ezsacco',//asociate your page http://www.facebook.com/page 
            'action'=>'like',//recommend, like
            'colorscheme'=>'light',
            'width'=>'120px',
            )
        )
));?><div>
</body>
</html>