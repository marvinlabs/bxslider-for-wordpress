<?php
/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
?>

if ( typeof sliders==="undefined" ) {
var sliders = new Array();
}
sliders['<?php echo $slider_id; ?>'] = $( '#<?php echo $slider_id; ?> .bxslider' ).bxSlider({
adaptiveHeight:    <?php echo($adaptive_height ? 'true' : 'false'); ?>,
auto:    <?php echo($auto_start ? 'true' : 'false'); ?>,
mode:    '<?php echo $transition; ?>',
speed:    <?php echo $speed; ?>,
pause:    <?php echo $duration; ?>,
<?php echo $extra_options; ?>
});