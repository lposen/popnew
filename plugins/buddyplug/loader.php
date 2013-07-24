<?php
/*
Plugin Name: BuddyPlug
Plugin URI: http://github.com/modemlooper/BuddyPlug
Description: Quickly and easily access and install BuddyPress plugins from WordPress.org, right from your dashboard.
Version: 0.3
Author: modemlooper
Author URI: http://twitter.com/modemlooper
License: GPL2
*/



function buddyplug_init() {

	require( dirname( __FILE__) . '/include/bpp-class.php' );

    if ( get_bloginfo( 'version' ) >= 3.5 ) {
        $bpp_buddypress_plugins = new BPP_BuddyPress_Plugins();
    }

}
add_action( 'bp_include', 'buddyplug_init' );