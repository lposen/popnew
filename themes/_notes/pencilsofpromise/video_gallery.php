<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Video Gallery
*/
?>

<?php get_header(); ?>

<div id="subpage">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="introduction">
                        <img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerVideo.png">
        </div>  
        <div id="subpage-content">
		<div id="main-column">

        <div style="clear:both;"></div>                     
                    <?php the_content(); ?>        
                <div id="video-links">
	<?php
		$links = new Pod('video');
		$links->findRecords('display_order ASC', -1, '');
		$links_total = $links->getTotalRows();
		$i = 1;
                
		if($links_total > 0) : 
			while($links->fetchRecord()) :
				$name = $links->get_field('name');
				$video = $links->get_field('you_tube_id');
				$image_raw = $links->get_field('thumb');
                                $image = $image_raw[0]['guid'];
				?>
                                    <div class="video-link" id="productfeatured<?php echo $i ?>" style="background:url(http://img.youtube.com/vi/<?php echo $video; ?>/0.jpg) no-repeat center">
						<a class="video-tout" href="http://www.youtube.com/embed/<?php echo $video ?>?autoplay=1"></a>
                                    </div>   
                    
                                    <?php $i++; ?> 
                                                                          

			<?php endwhile; endif; ?>

                </div>      
        
		</div>    
	</div>
    
        <?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>