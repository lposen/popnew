<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<div id="twocol-sidebar">
<?php if(is_author() || is_search()) : ?>
	<div class="sidebar-box">
		<div class="sidebar-box-cont">
		<div class="paperclip"></div>
		<h2>Latest Articles</h2>
			<ul>
				<?php
					$popular = new WP_Query();
				    $popular->query('posts_per_page=10&cat=-148');
					$i = 1;
					if ($popular->have_posts()): while ($popular->have_posts()): $popular->the_post();
					?>
					<li class="<?php if($i%2 == 0) echo 'odd'; ?>">
						<a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
						<?php //echo the_excerpt(); ?>
					</li>
				<?php $i++; endwhile; endif; ?>
			</ul>
		</div>
	</div>
<?php elseif(!is_single()) : ?>
	<div class="sidebar-box">
		<div class="sidebar-box-cont">
			<div class="paperclip"></div>
			<h2>More PoP Authors</h2>
			<?php
				$categories = get_the_category();
				$cat_id = $categories[0]->cat_ID;
			?>
			<ul>
				<li><strong><a href="/blog/author/adam">Adam Braun</a></strong></li>
				<?php
					$data = array(
						'optioncount' => false,
						'exclude_admin' => false,
						'show_fullname' => false,
						'hide_empty' => true,
						'echo' => false,
						'feed' => '',
						'feed_image' => '',
						'style' => none,
						'html' => ''
					);
					$authors_arr = explode(',', wp_list_authors($data));
					$i = 1;
					foreach($authors_arr as $author) :
						$info = get_userdatabylogin($author);
						$user_id = $info->ID;
						$user_descc = $info->user_description;
						$user_name = $info->user_login;
						$user_full_name = $info->first_name . ' ' . $info->last_name;
						$user_title = get_user_meta($user_id, 'userTitle', true);
						if ($user_title != '' && $user_id != 1 && $user_id != 61 && $i < 10) :
						?>
						<li class="<?php if($i%2 != 0) echo 'odd'; ?>">
							<strong><a href="/blog/author/<?php echo $user_name; ?>"><?php echo $user_full_name; ?></a></strong>
						</li>
				<?php $i++; endif; endforeach; ?>
				<a class="viewall-authors" style="margin-right: 10px; width: 140px;" href="<?php bloginfo('url'); ?>/who-we-are/our-people/">Back to Our People</a>
			</ul>
		</div>
	</div>
	<div class="sidebar-box">
		<div class="sidebar-box-cont">
		<div class="paperclip"></div>
		<h2 class="dark">Popular Articles</h2>
			<ul>
				<?php
					$popular = new WP_Query();
				    $popular->query('posts_per_page=5&orderby=comment_count&order=ASC');
					$i = 1;
					if ($popular->have_posts()): while ($popular->have_posts()): $popular->the_post();
					?>
					<li class="<?php if($i%2 == 0) echo 'odd'; ?>">
						<a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
						<?php //echo the_excerpt(); ?>
					</li>
				<?php $i++; endwhile; endif; ?>
			</ul>
		</div>
	</div>
<?php else : ?>
	<div class="sidebar-box">
		<div class="sidebar-box-cont">
		<div class="paperclip"></div>
		<h2>Latest Articles</h2>
			<ul>
				<?php
					$popular = new WP_Query();
				    $popular->query('posts_per_page=10&cat=-148');
					$i = 1;
					if ($popular->have_posts()): while ($popular->have_posts()): $popular->the_post();
					?>
					<li class="<?php if($i%2 == 0) echo 'odd'; ?>">
						<a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
						<?php //echo the_excerpt(); ?>
					</li>
				<?php $i++; endwhile; endif; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>

</div>