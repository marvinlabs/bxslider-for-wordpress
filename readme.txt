=== bxSlider integration for WordPress ===
Contributors: vprat, marvinlabs
Donate link: http://www.marvinlabs.com/donate/
Tags: wordpress, gallery, slider, bxslider, slideshow, 
Requires at least: 3.5
Tested up to: 3.9
Stable tag: 1.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

bxSlider for WordPress integrates the great responsive content slider "bxSlider jQuery plugin" in your very own WordPress
site.

== Description ==

bxSlider for WordPress integrates the great responsive content slider [bxSlider jQuery plugin](http://bxslider.com/) in
your very own WordPress site. Galleries are turned into beautiful sliders, but you can also roll you own sliders using 
special shortcode. The best thing is that you are not limited to the number of sliders or galleries per page, you can 
have as many as you want! 

Why should you use this slider? I'll quote the bxSlider's website:

* Fully responsive - will adapt to any device
* Horizontal, vertical, and fade modes
* Slides can contain images, video, or HTML content
* Advanced touch / swipe support built-in
* Uses CSS transitions for slide animation (native hardware acceleration!)
* Full callback API and public methods
* Small file size, fully themed, simple to implement
* Browser support: Firefox, Chrome, Safari, iOS, Android, IE7+

=== Languages ===

Easy Digital Downloads has been translated into the following languages:

English (and British English)
German
Spanish

Would you like to help translate the plugin into more languages? [Join our WP-Translations
Community](https://www.transifex.com/projects/p/bxslider-integration-for-wordpress/).

== Features ==

* [gallery] and [bxgallery] shortcodes
* [slider] and [bxslider] shortcodes
* Template functions

= [gallery] and [bxgallery] shortcodes =

You can use the default WordPress `[gallery]` shortcode or use the additional `[bxgallery]` shortcode to create awesome 
dynamic galleries. These shortcodes take the following parameters:

- **ids** *[a comma-separated list of image IDs]*: This is usually inserted for you when you create the gallery from the 
media box. If you omit this parameter, all the images you have uploaded along with the post will be included in the 
gallery. 
- **exclude_featured** *[1 or 0]*: if set to 1 and you did not specify specific ids as above, the post featured image 
will be excluded from the gallery. If you omit this parameter, it will default to the value set in the plugin settings
page. 
- **hide_carousel** *[1 or 0]*: if set to 1, the carousel with thumbnails will not be shown. If you omit this 
parameter, it will default to the value set in the plugin settings page. 
- **duration** *integer*: the duration of slides in milliseconds 
- **speed** *integer*: the speed of transitions in milliseconds 
- **extra_options** *comma-separated list of javascript options to be passed to bxSlider directly*: this allows to 
directly specify some options for bxSlider if those options are not yet provided as settings or shortcode parameters by
our plugin. For instance: [bxgallery extra_options="pager: false, "]
- **transition** *'fade', 'horizontal' or 'vertical'*: the type of transition between slides
- **adaptive_height** *[1 or 0]*: if set to 1, the height of the slider/gallery will automatically adjust to the content
of the current slide
- **auto_start** *[1 or 0]*: if set to 1, the slideshow will automatically start after the page has loaded.
- **shuffle** *[1 or 0]*: if set to 1, the images will be shown in random order
				
= [slider] and [bxslider] shortcodes =

You can also build your own custom sliders, with any content you'd like in them. 

*Here is an example:*

    [slider]
        This is my first slide. I can contain any html you like.
    [next-slide]
        And the shortcode above has made this text be the second slider.
    [next-slide]
        And thus we are now having the third slide of this slider. Below we close the initial shortcode to notify the end 
        of the slider. Simple, isn't it?
    [/slider]
    
The shortcode accepts the following parameters:

- **duration** *integer*: the duration of slides in milliseconds 
- **speed** *integer*: the speed of transitions in milliseconds 
- **extra_options** *comma-separated list of javascript options to be passed to bxSlider directly*: this allows to 
directly specify some options for bxSlider if those options are not yet provided as settings or shortcode parameters by
our plugin. For instance: [bxgallery extra_options="pager: false, "]
- **transition** *'fade', 'horizontal' or 'vertical'*: the type of transition between slides
- **adaptive_height** *[1 or 0]*: if set to 1, the height of the slider/gallery will automatically adjust to the content
of the current slide
- **auto_start** *[1 or 0]*: if set to 1, the slideshow will automatically start after the page has loaded.

= Template functions =

The plugin also provides template functions to be used in your theme files. Those functions are all static methods of 
the class `BXSG_ThemeUtils`. To be safe, in case the plugin is not active, you should check that the class exists 
before calling the functions:

    <?php 
    	if ( class_exists( 'BXSG_ThemeUtils' ) ) {
    		// Do something with the BXSG_ThemeUtils class
		} 
	?>

*1. Post gallery*

    <?php BXSG_ThemeUtils::the_post_gallery( array( 
				'exclude_featured' => 1 
			) ); ?>

> Hint: you can pass the shortcode parameters as an array to customize the output 
	
== Upgrade Notice ==

Nothing worth mentionning yet. You might visit the settings page though to adjust new default settings values. 

== Installation ==

Nothing special, just upload the files, activate and you can then visit the settings page if you want. Really, it's 
just like any other simple plugin.

== Frequently Asked Questions ==

= Why isn't bxSlider's XXXXX option available in the plugin's settings page or shortcode? =

I have not yet found the use of all the bxSlider options. If you need to access any of them, please open a new topic in 
the plugin support forum, I will add that option as soon as possible.

You can in the meantime use the shortcode parameter "extra_options" (or the setting to have those parameters set for 
every gallery/slider).  

== Changelog ==

= 1.7.2 (2015/03/02) =

* New: Better structure for the plugin sources and release system
* New: Be part of our translator community at wp-translations.org

= 1.6.0 (2014/05/15) =

* New: Added a parameter to the gallery and bx-gallery shortcodes to specify image size and thumbnail size to use (respectively 
defaults to 'full' and 'thumbnail')

= 1.5.3 (2014/04/23) =

* New: Tested with WordPress 3.9
* New: Updated bxSlider script from version 4.1 to version 4.1.2
* Fix: a javascript syntax error on sliders

= 1.5.2 (2014/04/10) =

* The sliders get assigned to a JS variable so they can be re-used somewhere else (for instance to reload the slider)

= 1.5.1 (2014/01/17) =

* Added an option to avoid adding the bxSlider javascript when the theme (or another plugin) already includes it

= 1.5.0 (2013/11/06) =

* Added a shortcode to shuffle the gallery images.
* Fixed URLs when using an alternate wp-content folder

= 1.4.2 (2013/08/20) =

* Fixed typo in javascript and css links. 

= 1.4.1 (2013/07/29) =

* Fixed bug where some settings from 1.4.0 were switched between slider and gallery shortcodes. 

= 1.4.0 (2013/07/17) =

* Added an option to set the duration of slides 
* Added an option to set the speed of transitions
* Added an advanced option to directly inject javascript bxSlider options 

= 1.3.3 (2013/05/06) =

* Fixed bug with translations not properly loaded
* Added French translation

= 1.3.2 (2013/04/30) =

* Updated the documentation

= 1.3.1 (2013/04/25) =

* Fix for an error occuring on the latest WordPress 3.6 build

= 1.3.0 (2013/04/11) =

* Added an option and a shortcode parameter to set the transition type (fade/slide horizontally/fade vertically)

= 1.2.0 (2013/04/09) =

* Added an option and a shortcode parameter to enable/disable adaptive height 
* Added an option and a shortcode parameter to enable/disable slideshow automatic start

= 1.1.1 (2013/04/08) =

* Fixed a bug on activation ([function.array-merge]: Argument #2 is not an array in bxslider-integration/includes/core-classes/settings.class.php)

= 1.1.0 (2013/03/29) =

* Added a template function to output the post gallery from within a theme
* Added an option to exclude the post featured image from its gallery
* Added a generic slider shortcode
* Corrected a bug in attachment listing (images incorrectly pulled)

= 1.0.0 (2013/03/29) =

* First plugin release. 
* Replaces the default WordPress galleries with nice ones using the bxSlider jQuery plugin