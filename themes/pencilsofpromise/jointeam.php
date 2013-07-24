<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Join the Team
*/
?>

<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='21145547-13',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->


<?php get_header(); ?>

<div id="movement">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" class="join" style="background: url('<?php echo $thumb[0]; ?>');">
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	<div id="join-content">
		<div id="join-form">
			<div id="subheader" class="paper team">
				<h2>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/joinTeamTitle.png" alt="Join the team" />
					<span></span>
				</h2>
			</div>
			<?php gravity_form(12, false, false); ?>
		</div>
		<div id="aside">
			<?php
			global $wp_query;
			$post_id = $wp_query->post->ID;
			$banners = simple_fields_get_post_group_values($post_id, 5, false, 2);
			//echo print_r($banners);
			foreach ($banners as $banner) {
				echo '<a href="'.$banner[2].'">'. wp_get_attachment_image($banner[1], "full") .'</a>';
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>