</div><!-- #primary -->
<?php if ( bp_is_register_page() ) : ?>
<script type="text/javascript">// <![CDATA[
        jQuery(document).ready( function() {
            if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
                jQuery('div#blog-details').toggle();
            jQuery( 'input#signup_with_blog' ).click( function() {
                jQuery('div#blog-details').fadeOut().toggle();
            });
        });
 
// ]]></script>
<?php endif; ?>
<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>