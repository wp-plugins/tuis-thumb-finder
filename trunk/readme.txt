=== Plugin Name ===
Contributors: Stephen Baugh
Donate link: http://www.stephenbaugh.com/donation.php
Tags: category, thumbs, formatting, media, images, thumbnail, themes, admin, post, png, jpg, gif
Requires at least: 2.0.2
Tested up to: 2.7
Stable tag: 1.01

This plugin has been written to provide various ways to return an *image thumb* either as a URL or IMG tag. There are four functions.

== Description ==

Many Wordpress themes, are heavily dependant on "feature images" to use as thumbnails to make them look good. This is great except it adds a lot of extra work setting up these thumb references, but equally if you are in a hurry and forget you add the thumb then the look of the theme breaks.

So here is **Tui's Find Thumb** plugin. It is very easy to use. It's purpose is to replace the Image function currently used in your theme with one that is lot more clever. With these new functions available you can do everything from a randomly select an image, or return a URL or IMG tag source specifically for that post.

The post option works through this logic until it gets a result

1. Returns an IMG tag based on the thumbnail set in the post meta data (through special post fields) 
2. The first image in the post
3. A randomly chosen image from a directory (in your base images directory) with the same name as the posts first category slug.
4. A randomly chosen image from your base images directory
 

== Installation ==

This section describes how to install the plugin and get it working.

1. Vistit [plugin home page](http://www.stephenbaugh.com/blog/wordpress-plugins/find-thumb/) to get full install instructions including image references.
2. Upload `tui_findthumb.php` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Edit your plugin settings
5. Set up your image folders
6. Edit pages in your templates


== Frequently Asked Questions ==

= Can I contact you? =

Yes. [email me](mailto:stephen@stephenbaugh.com)

= I'd like to make a donation, is that possible? =

That would be great and certainly would help development efforts. To do so [click here](http://www.stephenbaugh.com/donation.php) thank you.

= How do I report at bug? =

The easiest way is to visit my Google Code Project and [register an issue](http://code.google.com/p/tui-find-thumb/issues/list)

== Screenshots ==

1. Sample of a theme using a thumbnail image
2. Download then activate the plugin
3. Goto plugin settings page
4. Set up the base directory for your images.png
5. Set up the default css class to use and thumbnail name
6. How should your thumbnails be scaled and what size by default
7. If you need more help look at the top right hand corner of the options page
8. Now it's time to edit your theme. Look for where thumbnails are used
9. Replace with code that uses our plugin
10. If you know the plugin will remain installed don't worry about error checking
11. Now go find out the "slug" names for each of your categories
12. Finally using your ftp client set up matching directories in your base image directory, up load those images you want to be random.


== Functions available ==

There are 5 funtions that can be accessed through this plugin.

**1. tui_findRandomBackgroundSTYLE()**

	Returns a random image URL from the background images folder if one exists else the base image folder.

**2, tui_findRandomThumbURL()**

	Returns a random image URL from base image folder

**3. tui_findRandomThumbIMG("Height","Width","Class","Title","Alt")**

	Returns a random image IMG Tage from base image folder

**4. tui_findPostThumbURL("thepostID")**

	Returns a URL, having searched based on the postID

**5. tui_findPostThumbIMG("thepostID","Height","Width","Class","Title","Alt")**

	Returns an IMG tag, containing the URL, height, width, alt, title and class, having searched based on the postID

== Support ==



Support can be found on plugin homepage: http://www.stephenbaugh.com/blog/wordpress-plugins/find-thumb/

You can also view project here: http://code.google.com/p/tui-find-thumb/

 * Additional documentation: http://code.google.com/p/tui-find-thumb/w/list

 * Issues & requests: http://code.google.com/p/tui-find-thumb/issues/list

 * Development version: http://code.google.com/p/tui-find-thumb/source/

 * Change logs: http://code.google.com/p/tui-find-thumb/wiki/Changelogs

