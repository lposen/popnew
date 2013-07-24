<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
	
	<div id="home">	
		<div id="featurebox">
			<div class="wrapper" style="overflow: hidden;">
				<ul class="featureSlider anythingSlider">
					
					<?php
					$params = array( 
                        'limit'   => -1  // Return all rows 
                    ); 
					$features = pods('homepage_features', $params);
					//$features->find('displayorder ASC');
					if ( 0 < $features->total() ) {
        				while ( $features->fetch() ) {
					
							$feature_name		= $features->display('name');
                            //console.log($feature_name);
							$feature_image		= $features->display('image');
							$feature_copy		= $features->display('name');
							
							$feature_url_page = $features->display('link_page');
							//if (!empty($feature_url_page)) $feature_url_page = get_permalink($feature_url_page->$id);
							
							$feature_url_post = $features->display('link_post');
							//if (!empty($feature_url_post)) $feature_url_post = get_permalink($feature_url_post->$id);
							
							$feature_url_cust 	= $features->display('link_custom');

							// data cleanup
								$feature_image			= $feature_image[1];
							$feature_final_link 	= $feature_url_cust;
							
							if (!empty($feature_url_post)) $feature_final_link = $feature_url_post;
							if (!empty($feature_url_page)) $feature_final_link	= $feature_url_page;
							?>
							<li>
								<a href="<?php echo $feature_url_page; ?>" class="feature">
									<img src="<?php echo $features->display('image'); ?>" alt="" />
									<?php /* if ($feature_copy != "") { ?>
									<div class="blanker">
										<h2><?php echo $features->display('name'); ?></h2>
										<p><?php echo $features->display('copy'); ?></p>
									</div>
									<?php  } */?>
								</a>
							</li>
					<?php }	
					} ?>
				</ul>
			</div>
		</div>
        
        <!-- AddThis Button BEGIN -->
			<!-- AddThis Button Begin -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url='http://www.pencilsofpromise.org' addthis:title='Pencils of Promise' >
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
				$announcements = pods('homepage_ticker');
				$announcements->find('displayorder ASC');
				$total_announcements = $announcements->total_found();

				if ($total_announcements>0) :
					while ($announcements->fetch()) :
						$announcement_text	= $announcements->display('name');
						$announcement_link	= $announcements->display('link');
						
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
            $params = array( 
                        'limit'   => -1  // Return all rows 
                    ); 
			$touts = pods('home_tout_feature', $params);
			$touts->find($orderby='t.displayorder ASC', $rows_per_page=1);
			$total_touts = $touts->total_found();
			if ($total_touts>0) :
				//$i = 1;
				while ($touts->fetch()) :
					$tout_image= $touts->display('image');
					$tout_link= $touts->display('link');
                                        $tout_text= $touts->display('text');
                           //             $tout_image= $tout_image[0]['guid'];
					?>
                                    <div id="tout1" style="background: url('<?php echo $tout_image; ?>') no-repeat;" onclick="location.href='<?php echo $tout_link; ?>'">
                                        <a href="<?php echo $tout_link; ?>">
                                            <span class="text">WE'VE COMPLETED <?php echo countProjects("Completed Schools", false); ?> SCHOOLS!</span>  
                                        </a>
                                    </div>
					<?php
					//$i++;
				endwhile;
			endif; ?>                    
			<?php
			$touts = pods('home_tout_action');
			$touts->find($orderby='t.displayorder ASC'/*, $rows_per_page=1*/);
			$total_touts = $touts->total_found();
			if ($total_touts>0) :
			//	$i = 1;
				while ($touts->fetch()) :
					$tout_image= $touts->display('image');
					$tout_link= $touts->display('link');
                                        $tout_text= $touts->display('text');
                                  //      $tout_image= $tout_image[0]['guid'];
					?>
                                    <div id="tout2" style="background: url('<?php echo $tout_image; ?>') no-repeat;" onclick="location.href='<?php echo $tout_link; ?>'">
                                        <a href="<?php echo $tout_link; ?>">
                                            <span class="text"><?php echo $tout_text; ?></span> 
                                        </a>
                                    </div>
					<?php
					//$i++;
				endwhile;
			endif; ?>                    
 
                </div>
                <div class="hometouts-subhead">&nbsp;</div>
                <div class="hometouts-why">      
                    <a href="<?php bloginfo('url'); ?>/join-the-movement/donate">
                        <span class="why-top" style="width:160px; position: relative; left: -10px;">$25</span>
                        <span class="why-mid" style="width:140px;">Educates one child for one year</span>
                        <span class="why-bot" style="width:80px;">DONATE</span>
                    </a>
                    <a href="<?php bloginfo('url'); ?>/donate">    
                        <span class="why-top" style="width:160px;">100%</span>
                        <span class="why-mid" style="width:240px;">of online donations go directly towards educational programs</span>
                        <span class="why-bot" style="width:110px;">LEARN MORE</span>                       
                    </a>                       
                    <a href="<?php bloginfo('url'); ?>/fundraise">   
                        <span class="why-top" style="width:160px; position: relative; left: -20px;">$10,000</span>
                        <span class="why-mid" style="width:230px;">Builds a new school classroom</span>
                        <span class="why-bot" style="width:100px;">FUNDRAISE</span>                       
                    </a>  
                </div>
        <div class="clearfix"></div>
	<h2 id="progress-header">Our Impact</h2>
	<div id="progress">
		<div class="progress-cont" style="margin: 0">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare1.png" alt="" />
		</div>
		<div class="progress-cont">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare2.png" alt="" />
		</div>
		<div id="progress-promotion">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare3.png" alt="" />
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
