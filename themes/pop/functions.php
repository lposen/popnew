<?php
add_filter( 'page_template', 'pfund_custom_page_template' );
function pfund_custom_page_template($current_template) {
    global $post;
    if ( $post && $post->post_type == 'pfund_campaign' ) {
        return locate_template( 'campaign-template.php' );
    } elseif  ( $post && $post->post_type == 'pfund_cause' ) {
        return locate_template( 'cause-template.php' );
    } else{
        return $current_template;
    }
};
add_theme_support( 'buddypress' );

?>