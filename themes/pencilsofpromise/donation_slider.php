<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Slider
*/
?>
<?php get_header(); ?>

  <div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_donate_now.jpg');"></div>        
 
  <h2 id="page1-title">In 2009, 7 out of every 8 dollars donated went directly to funding both our domestic and international program services... </h2> 
  <p id="donate-money-desc">In order to provide sustainable education, we need funds to make things happen. If you have the means, we would appreciate any help you can provide. It only takes $0.32 to provide one day of sustainable education to one child. With your help, we can provide a lot more than that.</p> 
  <form action=" " method="post"> 
  <div class="step donation-slider"> 
  <div class="step-number">1.</div> 
  <div class="explanation"> 
  Use the Slider To Select Your Desired Donation Amount. 
  </div> 
  <div class="form-container-nobg">
  
  	<div id="slider-cont">
  		<div id="slider"></div>
  	</div>
  
  </div> 
  </div> 
  <div class="step"> 
  <div class="step-number">2.</div> 
  <div class="explanation"> 
  Which will show you the impact your donation can make. 
  </div> 
  <div class="form-container"> 
  <div class="step-padding"> 
  <div id="change-amount"></div>
  <div id="change-impact"></div>
  <input type="text" name="amount" id="input-amt" /> 
  <span class="amount-copy-provides">enables</span> 
  <input type="text" name="amount" id="input-days" /> 
  <span class="amount-copy-days">Days</span> 
  <span class="amount-copy-extra">of a child's Education</span> 
  <div class="clearfix"></div> 
  </div> 
  </div> 
  </div> 
  	<div class="step">
		<div class="step-number black">
			3.
		</div>
		<div class="explanation black">
			Which projects would you like to receive updates from:
		</div>
		<div class="form-container-nobg">
			<div id="recurring">
				<select name="proj-name" id="input-proj" multiple onchange="" size="1">
					<?php
						global $wp_query, $post;
						$pages_query = new WP_Query();
					    $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
						//$page_id = $post->ID;
						$page_id = 1242;
						$projects = get_page_children($page_id, $all_pages);
						$i = 1;
						foreach($projects as $project) :
						?>
							<option value="<?php echo $project->post_title?>"><?php echo $project->post_title?></option>
						<?php $i++; endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="step">
		<div class="step-number">
			4.
		</div>
		<div class="explanation">
			Increase your impact by making your donation recurring.
		</div>
		<div class="form-container-nobg">
			<div id="recurring">
				I believe in PoP’s sustainability programs and support for students 
				beyond the initial school build are important to me. Please make 
				my ongoing commitment recur<br />
				
				<input type="checkbox" name="recur_type" class="recur_type" value="monthly"> monthly /
				<input type="checkbox" name="recur_type" value="yearly" class="recur_type"> annually
				
			</div>
		</div>
	</div>
  <div class="step"> 
  <div class="step-number">4.</div> 
  <div class="explanation"> 
  Select your payment type to submit your donation. 
  </div> 
  <div class="form-container-nobg"> 
  <div class="payment-type"> 
  <input type="image" src="<?php bloginfo('template_directory'); ?>/gfx/iconPaypal.png" /> 
  </div> 
  <div id="icon-or"></div> 
  <div class="payment-type"> 
  <input type="image" src="<?php bloginfo('template_directory'); ?>/gfx/iconCreditCards.png" /> 
  </div> 
  </div> 
  </div> 
  </form> 

<?php get_footer(); ?>