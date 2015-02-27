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

<div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php _e('bxSlider integration', 'bxsg'); ?></h2>

    <form method="post" action="options.php">

        <?php
        settings_fields(BXSG_Settings::$OPTIONS_GROUP);
        do_settings_sections(BXSG_Settings::$OPTIONS_PAGE_SLUG);
        ?>

        <?php submit_button(); ?>
    </form>
</div>