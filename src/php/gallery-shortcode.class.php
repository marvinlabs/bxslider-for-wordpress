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

if ( !class_exists('BXSG_GalleryShortcode')) :

    /**
     * Handles the [gallery] and [bxgallery] shortcodes
     *
     * @author Vincent Prat @ MarvinLabs
     */
    class BXSG_GalleryShortcode
    {

        public function __construct($plugin)
        {
            $this->plugin = $plugin;
            $this->current_gallery_id = 0;
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

            // Remove default gallery shortcode
            if ($this->plugin->get_option(BXSG_Settings::$OPTION_GS_REPLACE_DEFAULT_GALLERIES))
            {
                add_filter('gallery_style', '__return_false');
                remove_shortcode('gallery');
                add_shortcode('gallery', array(&$this, 'process_shortcode'));
            }

            add_shortcode('bxgallery', array(&$this, 'process_shortcode'));

            // Other hooks
            add_action('wp_footer', array(&$this, 'print_gallery_scripts'), 10000);
        }

        /**
         * Replace the default WordPress [gallery] shortcode with a slideshow
         *
         * @param array  $attrs
         * @param string $content
         */
        public function process_shortcode($params = array(), $content = null)
        {
            // Extract parameters and provide defaults for the missing ones
            extract(shortcode_atts(array(
                'ids'              => null,
                'transition'       => $this->plugin->get_option(BXSG_Settings::$OPTION_DEFAULT_TRANSITION),
                'exclude_featured' => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_EXCLUDE_FEATURED_IMAGE),
                'hide_carousel'    => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_HIDE_CAROUSEL),
                'adaptive_height'  => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_ADAPTIVE_HEIGHT),
                'auto_start'       => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_AUTO_START),
                'speed'            => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_SPEED),
                'duration'         => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_DURATION),
                'extra_options'    => $this->plugin->get_option(BXSG_Settings::$OPTION_GS_EXTRA_OPTIONS),
                'shuffle'          => 0,
                'size'             => 'full',
                'thumb_size'       => 'thumbnail'
            ), $params));

            // If no ids are provided, we will take every image attached to the current post.
            // Else, we'll simply fetch them from the DB
            $ids = ($ids) ? explode(',', $ids) : array();
            $attachments = $this->get_attached_medias($ids, $exclude_featured);

            if ($shuffle == 1)
            {
                shuffle($attachments);
            }

            // Compute an ID for this particular gallery
            $gallery_id = 'bx-gallery-' . $this->current_gallery_id;
            $this->current_gallery_id += 1;

            // Build the HTML output
            ob_start();
            include(BXSG_INCLUDES_DIR . '/gallery-shortcode.view.php');
            $out = ob_get_contents();
            ob_end_clean();

            // We enqueue the script for inclusion in the WordPress footer
            ob_start();
            include(BXSG_INCLUDES_DIR . '/gallery-shortcode.script.php');
            $this->scripts[] = ob_get_contents();
            ob_end_clean();

            return $out;
        }

        /**
         * Prints all the scripts that have been enqueued by shortcodes
         */
        public function print_gallery_scripts()
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

        private function get_attached_medias($ids = array(), $exclude_featured = false)
        {
            global $post;

            $args = array(
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'post_status'    => 'inherit',
                'numberposts'    => -1,
                'order'          => 'ASC'
            );

            if (empty($ids))
            {
                $args['post_parent'] = $post->ID;
                $args['orderby'] = 'menu_order ID';
            }
            else
            {
                $args['post__in'] = $ids;
                $args['orderby'] = 'post__in';
            }

            if ($exclude_featured == true || $exclude_featured == 1)
            {
                $featured_id = get_post_thumbnail_id();
                if ($featured_id)
                {
                    $args['exclude'] = $featured_id;
                }
            }

            $attachments = get_posts($args);

            return $attachments;
        }

        /** @var BXSG_Plugin The plugin instance */
        private $plugin;

        /** @var array */
        private $scripts;

        /** @var int current gallery id */
        private $current_gallery_id;
    }

endif; // if (!class_exists('BXSG_GalleryShortcode')) :