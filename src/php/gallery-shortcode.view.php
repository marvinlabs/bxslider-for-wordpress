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

<?php
$gallery_extra_classes = $adaptive_height ? 'adaptive-height-on ' : 'adaptive-height-off ';
?>

<div id="<?php echo $gallery_id; ?>" class="bxslider-gallery <?php echo esc_attr($gallery_extra_classes); ?>">
    <div class="gallery-wrapper">
        <div class="bxslider">
            <?php
            foreach ($attachments as $attachment) :
                $img_attr = wp_get_attachment_image_src($attachment->ID, $size);
                $title = apply_filters('the_title', $attachment->post_title, $attachment->ID);
                $desc = $attachment->post_excerpt;
                ?>
                <div class="bxslide"><?php echo sprintf('<img src="%1$s" alt="%2$s" title="%3$s" />',
                        $img_attr[0], esc_attr($desc), esc_attr($title));
                    ?></div>
            <?php
            endforeach; ?>
        </div>
    </div>

    <?php if ( !$hide_carousel) : ?>

        <div class="pager-wrapper">
            <div class="bxpager">
                <?php
                $i = 0;
                foreach ($attachments as $attachment) :
                    $img_attr = wp_get_attachment_image_src($attachment->ID, $thumb_size);
                    $title = apply_filters('the_title', $attachment->post_title, $attachment->ID);
                    $desc = $attachment->post_excerpt;

                    echo sprintf('<a data-slide-index="%4$s" href="" title="%3$s"><img src="%1$s" alt="%2$s" title="%3$s" /></a>',
                        $img_attr[0], esc_attr($desc), esc_attr($title), $i);
                    ++$i;
                endforeach; ?>
            </div>
        </div>

    <?php endif; // !$hide_carousel ?>

</div>