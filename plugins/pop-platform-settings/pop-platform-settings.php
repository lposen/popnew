<?php
session_start();
/*
  Plugin Name: PoP Platform Settings
  Plugin URI: http://www.pencilsofpromise.org
  Version: 1.01
  Author: Pencils of Promise (Jonathan Stiles)
  Description: A plugin for controllings settings used by the connection between wordpress and Salesforce */
?>
<?php 
/* ------------------------------------------------------------------------ * 
 * Setting Registration 
 * ------------------------------------------------------------------------ */  
function platform_initialize_options() {
    
    // If the platform options don't exist, create them.  
    if( false == get_option( 'pop_platform_options' ) ) {  
        add_option( 'pop_platform_options' );  
    } // end if     
    
    // First, we register a section. This is necessary since all future options must belong to a 
    add_settings_section( 
        'platform_general_settings_section',        // ID used to identify this section and with which to register options 
        'General Platform Options',                 // Title to be displayed on the administration page 
        'platform_general_options_callback',        // Callback used to render the description of the section 
        'pop_platform_options'                      // Page on which to add this section of options 
    ); 
    add_settings_field(  
        'platform_show',                      // ID used to identify the field throughout the theme  
        'Activate the Platform',              // The label to the left of the option interface element  
        'platform_setting_enable_callback',    // The name of the function responsible for rendering the option interface  
        'pop_platform_options',               // The page on which this option will be displayed  
        'platform_general_settings_section',  // The name of the section to which this field belongs  
        array(                                // The array of arguments to pass to the callback. In this case, just a description.  
            'Hides the home page link to the platform.'
        )
    );
    add_settings_field(  
        'platform_cache',                         
        'Enable Caching',                         
        'platform_setting_cache_callback',        
        'pop_platform_options',                   
        'platform_general_settings_section',             
        array(                                  
            'Caching will reduce the number of Salesforce API requests by storing data locally.'
        )
    );  
    add_settings_field(  
        'platform_errors',                         
        'Display Errors',                         
        'platform_setting_errors_callback',        
        'pop_platform_options',                   
        'platform_general_settings_section',             
        array(                                  
            'Show error messages on the platform error page. Turn on for debugging.'
        )
    );
    add_settings_field(  
        'platform_sf_un',                        
        'Salesforce Username',                   
        'platform_setting_sf_un_callback',        
        'pop_platform_options',                   
        'platform_general_settings_section',      
        array(                                    
            ''
        )
    );
    add_settings_field(  
        'platform_sf_pw',                         
        'Salesforce Password',                   
        'platform_setting_sf_pw_callback',       
        'pop_platform_options',                 
        'platform_general_settings_section',    
        array(                                  
            ''
        )
    ); 
    add_settings_field(  
        'platform_sf_api',                      
        'Salesforce API Token',                
        'platform_setting_sf_api_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',    
        array(                                  
            ''
        )
    );  
    add_settings_field(  
        'platform_email_invite',                       
        'Email Invite Copy',                 
        'platform_setting_email_invite_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',   
        array(                              
            '<br/>The body of the email invitation that is sent a new group ember. Use codewords |activationlink| and |groupname|.'
        )
    );
    add_settings_field(  
        'platform_email_welcome',                       
        'Email Welcome Copy',                 
        'platform_setting_email_welcome_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',   
        array(                              
            '<br/>The body of the email invitation that is sent a new group member. Use codeword |welcomelink|.'
        )
    );
    add_settings_field(  
        'platform_fundraiser_notify',                       
        'Fundraiser Notification Copy',                 
        'platform_setting_fundraiser_notify_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',   
        array(                              
            '<br/>The body of the email notification that is sent to a fundraiser when a donation is received. Use codewords |profilelink| and |fundraisername|.'
        )
    );    
    add_settings_field(  
        'platform_fundraiser_copy',                       
        'Campaign Default Description',                 
        'platform_setting_fundraiser_copy_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',   
        array(                              
            '<br/>The description copy suggested to the user when creating a campaign.'
        )
    );      
    add_settings_field(  
        'platform_group_copy',                       
        'Group Default Description',                 
        'platform_setting_group_copy_callback',     
        'pop_platform_options',                 
        'platform_general_settings_section',   
        array(                              
            '<br/>The description copy suggested to the user when creating a group.'
        )
    );    
    // Finally, we register the fields with WordPress  
    register_setting(  
        'pop_platform_options',  
        'pop_platform_options'  
    );     
} // end sandbox_initialize_theme_options  
add_action('admin_init', 'platform_initialize_options');  
  
