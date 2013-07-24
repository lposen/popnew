<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Partners
*/
?>

<?php get_header(); ?>

<div id="subpage-sidebar">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="introduction">
                        <img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurPartners.png">
        </div>  
        <div id="subpage-content">
		<div id="main-column">

        <div style="clear:both;"></div>                     
                    <?php the_content(); ?>        
                <div id="press-links">
	<?php
		$links = pods('logo_link');
		$links->find('display_order ASC', -1, '');
		$links_total = $links->total_found();
		$i = 1;
                $script = '<script>$(document).ready(function() {';
		
		if($links_total > 0) : 
			while($links->fetch()) :
				$name = $links->display('name');
				$link = $links->display('link');
                $page = $links->display('page');
				$image_raw = $links->display('logo');
                $tooltip = $links->display('tooltip');
                if ($page == 'corporate') {
                                    if ($i<4) {
				?>
                                    <?php /* <div id="tooltip<?php echo $i ?>" class="tooltip"><?php echo $tooltip; ?></div> */ ?>
                                    <div class="press-link-featured" id="pressfeatured<?php echo $i ?>" style="background:url(<?php echo $links->display('logo'); ?>) no-repeat center">
						<a href="<?php echo $link; ?>" ></a>
                                    </div>
                                <?php
                                    $script.='$("#pressfeatured'.$i.'").tooltip({tip: \'#tooltip'.$i.'\',position: \'center right\',offset: [-50,-30],delay: 0});';
                                    } else {
				?>
                                    <div class="press-link" style="background:url(<?php echo $links->display('logo'); ?>) no-repeat center">
						<a href="<?php echo $link; ?>" ></a>
                                    </div>
                                <?php                 
                                } 
                                }
                                ?>
			<?php endwhile; endif; ?>
                        <?php
                             $script.='});</script>';
                             echo $script;
                         ?>
 
                </div>               
                    
		</div>    
		<div id="aside">
                            <a href="<?php bloginfo('url'); ?>/donate/corporate"><img src="<?php bloginfo('template_directory'); ?>/gfx/tout-corporate-partner.png"/></a>
		</div>
	</div>
    
        <?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>