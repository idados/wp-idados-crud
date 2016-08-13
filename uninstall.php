<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0001");
$wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0002");
$wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0003");
$wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0004");
$wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0005");

// $option_name = 'plugin_option_name';
// delete_option( $option_name );
// delete_site_option( $option_name );
// global $wpdb;
// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );

/*
ref:
https://codex.wordpress.org/Function_Reference/register_uninstall_hook
note in multisite looping through blogs to delete 
options on each blog does not scale. 
You'll just have to leave them.
*/
