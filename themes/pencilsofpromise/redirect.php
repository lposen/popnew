<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Redirect
*/
?>

<?php
global $post; // < -- globalize, just in case
$field = get_post_meta($post->ID, 'redirect', true);
if($field) wp_redirect(clean_url($field), 301);
get_header();


/* Add new Page with Redirect.php as Template. Then, click the Add Custom Field button, type in the word 'redirect', and in the second box with the URL. */

?>
<?php get_footer(); ?>