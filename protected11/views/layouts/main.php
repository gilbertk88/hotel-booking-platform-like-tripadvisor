<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
    $cs = Yii::app()->clientScript;
    $baseUrl = Yii::app()->baseUrl;
    ?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="google-translate-customization" content="6f8dbda81510a194-50f4b388aff89c26-g0d5dbb564ca66020-c"></meta>

	<title><?php echo 'SafariNest ';//CHtml::encode($this->seoTitle ); ?></title>
	<meta name="description" content="<?php echo 'The top African African travel & tour(safari) site, find the best tour agents, tour destinations, cheap/discounted hotel,hotel deals, buy cheap airline tickets, safari books and the most competitive safari packages to place like Masai Mara National Reserve (Kenya), Chobe National Park (Botswana), Kruger National Park (South Africa), South Luangwa National Park (Zambia), Serengeti National Park (Tanzania), Bwindi Impenetrable Forest (Uganda, Etosha Natonal Park (Namibia, Okavango Delta (Botswana), Ngorongoro Conservation Area (Tanzania), Hwange National Park (Zimbabwe) among others.
tanzania travel
tanzania tours
precision air tanzania
tanzania tourism
kenya tanzania
tanzania';//CHtml::encode($this->seoDescription ? $this->seoDescription : $this->pageDescription); ?>" />
	<meta name="keywords" content="<?php echo 'safari, cheap flights, hotel deals, cheap hotel, hotel deals, tour, africa, lion, big five, beach, Mombasa, maara, Masai Mara National Reserve (Kenya), Chobe National Park (Botswana), Kruger National Park (South Africa), South Luangwa National Park (Zambia), Serengeti National Park (Tanzania), Bwindi Impenetrable Forest (Uganda, Etosha Natonal Park (Namibia, Okavango Delta (Botswana), Ngorongoro Conservation Area (Tanzania), Hwange National Park (Zimbabwe),
tanzania travel
tanzania tours
precision air tanzania
tanzania tourism
kenya tanzania
tanzania,';//CHtml::encode($this->seoKeywords ? $this->seoKeywords : $this->pageKeywords); ?>" />

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
	
	
	/*this is an addon theme*/
	/*core css*/
	$cs->registerCssFile($baseUrl . '/home_files/css');
	$cs->registerCssFile($baseUrl . '/home_files/bootstrap.min.css');
	$cs->registerCssFile($baseUrl . '/home_files/font-awesome.css');
	$cs->registerCssFile($baseUrl . '/home_files/owl.carousel.css');
	$cs->registerCssFile($baseUrl . '/home_files/owl.theme.css');
	$cs->registerCssFile($baseUrl . '/home_files/owl.transitions.css');
	$cs->registerCssFile($baseUrl . '/home_files/magnific-popup.css');
	/*theme css*/
	$cs->registerCssFile($baseUrl . '/home_files/essentials.css');
	$cs->registerCssFile($baseUrl . '/home_files/layout.css');
	$cs->registerCssFile($baseUrl . '/home_files/green.css');
	
	//Yii::app()->bootstrap->registerAllCss();
	Yii::app()->bootstrap->registerCoreScripts();
	
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
	
	<div class="fit-vids-style" id="fit-vids-style" style="display: none;">­<style>         			.fluid-width-video-wrapper {        			   width: 100%;                     			   position: relative;              			   padding: 0;                      			}                                   															.fluid-width-video-wrapper iframe,  			.fluid-width-video-wrapper object,  			.fluid-width-video-wrapper embed {  			   position: absolute;              			   top: 0;                          			   left: 0;                         			   width: 100%;                     			   height: 100%;                    			}                                   		  </style></div>
	<script async="" src="<?php echo $baseUrl; ?>/home_files/analytics.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/home_files/modernizr.min.js"></script>
</head>

