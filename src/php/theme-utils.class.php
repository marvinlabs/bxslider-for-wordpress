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

require_once(BXSG_INCLUDES_DIR . '/settings.class.php');
require_once(BXSG_INCLUDES_DIR . '/gallery-shortcode.class.php');
require_once(BXSG_INCLUDES_DIR . '/slider-shortcode.class.php');

if ( !class_exists('BXSG_ThemeUtils')) :

    /**
     * Gathers static functions to be used in themes
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class BXSG_ThemeUtils
    {

        /**
         * Outputs a gallery related to the current post. If you need to change the output, you can use the
         * <code>get_the_post_gallery</code> function
         *
         * @param array $params the parameters that are passed to the [gallery] or [bxgallery] shortcodes to customize
         *                      the output. Please refer to the shortcode reference to know which parameters are available.
         */
        public static function the_post_gallery($params)
        {
            echo self::get_the_post_gallery($params);
        }

        public static function get_the_post_gallery($params)
        {
            global $bsxg_plugin;

            return $bsxg_plugin->gallery_shortcode->process_shortcode($params);
        }
    }

endif; // if (!class_exists('BXSG_ThemeUtils')) :