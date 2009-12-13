=== SuperSlider-MooFlow ===
Contributors: Daiv Mowbray
Plugin URI: http://wp-superslider.com/
Tags:animation, animated, images, gallery, mooflow, mootools 1.2, mootools, slider, superslider, slideshow2, menu
Requires at least: 2.6
Tested up to: 2.8.2
Stable tag: 0.6

This is an itunes like image scrubber. Uses the mootools javascript plugin Mooflow from [outcut]( http://www.outcut.de/MooFlow/ "outcut")


== Description ==

SuperSlider MooFlow, This is an itunes like image Slider. Uses the mootools javascript plugin Mooflow from http://www.outcut.de/MooFlow/. Highly configurable, theme based design, css based animations. Shortcode system on post and page screens. Degrades gracefully with javascript turned off, or plugin removed / disabled.

**credits:**

* mootools - [Mootools](http://mootools.net/ "Your favorite javascript framework")
* mooflow - [Mooflow]( http://www.outcut.de/MooFlow/ "Your favorite mooflow")

**Support**

If you have any problems or suggestions regarding these plugins [please speak up](http://support.wp-superslider.com/ "support forum"), 

**Demos**

This plugin can be seen in use here:

* [Demo 1](http://wp-superslider.com/2009/mooflow-demo-1"Demo")
* [Demo 2](http://wp-superslider.com/2009/mooflow-demo-2"Demo")

**Plugins**

Download These Other Plugins here:

* [SuperSlider](http://wordpress.org/extend/plugins/superslider/ "SuperSlider")
* [SuperSlider-Show](http://wordpress.org/extend/plugins/superslider-show/ "SuperSlider-Show")
* [SuperSlider-Menu](http://wordpress.org/extend/plugins/superslider-menu/ "SuperSlider-Menu")
* [SuperSlider-MilkBox](http://wordpress.org/extend/plugins/superslider-postsincat/ "SuperSlider-PostsinCat")

Or download from the domain [wp-superslider.com](http://wp-superslider.com/downloadsuperslider/superslider-mooflow-download "SuperSlider-Downloads")


== Screenshots ==

1. ![SuperSlider-MooFlow in action](screenshot-1.png "SuperSlider-MooFlow")
2. ![SuperSlider-MooFlow meta box](screenshot-1.png "SuperSlider-MooFlow meta box")
3. ![SuperSlider-MooFlow options screen](screenshot-1.png "SuperSlider-MooFlow option screen")

== Installation ==

* Unpack contents to wp-content/plugins/ into a **superslider-mooflow** directory
* Activate the plugin,
* Configure global settings for plugin under > settings > SuperSlider-Mooflow

== Usage ==

* First install and activat this plugin.
* Create a new post or page
* Add the mooflow shortcode manually or with the mooflow shortcode matabox bellow the post/text entry field.
* use one of the following manners to add images to the mooflow post.
    * attach images via the WordPress upload images popover screen. -Publish
    * add id="12, 23, 34" to the shortcode, (where 12, 23, 34 are post numbers with attached images) -Publish
    * add id="12" to the shortcode, (where 12 is a post number with attached images) -Publish
    * add id="random" and numPosts="10" to the shortcode, 
        (where random will sellect 10 random attached images from the WordPress system. ) -Publish
    * add valid image tags <img src="your_image.jpg" /> after the mooflow shortcode then close with shortcode close tag:
        [mooflow]<img src="your_image.jpg" /><img src="your_image2.jpg" /><img src="your_image3.jpg" />[/mooflow]
     
== Themes ==

Create your own graphic and animation theme based on one of these provided.

**Available themes**

* default
* blue
* black
* custom

== Changelog ==

*0.6 (2009/07/27)

   * Updated mootools to 1.2.3 

*0.5  (2009/06/19)

    * fixed link to image in settings screen

*0.4.1 (2009/04/28)

    *   fixed enqueue script to use wp_print_scripts instead of head.

*0.4 (2009/04/20)

    *   added function to pull images from this post attached
    *   added option to enter random into ID, along with number, pulls x images from media library
    *   added link to popover/attachment/parent with viewer option.
    *   added function to enter list of post ids (must have images attached)
    *   changed the way the short code works. now runs with self closeing single tag [mooflow] 
    *   fixed multiple mooflows on one page
 

*0.3 (2009/03/12)

  * fixed the viewer on/off via short code bug
  * switched the milkbox-lightbox image click from double to single.
  * changed milkbox file names to milkflow
  * fixed first loaded images visible to hidden  
  * fixed fullscreen to lightbox pop over error (css z-index)

*0.2 (2009/02/03)
	
  * Added insert at cursor for the shortcode metabox
  * Integrated with SuperSlider-MilkBox...

*0.1 (2009/01/15)

  * first public launch

---------------------------------------------------------------------------