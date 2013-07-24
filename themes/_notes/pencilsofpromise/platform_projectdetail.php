<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Project Detail
*/
?>

<?php get_header(); ?>

<div id="projects" class="detail">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$percent_raw = simple_fields_get_post_value(get_the_id(), array(1, 1), true);
		$percent     = ($percent_raw == '') ? '0%' : $percent_raw."%";
	?>
		<div id="subheader" class="paper" style="height: 260px; ">
		<div id="below">
			<div id="last-step-extra">No project is ever complete. We continue to support each of our schools to ensure sustainable education for generations to come.</div>
			<div id="barometer">
				<!-- Markers -->
				<div class="pmark project-desc d-1">Engage the community</div>
				<div class="pmark project-desc d-2">Sign "The Promise"</div>
				<div class="pmark project-desc d-3">Break Ground</div>
				<div class="pmark project-desc d-4">Handover Ownership</div>
				<div class="pmark project-desc d-5"><img src="<?php bloginfo('template_directory'); ?>/gfx/pageProjectsBarometerIcon.png" alt="Sustain and Support" />Sustain and Support</div>
				<!-- End markers -->
				<div id="project-progress">
					<span class="fancy-serif"><?php echo $percent; ?></span>
					<p>Towards our<br/> goal of building sustainable education for<br/> this village</p>
				</div>
				<div id="project-bulb"></div>
				<div id="barometer-cont">
					<div id="barometer-inside" style="width: <?php echo $percent; ?>;"></div>
				</div>
                                
			</div>
                        <?php
                              $country =  simple_fields_get_post_value(get_the_id(), array(1, 6), true);
                              $category = get_the_title( $post->post_parent );
                              $supportQueryString='country='.strtolower($country).'&type='.strtolower($category);
                              
                        ?>
                        <a href="/fundraise/manage?<?php echo $supportQueryString; ?>">Support Projects Like This</a>
		</div>
		</div>
		<div id="project-info">
		<div id="thumb"><?php the_post_thumbnail(); ?></div>
		<h2><?php the_title(); ?><span> (<?php echo simple_fields_get_post_value(get_the_id(), array(1, 6), true); ?>)</span></h2>
		<p class="subtitle"><?php echo simple_fields_get_post_value(get_the_id(), array(1, 9), true); ?></p>           
		
<?php
			$students    = simple_fields_get_post_value(get_the_id(), array(1, 7), true);
			$population  = simple_fields_get_post_value(get_the_id(), array(1, 8), true);
			$photosynth  = simple_fields_get_post_value(get_the_id(), array(1, 2), true);
			$googleMaps  = simple_fields_get_post_value(get_the_id(), array(1, 11), true);
			$flickrURL	 = simple_fields_get_post_value(get_the_id(), array(1, 4), true);
			$vimeoURL	 = simple_fields_get_post_value(get_the_id(), array(1, 5), true);
			require_once($_SERVER['DOCUMENT_ROOT'].'/libs/simplepie/simplepie.inc');
			
			if($students != '' && $population != '') : 
			?>
				<div id="project-quick-stats">
					<?php 
						if($students != '') echo 'Number of Students <span>' . $students . '</span>';
					 	if($population != '') echo 'Village Population <span>' . $population . '</span>';
					 ?>
				</div>
		<?php endif; ?>
		<?php 
			the_content(); 
			
			if($photosynth != '') { ?>
				<a href="<?php echo $photosynth; ?>" class="project-extras" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/gfx/projectsPhotos.png" alt="Photo-synth" /></a>
			<?php } 
			if($googleMaps != '') { ?>
				<a href="http://maps.google.com/?ll=<?php echo $googleMaps; ?>" class="project-extras" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/gfx/projectsMap.png" alt="View map" /></a>
			<?php }
				
	endwhile; endif; ?>
	</div>
	<div id="news">
		<h2 class="project-title">Project News</h2>
		<?php
			$temp = $wp_query;
			$wp_query = null;
			$wp_query = new WP_Query();
			$wp_query->query('category_name='.get_the_title().'&posts_per_page=5&paged='.$paged);
		?>

		<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<div class="pentry">
			<?php the_post_thumbnail(); ?>
			<h2><?php the_title(); ?></h2>
				<span><strong>Written by: <?php the_author_posts_link(); ?></strong>  <span class="date"><?php the_time('F jS, Y'); ?></span></span>
			<p><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="gotoLink">Read More</a>
			<div class="clearfix"></div>
		</div>
		<hr class="post-divider" />
		<?php endwhile; ?>
			<div id="pagination">
				<div class="readmore pagelonger goleft"><?php previous_posts_link('Newer Articles'); ?></div>
				<div class="readmore pagelonger goright"><?php next_posts_link('Older Articles'); ?></div>
			</div>
			<?php $wp_query = null; $wp_query = $temp;?>
		<?php else: ?>
			<p style="padding: 20px;">There's no related news for this project at this time. Please check back later!</p>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
	<div id="aside">
		<?php if (!empty($flickrURL)) { ?>
		<div class="media">
			<h3>Latest Photos</h3>
			<div class="media-content flickr">
				<ul>
					<?php
					$flickrURL = str_replace("&lang=en-us", "", $flickrURL);
					$feed = new SimplePie();
					$feed->set_feed_url($flickrURL);
					$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'].'/libs/simplepie/cache');
					$feed->init();
					$feed->handle_content_type();

					if ($feed->error()) {
						//echo $feed->error();
					}
				
					foreach ($feed->get_items() as $item):
						if ($enclosure = $item->get_enclosure()) { ?>
							<li><a href="<?php echo $item->get_link(); ?>" target="_blank">
								<?php
								$img = image_from_description($item->get_description());  
					            $thumb_url = select_image($img, 0);  
					            echo '<img src="' . $thumb_url . '" />'."\n";
								?>
							</a></li>
						<?php }
					endforeach;
					?>
				</ul>
				<a href="<?php echo $feed->get_link(); ?>" class="viewall-authors" target="_blank">View All</a>
				<?php
				$feed->__destruct();
				unset($feed);
				?>
			</div>
		</div>
		<?php } ?>
	
		<?php
		if (!empty($vimeoURL)) { ?>
		<div class="media">
			<h3>Latest Videos</h3>
			<div class="media-content vimeo">
				<ul>
					<?php
					$feed = new SimplePie();
					$feed->set_feed_url($vimeoURL);
					$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'].'/libs/simplepie/cache');
					$feed->init();
					$feed->handle_content_type();
				
					foreach ($feed->get_items() as $item) {
						$media_group = $item->get_item_tags('http://search.yahoo.com/mrss/', 'content');
						$media_content = $media_group[0]['child']['http://search.yahoo.com/mrss/']['thumbnail'];
						$thumbnail = $media_content[0]['attribs']['']['url'];
						echo '<li><a href="' . $item->get_link() . '" target="_blank"><img src="'.$thumbnail.'" alt="' . $item->get_title() . '" /></a></li>';
					}
					?>
				</ul>
				<a href="<?php echo $feed->get_link(); ?>" class="viewall-authors" target="_blank">View All</a>
				<?php
				$feed->__destruct();
				unset($feed);
				?>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="clearfix"></div>
</div>

<?php get_footer(); ?>
