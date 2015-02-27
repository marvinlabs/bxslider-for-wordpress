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

if ( !class_exists('BXSG_SliderShortcode')) :

    /**
     * Handles the [slider] and [next-slide] shortcodes
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class BXSG_SliderShortcode
    {

        public function __construct($plugin)
        {
            $this->plugin = $plugin;
            $this->current_slider_id = 0;
            $this->setup();
        }

        /**
         * Setup the WordPress hooks we need
         */
        public function setup()
        {
            if (is_admin())
            {
                return;
            }

            add_shortcode('bxslider', array(&$this, 'process_slider_shortcode'));
            add_shortcode('slider', array(&$this, 'process_slider_shortcode'));
            add_shortcode('next-slide', array(&$this, 'process_next_slide_shortcode'));

            // Other hooks
            add_action('wp_footer', array(&$this, 'print_slider_scripts'), 10000);
        }

        /**
         * Replace the [slider] shortcode with a slider
         *
         * @param array  $attrs
         * @param string $content
         */
        public function process_slider_shortcode($params = array(), $content = null)
        {
            // Extract parameters and provide defaults for the missing ones
            extract(shortcode_atts(array(
                'transition'      => $this->plugin->get_option(BXSG_Settings::$OPTION_DEFAULT_TRANSITION),
                'adaptive_height' => $this->plugin->get_option(BXSG_Settings::$OPTION_SL_ADAPTIVE_HEIGHT),
                'auto_start'      => $this->plugin->get_option(BXSG_Settings::$OPTION_SL_AUTO_START),
                'speed'           => $this->plugin->get_option(BXSG_Settings::$OPTION_SL_SPEED),
                'duration'        => $this->plugin->get_option(BXSG_Settings::$OPTION_SL_DURATION),
                'extra_options'   => $this->plugin->get_option(BXSG_Settings::$OPTION_SL_EXTRA_OPTIONS)
            ), $params));

            // Compute an ID for this particular slider
            $slider_id = 'bx-slider-' . $this->current_slider_id;
            $this->current_slider_id += 1;

            $slider_extra_classes = $adaptive_height ? 'adaptive-height-on ' : 'adaptive-height-off ';
            $slider_extra_classes = esc_attr($slider_extra_classes);

            // Build the HTML output
            $out = "<div id='{$slider_id}' class='bxslider-slider {$slider_extra_classes}'>" . "\n";
            $out .= "  <div class='bxslider'>" . "\n";
            $out .= "    <div class='slide'>" . "\n";
            $out .= do_shortcode($content);
            $out .= "    </div>" . "\n";
            $out .= "  </div>" . "\n";
            $out .= "</div>" . "\n";

            // We enqueue the script for inclusion in the WordPress footer
            ob_start();
            include(BXSG_INCLUDES_DIR . '/slider-shortcode.script.php');
            $this->scripts[] = ob_get_contents();
            ob_end_clean();

            return $out;
        }

        /**
         * Replace the [next-slide] shortcode to separate two slides from each other
         *
         * @param array  $attrs
         * @param string $content
         */
        public function process_next_slide_shortcode($params = array(), $content = null)
        {
            // Extract parameters and provide defaults for the missing ones
            extract(shortcode_atts(array(), $params));

            $out = "    </div>" . "\n";
            $out .= "    <div class='slide'>" . "\n";

            return $out;
        }

        /**
         * Prints all the scripts that have been enqueued by shortcodes
         */
        public function print_slider_scripts()
        {
            if (empty($this->scripts))
            {
                return;
            }

            echo '<script type="text/javascript">' . "\n";
            echo '    jQuery(document).ready( function($) {' . "\n    ";
            echo implode("\n        ", $this->scripts) . "\n";
            echo '    });' . "\n";
            echo '</script>' . "\n";
        }

        /** @var BXSG_Plugin The plugin instance */
        private $plugin;

        /** @var array */
        private $scripts;

        /** @var int current slider id */
        private $current_slider_id;
    }

endif; // if (!class_exists('BXSG_SliderShortcode')) :