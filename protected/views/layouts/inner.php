<?php

$this->beginContent('//layouts/main');
echo '<div class="white">';
$this->renderPartial('//site/inner-search');

if(issetModule('advertising')) {
    $this->renderPartial('//../modules/advertising/views/advert-top', array());
}
?>

	<div class="main-content">
		<div class="main-content-wrapper">
			<?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					if ($key=='error' || $key == 'success' || $key == 'notice'){
						echo "<div class='flash-{$key}'>{$message}</div>";
					}
				}
			?>
			<A href="http://www.travelstart.co.ke/home?type=banner&&affId=180829&&img=TS_728x90_Generic_KE_01d.jpg"><img src="http://banners.travelstart.net/TS/AF-Banners/TS_728x90_Generic_KE_01d.jpg" border=0></A><img src="http://impression.clickinc.com/impressions/servlet/Impression?merchant=70537&&type=impression&&affId=180829&&img=TS_728x90_Generic_KE_01d.jpg" style="display:none" border=0>
															
			<?php echo $content; ?>
		</div>
	</div>
	</div>
<?php $this->endContent(); ?>
