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

if ( !class_exists('BXSG_Plugin')) :

    /**
     * The main plugin class
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class BXSG_Plugin
    {

        public function __construct()
        {
        }

        public function run()
        {
            $this->settings = new BXSG_Settings($this);
            $this->gallery_shortcode = new BXSG_GalleryShortcode($this);
            $this->slider_shortcode = new BXSG_SliderShortcode($this);

            add_action('init', array(&$this, 'load_textdomain'));
            add_action('init', array(&$this, 'load_scripts'));
            add_action('init', array(&$this, 'load_styles'));

            if (is_admin())
            {
            }
            else
            {
            }
        }

        /**
         * Load the translation file for current language. Checks in wp-content/languages first
         * and then the bxslider-gallery/languages.
         *
         * Edits to translation files inside bxslider-gallery/languages will be lost with an update
         * **If you're creating custom translation files, please use the global language folder.**
         */
        public function load_textdomain()
        {
            $domain = 'bxsg';
            $locale = apply_filters('plugin_locale', get_locale(), $domain);

            $mofile = $domain . '-' . $locale . '.mo';

            /* Check the global language folder */
            $files = array(WP_LANG_DIR . '/bxslider-integration/' . $mofile, WP_LANG_DIR . '/' . $mofile);
            foreach ($files as $file)
            {
                if (file_exists($file))
                {
                    return load_textdomain($domain, $file);
                }
            }

            // If we got this far, fallback to the plug-in language folder.
            // We could use load_textdomain - but this avoids touching any more constants.
            load_plugin_textdomain('bxsg', false, BXSG_LANGUAGE_DIR);
        }

        /**
         * Loads the required javascript files (only when not in admin area)
         */
        public function load_scripts()
        {
            if (is_admin())
            {
                return;
            }

            if ($this->get_option(BXSG_Settings::$OPTION_INCLUDE_JS))
            {
                wp_enqueue_script(
                    'jquery.bxslider',
                    BXSG_SCRIPTS_URL . '/bxslider-integration.min.js',
                    array('jquery'));
            }
        }

        /**
         * Loads the required css (only when not in admin area)
         */
        public function load_styles()
        {
            if (is_admin())
            {
                return;
            }

            if ($this->get_option(BXSG_Settings::$OPTION_INCLUDE_CSS))
            {
                wp_enqueue_style(
                    'jquery.bxslider',
                    BXSG_STYLES_URL . '/bxslider-integration.min.css');
            }
        }

        /**
         * Access to the settings (delegated to our settings class instance)
         *
         * @param unknown $option_id
         */
        public function get_option($option_id)
        {
            return $this->settings->get_option($option_id);
        }

        /** @var BXSG_Settings */
        private $settings;

        /** @var BXSG_GalleryShortcode */
        public $gallery_shortcode;

        /** @var BXSG_SliderShortcode */
        public $slider_shortcode;
    }

endif; // if (!class_exists('BXSG_Plugin')) :