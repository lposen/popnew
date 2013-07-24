<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 Template Name: Campaign
 */

get_header( 'buddypress' ); ?>
	<div id="content">
          <div class="padder">
     <?php echo bp_is_my_profile();
	?>
        <div>
        <ul>
        	<li>Progress Bar: <?php echo do_shortcode("[pfund-progress-bar]"); ?></li>
            <li>Campaign List: <?php echo do_shortcode("[pfund-campaign-list]"); ?></li>
            <li>Campaign Permalink: <?php echo do_shortcode("[pfund-campaign-permalink]"); ?></li>
            <li>Cause List: <?php echo do_shortcode("[pfund-cause-list]"); ?></li>
            <li>Comments: <?php echo do_shortcode("[pfund-comments]"); ?></li>
            <li>Donate: <?php //echo do_shortcode("[pfund-donate]"); ?></li>
            <li>Edit: <?php echo do_shortcode("[pfund-edit]"); ?></li>
            <li>Title: <?php echo do_shortcode("[pfund-camp-title]"); ?></li>
            <li>Days Left: <?php echo do_shortcode("[pfund-days-left]"); ?></li>
            <li>Gift Goal: <?php echo do_shortcode("[pfund-gift-goal]"); ?></li>
            <li>Gift Tally: <?php echo do_shortcode("[pfund-gift-tally]"); ?></li>
            <li>Giver List: <?php echo do_shortcode("[pfund-giver-list]"); ?></li>
            <li>Giver Tally: <?php echo do_shortcode("[pfund-giver-tally]"); ?></li>
            <li>User Avatar: <?php echo do_shortcode("[pfund-user-avatar]"); ?></li>
        </ul>
        </div>
         </div><!-- .padder -->
     </div><!-- #content -->
<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>