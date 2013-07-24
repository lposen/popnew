<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our People
*/
?>

<?php get_header(); ?>
<div id="ourpeople">
    
<div id="introduction">
		<img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurPeople.png">
</div>
 	<?php // if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php
	
	$data = array(
		'hide_empty' => false,
		'echo' => false
	);
	
	?>
    
       <?php /*
	<div id="volunteer-spotlight">
		<div id="spotlight-info">
			<?php
			$featured = get_userdata($volunteers[0]);
			$featured_url = get_user_meta($featured->ID, 'userRelatedLink', true);
			?>
			<h3><?php echo $featured->first_name . ' ' . $featured->last_name; ?></h3>
			<p><?php echo truncate($featured->user_description, 500); ?></p>
			<?php if(!empty($featured_url)) { ?> <a href="<?php echo $featured_url; ?>" class="gotoLink">Read more about <?php echo $featured->first_name; ?></a> <?php } ?>
			<div id="spotlight-gallery">
				<ul>
					<?php for($i = 1; $i <= $max; $i++) { 
						$info				= get_userdata($volunteers[$i]);
						$user_desc		= truncate($info->user_description, 200);
						$user_name		= $info->user_login;
						$user_avatar	= get_avatar($info->ID, 57);
						$user_link 		= get_user_meta($info->ID, 'userRelatedLink', true);
						$user_full_name = $info->first_name . ' ' . $info->last_name;
						
						if (!empty($user_link)) echo '<li><a href="'. $user_link .'">'. $user_avatar .'</a></li>';
					} ?>
				</ul>
				<a href="/who-we-are/our-people/pop-stars/" class="gotoLink">View All</a>
			</div>
		</div>
		<div class="avatar large">
			<?php echo get_avatar($volunteers[0], 286) ?>
		</div>
	</div>
        */?>
	<div id="aboutadam">
		<?php $adam = get_userdata($adamID); ?>
		<div class="avatar mediumlarge"><?php echo get_avatar($adamID, 200); ?></div>
		<h3>FOUNDER, CEO</h3>
		<h4>Adam Braun</h4>
		<p><?php echo truncate($adam->description, 3000); ?></p>
                <p><a href="/blog/about-us/about-adam-braun" class="gotoLink">Read more about Adam Braun</a></p>
		<p><a href="/blog/author/adam" class="gotoLink">Read blog posts written by Adam</a></p>
	</div>
	<div class="sectionheader">
		<h2>Leadership Team</h2>
	</div>
	<div id="leadershipteam">
	<?php
		$authors_arr = explode(',', wp_list_authors($data));
		$firstColumn = true;
		$i = 0;
		$current = 0;
		foreach($authors_arr as $author) {
			$info			= get_user_by('login', $author);
			$user_id		= $info->ID;
			$user_desc		= truncate($info->user_description, 200);
			$user_name		= $info->user_login;
			$user_avatar	= get_avatar($user_id, 130);
			$user_title 	= get_user_meta($user_id, 'userTitle', true);
			$user_subtitle	= get_user_meta($user_id, 'userSubtitle', true);
			$user_posts		= count_user_posts($user_id);
			$user_related	= get_user_meta($user_id, 'userRelatedLink', true);
			$user_full_name = $info->first_name . ' ' . $info->last_name;
			
			if ($user_title != "hidden" && $user_title == "leadership" && $user_id != $adamID) {
					if ($firstColumn) echo '<div class="row'.($i%2).'">';
					
					echo '<div class="member">
						<div class="avatar medium">'. $user_avatar .'</div>
						<h3>'. $user_full_name .'</h3>
						<h4>'. $user_subtitle .'</h4>
						<p>'. $user_desc .'</p>';
					if (!empty($user_related)) echo '<div class="clearLink"><a href="'. $user_related .'" class="gotoLink">Read more about ' . $info->first_name . '</a></div>';
					if ($user_posts > 0) echo '<div class="clearLink"><a href="/blog/author/'. $user_name .'" class="gotoLink">View blog posts written by ' . $info->first_name . '</a></div>';
					echo '</div>';
					
					if (!$firstColumn) {
						echo '</div>';
						$i++;
					}
					$firstColumn = !$firstColumn;								
			}
			if ($current == (count($authors_arr)-1) && !$firstColumn) echo '</div>';
			$current++;
		}
	?>
	</div>
	<div class="sectionheader">
		<h2>Staff Members</h2>
	</div>
	<div id="staffmembers">
	<?php
		foreach($authors_arr as $author) {
			$info				= get_user_by('login', $author);
			$user_id			= $info->ID;
			$user_desc		= truncate($info->user_description, 200);
			$user_name		= $info->user_login;
			$user_avatar	= get_avatar($user_id, 130);
			$user_title 	= get_user_meta($user_id, 'userTitle', true);
			$user_subtitle	= get_user_meta($user_id, 'userSubtitle', true);
			$user_full_name = $info->first_name . ' ' . $info->last_name;
			
			if ($user_title != "hidden" && $user_title == "staff" && $user_id != $adamID) {
				echo '<div class="member">
					<div class="avatar medium">' . $user_avatar . '</div>
					<h3>' . $user_full_name . '</h3>
				</div>';
			}
		}
	?>
	</div>
	<div class="sectionheader">
		<h2>Board of Directors</h2>
	</div>
	<div id="boardmembers">
	<?php
		foreach($authors_arr as $author) {
			$info				= get_user_by('login', $author);
			$user_id			= $info->ID;
			$user_desc		= truncate($info->user_description, 200);
			$user_name		= $info->user_login;
			$user_avatar	= get_avatar($user_id, 130);
			$user_title 	= get_user_meta($user_id, 'userTitle', true);
			$user_subtitle	= get_user_meta($user_id, 'userSubtitle', true);
			$user_full_name = $info->first_name . ' ' . $info->last_name;
			
			if ($user_title != "hidden" && $user_title == "board" && $user_id != $adamID) {
				echo '<div class="member">
					<div class="avatar medium">' . $user_avatar . '</div>
					<h3>' . $user_full_name . '</h3>
				</div>';
			}
		}
	?>
	</div>
        <div class="sectionheader">
		<h2>Advisory Board</h2>
	</div>
	<div id="advisoryboard">
	<?php
		foreach($authors_arr as $author) {
			$info				= get_user_by('login', $author);
			$user_id			= $info->ID;
			$user_desc		= truncate($info->user_description, 1000);
			$user_name		= $info->user_login;
			$user_avatar	= get_avatar($user_id, 130);
			$user_title 	= get_user_meta($user_id, 'userTitle', true);
			$user_full_name = $info->first_name . ' ' . $info->last_name;
			if ($user_title != "hidden" && $user_title == "advisory" && $user_id != $adamID) {
				echo '<div class="member">
					<div class="avatar medium">' . $user_avatar . '</div>
					<h3>' . $user_full_name . '</h3>
				</div>';
			}
		}?>
	</div>
     
        <p style="float:right; margin-top:26px; margin-right:10px;"><a href="<?php bloginfo('url'); ?>/who-we-are/our-people/former-team-members/"><b>PoP Alums:</b> Meet all of the past Pencils of Promise team members</a><a class="right-arrow" href="/who-we-are/our-people/former-team-members/"></a></p>
        <p style="float:right; margin-top:26px; margin-right:10px;"><a href="<?php bloginfo('url'); ?>/category/pop-movement/pop-star-of-the-week/"><b>PoP Stars!:</b> Meet the young people who inspire and empower the PoP movement</a><a class="right-arrow" href="/who-we-are/our-people/pop-stars/"></a></p>
	<?php //endwhile; endif; 	?>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>