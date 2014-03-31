<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
exit (); 

	global $wpdb; 
 //$wpdb->query("delete from $wpdb->postmeta where meta_key = 'sci_icons';");
 $wpdb->query("delete from $wpdb->options where option_name like 'sci%';");

?>
