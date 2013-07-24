<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Season of 1000 Promises
*/
get_header(); ?>
	<div id="season1000">
		<div id="sIntro">
			<p>Help us catch 1,000 Promises this holiday season! 1 Promise = $10/month = 1 year of a child's education.</p>
		</div>
		<div id="sThanks" style="display: none;">
			<p>Thank You For Your Promise.<br/>Would you like to help us spread the word and Tweet your promise as well?</p>
			<span id="sThanksNo" class="sButton">No</span><span id="sThanksYes" class="sButton">Yes</span>
		</div>
		<div id="sVideo">
			<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, "vimeo_video_id", true); ?>?color=eeab00" width="764" height="430" frameborder="0" id="sVimeo"></iframe>
			<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.pencilsofpromise.org%2Fpromises&amp;layout=standard&amp;show_faces=true&amp;width=764&amp;action=like&amp;font=verdana&amp;colorscheme=dark&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:764px; height:80px;" allowTransparency="true"></iframe>
		</div>
		<div id="sOptions">
			<a href="/join-the-movement/donate/?recurring=monthly" id="sDonor">Become a Monthly Donor</a>
			<p class="first">This Holiday Season, give the gift of a Promise. Empower children in the developing world through education, and inspire those in your community with your own personal act to create local good.</p>
			<p>Are you a young Pencils of Promise supporter? <a href="/blog/featured/season-of-a-1000-promises">Become a Promise Catcher!</a></p>
		</div>
		<hr />
		<div id="sWallEntry">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/season1000/txtThePromiseWall.gif" alt="The Promise Wall" class="sTitle" />
			<p>Here you can publicly share your personal commitment to spread good in your community over the next year. Maybe you want to start a PoP Fundraiser, or maybe you want to begin volunteering in your hometown? Share your promise with the world and join the movement.</p>
			<?php
			$pods = new Pod('season1000');
			$fields = array(
				'name' => array('label' => '', 'default' => 'Your First Name *'),
				'lname' => array('label' => '', 'default' => 'Your Last Name'),
				'email' => array('label' => '', 'default' => 'Your Email *'),
				'promise' => array('label' => '', 'default' => 'Make Your Promise Here *'),
				'zipcode' => array('label' => '', 'default' => 'Your Zipcode'),
				'dobmm', 'dobdd', 'dobyyyy',
				'gender' => array('input_helper' => 'input_select_gender'),
				'optin' => array('label' => 'Yes, I\'d like to receive updates from Pencils of Promise via e-mail.')
			);
			echo $pods->publicForm($fields, '');
			?>
		</div>
		<div id="sWallEntries">
			<?php
			$promises = new Pod('season1000');
			$promises->findRecords('id DESC', 5);
			$total_promises = $promises->getTotalRows();
			?>
			<h2><?php echo number_format($total_promises); ?> <span>Promises Made</span></h2>
			<hr />
			<?php
			if ($total_promises>0) :
				while ($promises->fetchRecord()) :
					$user_name			= $promises->display('name');
					$user_last			= $promises->display('lname');
					$user_email			= $promises->display('email');
					$user_avatar		= get_avatar($user_email, 32);
					$user_promise		= $promises->display('promise');
					
					if (!empty($user_last)) $user_name = $user_name . " " . substr($user_last, 0, 1) . ".";
					?>
					
					<div class="promise">
						<h3><?php echo $user_avatar; ?> <?php echo $user_name; ?></h3>
						<p><?php echo $user_promise; ?></p>
						<hr />
					</div>
					
					<?php
				endwhile;
				
				echo $promises->getPagination();
			endif;
			?>
		</div>
	</div>

<?php get_footer(); ?>
