<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
	
	<div id="home">	
		<div id="featurebox" class="featureSlider anythingSlider">
			<div class="wrapper" style="overflow: hidden;">
				<ul>
					
					<?php
					$features = new Pod('homepage_features');
					$features->findRecords('displayorder ASC');

					if ($features->getTotalRows() > 0) {
						while ($features->fetchRecord()) {
							$feature_name		= $features->get_field('name');
							$feature_image		= $features->get_field('image');
							$feature_copy		= $features->get_field('copy');
							
							$feature_url_page = $features->get_field('link_page');
							if (!empty($feature_url_page)) $feature_url_page = get_permalink($feature_url_page[0]['ID']);
							
							$feature_url_post = $features->get_field('link_post');
							if (!empty($feature_url_post)) $feature_url_post = get_permalink($feature_url_post[0]['ID']);
							
							$feature_url_cust 	= $features->get_field('link_custom');

							// data cleanup
							$feature_image			= $feature_image[0]['guid'];
							$feature_final_link 	= $feature_url_cust;
							
							if (!empty($feature_url_post)) $feature_final_link = $feature_url_post;
							if (!empty($feature_url_page)) $feature_final_link	= $feature_url_page;
							?>
							<li>
								<a href="<?php echo $feature_final_link; ?>" class="feature">
									<img src="<?php echo $feature_image; ?>" alt="" />
									<?php if ($feature_copy != "") { ?>
									<div class="blanker">
										<h2><?php echo $feature_name; ?></h2>
										<p><?php echo $feature_copy; ?></p>
									</div>
									<?php } ?>
								</a>
							</li>
						<?php }
					} ?>
					<li class="default">
						<img src="<?php bloginfo('template_directory'); ?>/gfx/featureDefault.jpg" class="bg img0" style="display:block;" alt="" />
						<img src="<?php bloginfo('template_directory'); ?>/gfx/featureImage2.jpg" class="bg img51" style="display:none;" alt="" />
						<img src="<?php bloginfo('template_directory'); ?>/gfx/featureImage3.jpg" class="bg img49" style="display:none;" alt="" />
						<div class="blanker">
							<span class="show51"></span>
							<span class="show49"></span>
						</div>
					</li>
				</ul>
			</div>
		</div>
        
        <!-- AddThis Button BEGIN -->
			<!-- AddThis Button Begin -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url='http://staging.pencilsofpromise.org' addthis:title='Pencils of Promise' >
                            <div style="display:inline; float:left; width:70px; overflow:hidden; padding-right:10px;"><g:plusone href="http://www.pencilsofpromise.org/" size="medium"></g:plusone></div>
                            <iframe allowtransparency="true" frameborder="0" scrolling="no"
				        src="http://platform.twitter.com/widgets/tweet_button.html?related=pencilsofpromis&amp;url=http://www.pencilsofpromise.org"
				        style="width:115px; height:21px; float: left"></iframe>
            </div>
		<!-- AddThis Button END -->
        
		<div id="ticker">
			<span>PoP NEWS</span>
			<ul class="ticker">
				<?php
				$announcements = new Pod('homepage_ticker');
				$announcements->findRecords('displayorder ASC');
				$total_announcements = $announcements->getTotalRows();

				if ($total_announcements>0) :
					while ($announcements->fetchRecord()) :
						$announcement_text	= $announcements->get_field('name');
						$announcement_link	= $announcements->get_field('link');
						
						if ($announcement_link != "") {
							echo '<li><a href="'. $announcement_link .'">'.$announcement_text.'</a></li>';
						} else {
							echo '<li>'.$announcement_text.'</li>';
						}
					endwhile;
				endif; ?>
			</ul>
		</div>
                               
                <div class="hometouts-large">
			<?php
			$touts = new Pod('home_tout_feature');
			$touts->findRecords($orderby='t.displayorder ASC', $rows_per_page=1);
			$total_touts = $touts->getTotalRows();
			if ($total_touts>0) :
				$i = 1;
				while ($touts->fetchRecord()) :
					$tout_image= $touts->get_field('image');
					$tout_link= $touts->get_field('link');
                                        $tout_text= $touts->get_field('text');
                                        $tout_image= $tout_image[0]['guid'];
					?>
                                    <div id="tout1" style="background: url('<?php echo $tout_image; ?>') no-repeat;" onclick="location.href='<?php echo $tout_link; ?>'">
                                        <a href="<?php echo $tout_link; ?>">
                                            <span class="text">WE'VE COMPLETED <?php echo countProjects("Completed Schools", false); ?> SCHOOLS!</span>  
                                        </a>
                                    </div>
					<?php
					$i++;
				endwhile;
			endif; ?>                    
			<?php
			$touts = new Pod('home_tout_action');
			$touts->findRecords($orderby='t.displayorder ASC', $rows_per_page=1);
			$total_touts = $touts->getTotalRows();
			if ($total_touts>0) :
				$i = 1;
				while ($touts->fetchRecord()) :
					$tout_image= $touts->get_field('image');
					$tout_link= $touts->get_field('link');
                                        $tout_text= $touts->get_field('text');
                                        $tout_image= $tout_image[0]['guid'];
					?>
                                    <div id="tout2" style="background: url('<?php echo $tout_image; ?>') no-repeat;" onclick="location.href='<?php echo $tout_link; ?>'">
                                        <a href="<?php echo $tout_link; ?>">
                                            <span class="text"><?php echo $tout_text; ?></span> 
                                        </a>
                                    </div>
					<?php
					$i++;
				endwhile;
			endif; ?>                    
 
                </div>
                <div class="hometouts-subhead">&nbsp;</div>
                <div class="hometouts-why">      
                    <a href="<?php bloginfo('url'); ?>/join-the-movement/donate">
                        <span class="why-top" style="width:160px;">$25</span>
                        <span class="why-mid" style="width:140px;">Educates one child for one year</span>
                        <span class="why-bot" style="width:80px;">DONATE</span>
                    </a>
                    <a href="<?php bloginfo('url'); ?>/donate">    
                        <span class="why-top" style="width:160px;">100%</span>
                        <span class="why-mid" style="width:240px;">of online donations go directly towards educational programs</span>
                        <span class="why-bot" style="width:110px;">LEARN MORE</span>                       
                    </a>                       
                    <a href="<?php bloginfo('url'); ?>/fundraise">   
                        <span class="why-top" style="width:160px;">$10K</span>
                        <span class="why-mid" style="width:230px;">Builds a new school classroom</span>
                        <span class="why-bot" style="width:100px;">FUNDRAISE</span>                       
                    </a>  
                </div>
        <div class="clearfix"></div>
	<h2 id="progress-header">Our progress so far</h2>
	<div id="progress">
		<div class="progress-cont" style="margin: 0">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweareImage1.png" alt="" />
		</div>
		<div class="progress-cont">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweareImage2.png" alt="" />
		</div>
		<div id="progress-promotion">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweareImage3.png" alt="" />
		</div>
	</div>                
                <script>
                    $(document).ready(function() {
                        $('.hometouts-why a').mouseover(function() {
                            $(this).find('.why-bot').css('color','#f5b000');
                        });
                        $('.hometouts-why a').mouseout(function() {
                            $(this).find('.why-bot').css('color','#454545');
                        });
                    });
                    $(document).ready(function() {
                        $('.hometouts-large #tout2').mouseover(function() {
                            $(this).find('a span').css('border-color','#f5b000');
                        });
                        $('.hometouts-large #tout2').mouseout(function() {
                            $(this).find('a span').css('border-color','#565656');
                        });
                    });
                    $(document).ready(function() {
                        $('.hometouts-large #tout1').mouseover(function() {
                            $(this).find('a span').css('border-color','#f5b000');
                        });
                        $('.hometouts-large #tout1').mouseout(function() {
                            $(this).find('a span').css('border-color','#565656');
                        });
                    });                    
                </script>
	</div>
<?php get_footer(); ?>
