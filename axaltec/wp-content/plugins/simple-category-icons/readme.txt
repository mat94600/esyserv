=== Simple Category Icons ===
Contributors: basszje
Donate link: http://www.weblogmechanic.com/plugins/simple-category-icons/
Author URI: http://www.weblogmechanic.com
Plugin URI: http://www.weblogmechanic.com/plugins/simple-category-icons/
Tags: icon, icons, category, categories
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


A simple way to add icons to your categories and other taxonomies.

== Description ==

* Author: [Bas Schuiling](http://www.weblogmechanic.com/about)
* Project URI: <http://www.weblogmechanic.com/plugins/simple-category-icons/>
* License: GPL 2. See License below for copyright jots and tittles.

Simple Category Icons (SCI) was developed because of dissatisfaction with other icon plugins for categories. SCI provides a way to put icons next to your taxonomies like categories, tags and custom taxonomies in a easy and friendly way. Besides being simple SCI offers you full control over the output. 


Features: 

* Three customizable sizes for your icons ( small, medium, large )
* Integrates in taxonomies admin interface
* Simple theme template call 
* Stores your icons in the media library 
* You can use any taxonomy to put icons at. 
* Use filters and arguments to customize output

See the instructions under 'installation' to get most out of SCI. 

More features will be added after popular demand 

  [WordPress]: http://wordpress.org/
  [WordPress MU]: http://mu.wordpress.org/
  [3.0]: http://codex.wordpress.org/Version_3.0


== Screenshots ==

1. Interface on category overview
2. Settings page

== Changelog ==

= 1.12 = 

* Bug - plugin crashing 

= 1.11 = 

* Bug: SCI messing up term_ids in admin. 
	(note: this *will* reset your icons - sorry )

= 1.1 = 

* Support for multiple taxonomies
* Added 'class' CSS argument for the_icon
* Added filters for title, image tag and category used (see instructions)
* Use term_id to get a specific icon set
* Images now resized to absolute given dimension ( both width and height )
* Bug fix for breaking featured featured image when activated (related to WP bug #22843) 
* Media library will show term name when selecting images. 
* Uninstall routine.

= 1.0 = 

* First release 

== Installation ==

Upload files to your plugin directory or use Wordpress built-it features. Activate plugin. 
	
Simple Category Icons features functions you can use in your themes to output icons where you need them. SCI defaults to retrieving icons set on the category but you can use other taxonomies as well.  
 
= Theme codes = 

Example:
 ` if (function_exists('the_icon')) { the_icon('size=small'); } ?>`

the_icon($args, $term_type = 'category',$id = null, $use_term_id = null): 

You can use different arguments either in a string or array: 
 ` the_icon('size=small&class=your_class'); `

or 
`   the_icon(array('size' => 'small',
   				  'class' => 'your_class'));`
   				  
Other arguments accepted are taxonomy type ( i.e category,post_tag ) for getting icons from other taxonomies and 
id for using a querying a different post_id. You can even give a term id ($use_term_id) and get the icons set for that specific term. 
This will ignore 

Will use the tag taxonomy: 
 ` the_icon('size=small&class=your_class','post_tag'); `

Args currently accepts size (small,medium or large) and class ( custom CSS class ). 
     				  

`$url = get_the_icon($args, $term_type = 'category',$id = null, $use_term_id = null)` : 				  

If you want more control over your icon you can use this function. $args accepts size (small, medium, large) 
and returnFull (true, false). If set to true the function returns an Array with the term object and the URL of the found icon. 
If set to false the function will only return the URL to the image. 

= Filters = 

If you need even more control over the_icon these two filters are for you: 

'sci_icon_title' : Filters 'title' tag on the image. Parameters given are title and term_id  
'sci_print_icon' : Filters the full image tag before outputting. Parameters are image tag and term_id

By default SCI gets the icon of the lowest category in the structure. 

I.e. with a structure like : ( parent term -> sub-parent term -> term ) SCI will take the icon set to term and will display nothing if there is no icon on this term. You can change this behavior by applying the 'sci_category_decision' filter. Parameters are a term object (the 'decision') which is about the be used and an Array of all term Objects used in this decision. Return value is a term Object. You can return any term object here.



== License ==

The FeedWordPress Advanced Filter plugin is copyright © 2013 by Bas Schuiling. It uses
code derived or translated from:


according to the terms of the [GNU General Public License][].

This program is free software; you can redistribute it and/or modify it under
the terms of the [GNU General Public License][] as published by the Free
Software Foundation; either version 2 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

  [GNU General Public License]: http://www.gnu.org/copyleft/gpl.html

