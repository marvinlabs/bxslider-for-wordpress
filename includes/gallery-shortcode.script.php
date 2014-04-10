<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com)
This program is free software; you can redistribute it and/or modifyit under the terms of the GNU General Public License as published bythe Free Software Foundation; either version 2 of the License, or(at your option) any later version.
This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; without even the implied warranty ofMERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See theGNU General Public License for more details.
You should have received a copy of the GNU General Public Licensealong with this program; if not, write to the Free SoftwareFoundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA*/
?>
if ( typeof sliders==="undefined" ) {
	var sliders = new Array();
}
sliders['<?php echo $gallery_id; ?>'] = $( '#<?php echo $gallery_id; ?> .bxslider' ).bxSlider({
<?php if ( !$hide_carousel ) : ?>	
		pagerCustom:	'#<?php echo $gallery_id; ?> .bxpager',
<?php endif; // !$hide_carousel ?>
		adaptiveHeight:	<?php echo ( $adaptive_height ? 'true' : 'false'); ?>,
		auto:	<?php echo ( $auto_start ? 'true' : 'false'); ?>,
		mode:	'<?php echo $transition; ?>',
		speed: 	<?php echo $speed; ?>,
		pause: 	<?php echo $duration; ?>,
		<?php echo $extra_options; ?>
	});		
	
<?php if ( !$hide_carousel ) : ?>	
if ( typeof pagers==="undefined" ) {
	var pagers = new Array();
}
pagers['<?php echo $gallery_id; ?>'] = $('#<?php echo $gallery_id; ?> .bxpager').bxSlider({
  		minSlides: <?php echo $this->plugin->get_option( BXSG_Settings::$OPTION_GS_CAROUSEL_MIN_THUMBS ); ?>,
  		maxSlides: <?php echo $this->plugin->get_option( BXSG_Settings::$OPTION_GS_CAROUSEL_MAX_THUMBS ); ?>,
  		slideWidth: <?php echo $this->plugin->get_option( BXSG_Settings::$OPTION_GS_CAROUSEL_THUMB_WIDTH ); ?>,
  		slideMargin: <?php echo $this->plugin->get_option( BXSG_Settings::$OPTION_GS_CAROUSEL_THUMB_MARGIN ); ?>,
  		slideMove: <?php echo $this->plugin->get_option( BXSG_Settings::$OPTION_GS_CAROUSEL_THUMBS_MOVE ); ?>
	});	
<?php endif; // !$hide_carousel ?>