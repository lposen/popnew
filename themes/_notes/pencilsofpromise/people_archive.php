<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Former Team Members
*/
?>

<?php get_header(); ?>
<div id="ourpeople">
    
<div id="introduction">
		<img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurPeople.png">
</div>    
<div class="headercufon">
	<h3>PoP Alums</h3>
</div>   
 
	<div id="alumleadershipteam">     
		<?php
                $mimiID = 147;
                $mimi = get_userdata($mimiID); ?>
            
					<div class="member">
						<div class="avatar medium"><?php echo get_avatar($mimiID, 130); ?></div>
						<h3>Mimi Nguyen</h3>
						<h4>Founding COO</h4>
						<p><?php echo truncate($mimi->description, 3000); ?></p>
                                                <div class="clearLink"><a href="http://www.about.me/mimitoday" class="gotoLink">Read more about Mimi</a></div>
					</div>          
	</div>
    
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="popstars">
	<?php
        
        
        
		$data = array(
			'hide_empty' => false,
			'echo' => false,
			'style' => none
		);
		$authors_arr = explode(',', wp_list_authors($data));
		foreach($authors_arr as $author) {
			$info					= get_userdatabylogin($author);
			$user_id				= $info->ID;
			$user_desc			= truncate($info->user_description, 200);
			$user_name			= $info->user_login;
			$user_avatar		= get_avatar($user_id, 130);
			$user_title 		= get_user_meta($user_id, 'userTitle', true);
			$user_link 			= get_user_meta($user_id, 'userRelatedLink', true);
			$user_full_name	= $info->first_name . ' ' . $info->last_name;
			
			if ($user_title != "hidden" && $user_title == "former") {
				echo '<div class="member">';
				if (!empty($user_link)) echo '<a href="'. $user_link .'">';
				echo '<div class="avatar medium">' . $user_avatar . '</div>
						<p class="alumname">' . $user_full_name . '</p>';
				if (!empty($user_link)) echo '</a>';
				echo '</div>';
			}
                        }
	?>
			</div>
	<?php endwhile; endif; 	?>
</div>

<?php get_footer(); ?>