/* ------------------------------------------------------------------------ * 
 * Section Callbacks 
 * ------------------------------------------------------------------------ */   
function platform_general_options_callback() {  
    echo '<p></p>';  
} // end sandbox_general_options_callback  
  
/* ------------------------------------------------------------------------ * 
 * Field Callbacks 
 * ------------------------------------------------------------------------ */   

function platform_setting_enable_callback($args) {  
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="checkbox" id="platform_show" name="pop_platform_options[platform_show]" value="1" ' . checked(1, $options['platform_show'], false) . '/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="add_settings_field"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_cache_callback($args) {  
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="checkbox" id="platform_cache" name="pop_platform_options[platform_cache]" value="1" ' . checked(1, $options['platform_cache'], false) . '/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_cache"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_errors_callback($args) {  
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="checkbox" id="platform_errors" name="pop_platform_options[platform_errors]" value="1" ' . checked(1, $options['platform_errors'], false) . '/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_errors"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_sf_un_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="text" style="width:400px;" id="platform_sf_un" name="pop_platform_options[platform_sf_un]" value="' . $options['platform_sf_un'] . '"/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_sf_un"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_sf_pw_callback($args) {
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="password" style="width:400px;" id="platform_sf_pw" name="pop_platform_options[platform_sf_pw]" value="' . $options['platform_sf_pw'] . '"/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_sf_pw"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_sf_api_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<input type="password" style="width:400px;" id="platform_sf_api" name="pop_platform_options[platform_sf_api]" value="' . $options['platform_sf_api'] . '"/>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_sf_api"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_email_invite_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<textarea style="width:600px; height:200px" id="platform_email_invite" name="pop_platform_options[platform_email_invite]">' . $options['platform_email_invite'] . '</textarea>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_email_invite"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_fundraiser_notify_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<textarea style="width:600px; height:200px" id="platform_fundraiser_notify" name="pop_platform_options[platform_fundraiser_notify]">' . $options['platform_fundraiser_notify'] . '</textarea>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_fundraiser_notify"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_email_welcome_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<textarea style="width:600px; height:200px" id="platform_email_welcome" name="pop_platform_options[platform_email_welcome]">' . $options['platform_email_welcome'] . '</textarea>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_email_welcome"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function platform_setting_fundraiser_copy_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<textarea style="width:600px; height:200px" id="platform_fundraiser_copy" name="pop_platform_options[platform_fundraiser_copy]">' . $options['platform_fundraiser_copy'] . '</textarea>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_fundraiser_copy"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 


function platform_setting_group_copy_callback($args) { 
    $options = get_option('pop_platform_options');
    // Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field  
    $html = '<textarea style="width:600px; height:200px" id="platform_group_copy" name="pop_platform_options[platform_group_copy]">' . $options['platform_group_copy'] . '</textarea>';   
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="platform_group_copy"> '  . $args[0] . '</label>';  
    echo $html; 
} // end sandbox_toggle_header_callback 

function pop_platform_options_menu() { 
    add_options_page(  
        'PoP Platform',           // The title to be displayed in the browser window for this page.  
        'PoP Platform',           // The text to be displayed for this menu item  
        'administrator',            // Which type of users can see this menu item  
        'pop_platform_options',   // The unique ID - that is, the slug - for this menu item  
        'pop_platform_display'    // The name of the function to call when rendering the page for this menu  
    );  
} // end sandbox_example_theme_menu  
add_action('admin_menu', 'pop_platform_options_menu');  
  
/** 
 * Renders a simple page to display for the theme menu defined above. 
 */  
function pop_platform_display() {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<!-- Add the icon to the page -->
		<div id="icon-themes" class="icon32"></div>
		<h2>PoP Platform Options</h2>
		<!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
		<?php settings_errors(); ?>
		<!-- Create the form that will be used to render our options -->
		<form method="post" action="options.php"> 
                      <?php settings_fields( 'pop_platform_options' ); ?>  
                      <?php do_settings_sections( 'pop_platform_options' ); ?>  
                      <?php submit_button(); ?>  
		</form>
	</div><!-- /.wrap -->
<?php
} // end sandbox_theme_display
?>