<body style="position: relative;">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=634840386604769&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- TOP BAR -->
		<div id="topBar">
			<!-- LANGUAGE 
				<div class="btn-group pull-right">
						<div id="google_translate_element"></div><script type="text/javascript">
						function googleTranslateElementInit() {
						  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
						}
						</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				</div>
				- /LANGUAGE -->
			<div class="container">
				<div class="btn-group pull-right">
					<button class="dropdown-toggle language" type="button" data-toggle="dropdown">
						My Account <span class="caret"></span>
					</button>

					<ul class="dropdown-menu">
						<?php if(Yii::app()->user->isGuest){ ?>
						<li>
							<a href="<?php echo $baseUrl; ?>/site/login"> Login</a>
						</li>
						<?php } ?>
						<?php if(Yii::app()->user->isGuest){ ?>
						<li>
							<a href="<?php echo $baseUrl; ?>/site/register"> Register</a>
						</li>
						<?php } ?>
						<?php if(!Yii::app()->user->isGuest){ ?>
						<li>
							<a href="<?php echo $baseUrl; ?>/usercpanel/main/index"> Account Settings</a>
						</li>
						<?php } ?>
						<?php if(!Yii::app()->user->isGuest){ ?>
						<li>
							<a href="<?php echo $baseUrl; ?>/usercpanel/main/index"> Dashboard</a>
						</li>
						<?php } ?>
						<?php if(!Yii::app()->user->isGuest){ ?>
						<li class="divider"></li>
						<li>
							<a href="<?php echo $baseUrl; ?>/site/logout"> Logout</a>
						</li>
						<?php } ?>
					</ul>
				</div>


				<!-- 
					LINKS - A MENU ALTERNATIVE
					Do not use this for responsive - too many links.
					If you want to use it, add class: hidden-xs
					Or use it instead of language / my account
				-->
				<!-- 
				<ul class="pull-right list-unstyled links">
					<li><a href="#"><i class="fa fa-user"></i> Login</a></li>
					<li><a href="#"><i class="fa fa-user"></i> Register</a></li>
				</ul>
				-->

			</div>
		</div>
		<!-- /TOP BAR -->




		<!-- HEADER -->
		<header id="header">
			<div class="container" id="middle">

				<!-- LOGO -->
				<a href="<?php echo $baseUrl;?>/" class="logo"><img alt="" src="<?php echo $baseUrl;?>/home_files/logo.png"></a>
				<!-- LOGO -->
<?php //echo $this->getUniqueId(); ?>
				<!-- OPTIONS -->
				
				<ul id="topOptions">
				<li class="dropdown" >
								<a class="dropdown-toggle" href="<?php echo $baseUrl; ?>/guestad/main/create" style="color:#81BA10; font-size:13px !important;">+ ADD LISTING(FREE) </i></a>
						</li>
				</ul>
					
						
					
				<!-- /OPTIONS -->

				<!-- TOP MENU -->
				<div class="navbar-collapse nav-main-collapse pull-left collapse" style="height: auto;">
					<nav class="nav-main">
						<ul class="nav nav-pills nav-main scroll-menu" id="topMain">

							<li class="dropdown">
								<a class="dropdown-toggle" href="<?php echo $baseUrl; ?>/">HOME</a>
							</li>

							<li class="dropdown">
								<a class="dropdown-toggle" href="<?php echo $baseUrl; ?>/search">SEE LISTINGS</i></a>
							</li>

							<li class="dropdown">
								<a class="dropdown-toggle" href="<?php echo $baseUrl; ?>/page/12">SEARCH ON MAP</a>
							</li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" href="<?php echo $baseUrl; ?>/contact-us">CONTACT US</a>
							</li>

						</ul>
					</nav>
				</div>
				<!-- /TOP MENU -->

			</div>
		</header>
		<!-- /HEADER -->


<?php

//echo $this->getUniqueId();

