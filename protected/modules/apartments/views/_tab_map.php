<?php
if ($data->type != Apartment::TYPE_BUY && $data->type != Apartment::TYPE_RENTING) {
	if(($data->lat && $data->lng) || Yii::app()->user->getState('isAdmin')){
		if(param('useGoogleMap', 1)) : ?>
			<div id="gmap">
				<?php echo $this->actionGmap($data->id, $data); ?>
			</div>
			<div class="clear"></div>
			<div id="gmap-panorama" style="display: none; visibility: hidden;"></div>
			<div class="clear"></div>
			<?php

				Yii::app()->clientScript->registerScript('initGmapPanorama', '
					var fenWayPanorama = new google.maps.LatLng('.$data->lat.', '.$data->lng.');

					function initializeGmapPanorama() {
						var panoOptions = {
							position: fenWayPanorama
							/*addressControlOptions: {
							 position: google.maps.ControlPosition.BOTTOM_CENTER
							 },
							 linksControl: false,
							 panControl: false,
							 zoomControlOptions: {
							 style: google.maps.ZoomControlStyle.SMALL
							 },
							 enableCloseButton: false*/
						};
						var gmapPanorama = new google.maps.StreetViewPanorama(
							document.getElementById("gmap-panorama"), panoOptions);
					}

					if (($("#gmap-panorama").length > 0)) {
						var streetViewService = new google.maps.StreetViewService();
						streetViewService.getPanoramaByLocation(fenWayPanorama, 30, function (streetViewPanoramaData, status) {
							if (status === google.maps.StreetViewStatus.OK) {
								$("#gmap-panorama").show().css("visibility", "visible");
								google.maps.event.addDomListener(window, "load", initializeGmapPanorama);
							} else {
								$("#gmap-panorama").hide().css("visibility", "hidden");
							}
						});
					}
					',
					CClientScript::POS_END);
			?>
		<?php endif;?>
		<?php if(param('useYandexMap', 1)) : ?>
			<div class="row" id="ymap">
				<?php echo $this->actionYmap($data->id, $data); ?>
			</div>
		<?php endif; ?>
	<?php
	}
}