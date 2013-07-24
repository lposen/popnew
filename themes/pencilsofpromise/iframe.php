<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Iframe Page
*/
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <style>
        <?php echo simple_fields_get_post_value(get_the_id(), 'CSS', true) ?>
    </style>
    <script>
        <?php echo simple_fields_get_post_value(get_the_id(), 'JS', true) ?>       
    </script>    
</head>
<body>
<?php the_content(); ?>
</body>
</html>
<?php endwhile; endif; ?>