//echo Yii::app()->request->requestUri; ?>
	<?php if (demo()) :?>
		<?php $this->renderPartial('//site/ads-block', array()); ?>
	<?php endif; ?>

	<div id="container" <?php echo (demo()) ? 'style="padding-top: 40px;"' : '';?> >
		

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
		
		

		<?php
		if(!isset($adminView)){
		?>
			
		<?php
		} else {
			echo '<hr />';
			?>

			<div class="admin-top-menu">
			<?php
				/*$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->aData['adminMenuItems'],
					'encodeLabel' => false,
					'submenuHtmlOptions' => array('class' => 'admin-submenu'),
					'htmlOptions' => array('class' => 'adminMainNav')
				)); */
				?>
			</div>
		<?php
		}
		?>

		
			<?php echo $content; ?>
			<div class="clear"></div>
		

		<?php
			if(issetModule('advertising')) {
				$this->renderPartial('//../modules/advertising/views/advert-bottom', array());
			}
		?>

		<div class="footer">
			<?php echo getGA(); ?>
			<p class="slogan">&copy;&nbsp;<?php echo  'SafariNest , '.date('Y'); ?></p>
			<!--  -->
		</div>
		
	</div>
	<footer id="footer">
			<span id="slideTimer"><!-- fs-slideshow timer line --></span>

			<!-- right menu -->
			<ul style="padding:4px;">
				<li style="padding:3px;">
				<a href="https://twitter.com/safarinest" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size = "medium">Follow @safarinest</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</li>
				<li>
				<?php $this->widget('application.extensions.social.social', array(
						'style'=>'horizontal', 
							'networks' => array(
							'twitter'=>array(
								'data-via'=>'safarinest', //http://twitter.com/#!/YourPageAccount if exists else leave empty
								 'href'=>'https://www.twitter.com/safarinest',
								), 
							/*'googleplusone'=>array(
								"size"=>"medium",
								"annotation"=>"none",
							), */
							'facebook'=>array(
								'href'=>'https://www.facebook.com/safarinest',//asociate your page http://www.facebook.com/page 
								'action'=>'like',//recommend, like
								'colorscheme'=>'dark',
								'width'=>'120px',
								)
							)
					));?></li>
					
				
				<li>
					<?php 
					//$fbshareurl= Yii::app()->createAbsoluteUrl(Yii::app()->request->url);?>
					<div class="fb-share-button" data-href="http://safarinest.com/" data-type="button"></div>
					
				</li>
			</ul>
			<!-- /right menu -->

			<!-- copyright -->
			<span class="hidden-xs">Contact Us: <b>info_at_safariNest.com</b> +254-724-848-463 or +254-723-408-263 </span> 
				 
			<!-- /copyright -->
		</footer>
		<!-- /FOOTER -->


		<!-- FOLLOW US -->
		<div class="modal fade bs-example-modal-lg" id="socialInlineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<div class="modal-header"><!-- modal header -->
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-hand-o-down"></i> Follow Us</h4>
					</div><!-- /modal header -->

					<!-- modal body -->
					<div class="modal-body">
						<p>Follow Us online, join our conversations, engage with our teams around the world!</p>
						<div class="text-center">
							<a href="./home_files/home.htm" class="socialbtn facebook"><i class="fa fa-facebook"></i>Facebook</a>
							<a href="./home_files/home.htm" class="socialbtn twitter"><i class="fa fa-twitter"></i>Twitter</a>
							<a href="./home_files/home.htm" class="socialbtn google"><i class="fa fa-google-plus"></i>Google Plus</a>
							<a href="./home_files/home.htm" class="socialbtn linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>
							<a href="./home_files/home.htm" class="socialbtn pinterest"><i class="fa fa-pinterest"></i>Pinterest</a>
							<a href="./home_files/home.htm" class="socialbtn flickr"><i class="fa fa-flickr"></i>Flickr</a>
							<a href="./home_files/home.htm" class="socialbtn youtube"><i class="fa fa-youtube"></i>Youtube</a>
							<a href="./home_files/home.htm" class="socialbtn vimeo"><i class="fa fa-vimeo-square"></i>Vimeo</a>
							<a href="./home_files/home.htm" class="socialbtn skype"><i class="fa fa-skype"></i>Skype</a>
							<a href="./home_files/home.htm" class="socialbtn rss"><i class="fa fa-rss"></i>Rss</a>
						</div>
					</div>
					<!-- /modal body -->

				</div>
			</div>
		</div>
		<!-- /FOLLOW US -->


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
	
</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51154372-1', 'safarinest.com');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>