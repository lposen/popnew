<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Blog
*/
?>
<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='21145547-3',d=document,l=d.location,c=d.cookie;
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

<div id="whoweare">
	<div id="ourblog">
            <?php global $more;    // Declare global $more (before the loop). ?>
            <?php query_posts('&cat=-148&posts_per_page=4&paged='.$paged); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>">
				<?php the_post_thumbnail(); ?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span><strong><?php the_author_link(); ?></strong> <span class="date"><?php the_time('F jS, Y'); ?></span></span>
				<?php 
                                $more = 0;       // Set (inside the loop) to display content above the more tag.
                                the_content('read more...'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
              
				<?php /*<div class="entry-footer">
					<a class="gotoLink" href="<?php the_permalink(); ?>">Read more</a>
				</div>*/ ?>
			</div>
			<hr class="post-divider" />
		<?php endwhile; ?>
			<div id="pagination">
				<div class="readmore pagelonger goright"><?php previous_posts_link('Newer Articles'); ?></div>
				<div class="readmore pagelonger goleft"><?php next_posts_link('Older Articles'); ?></div>
			</div>
		<?php endif; ?>
	</div>
    
</div>

<?php get_footer(); ?>