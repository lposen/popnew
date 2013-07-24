<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Gala
*/
?>

<?php get_header(); ?>

<div id="gala">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">    
            <div id="intro-content">
                     <?php the_content(); ?>                   
            </div>
	</div>
	<div id="gala-items">
                    <div id="gala-form">
                        <h2 style="font-size:24px;">Many thanks to Give Back Brands for their pledge to match up to $500,000 raised!</h2>
</br><p>**$5,000+ commitments will be invited on our first donor trips</p>

</br>

                     <h2 style="font-size:24px;">If you would like to follow up on a pledge, commitment, or donor trip please write us below.</h2>
                     <?php gravity_form(9, false, false); ?>
		    </div>  
                    <div id="gala-details">
                        <h2>Quilt of Promises</h2>
                        <p>View our interactive guestbook!</p>
                        <a style="margin-left:75px;" href="http://www.pencilsofpromise.org/quilt"><img src="<?php bloginfo('template_directory'); ?>/gfx/quiltofpromises_button.png" width="265" height="216"/></a>                                                  
                         <h2 style="padding-top:10px;">2011 Photos</h2>
                        <div id="photo-album-gallery-gala" style="height:400px;">
                             <div class="album">
                                                                  
<a href="http://farm7.staticflickr.com/6117/6379806731_abb1657af5_b.jpg">
<img src="http://farm7.staticflickr.com/6117/6379806731_abb1657af5_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6107/6379808001_c66dd89318_b.jpg">
<img src="http://farm7.staticflickr.com/6107/6379808001_c66dd89318_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6060/6379809837_a230a964d1_b.jpg">
<img src="http://farm7.staticflickr.com/6060/6379809837_a230a964d1_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6224/6379811315_aaa7fd739a_b.jpg">
<img src="http://farm7.staticflickr.com/6224/6379811315_aaa7fd739a_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6220/6379845163_b2466095e2_b.jpg">
<img src="http://farm7.staticflickr.com/6220/6379845163_b2466095e2_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6099/6379820571_caab0be44a_b.jpg">
<img src="http://farm7.staticflickr.com/6099/6379820571_caab0be44a_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6107/6379822981_e22d3f15de_b.jpg">
<img src="http://farm7.staticflickr.com/6107/6379822981_e22d3f15de_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6217/6379824339_ed694687f1_b.jpg">
<img src="http://farm7.staticflickr.com/6217/6379824339_ed694687f1_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6215/6379825695_d94c38d701_b.jpg">
<img src="http://farm7.staticflickr.com/6215/6379825695_d94c38d701_m.jpg" alt="" />
</a>

<a href="http://farm7.staticflickr.com/6215/6379827837_e6a14c2546_b.jpg">
<img src="http://farm7.staticflickr.com/6215/6379827837_e6a14c2546_m.jpg" alt="" />
</a>
                                 
<a href="http://farm7.staticflickr.com/6041/6379841309_e9fb48a272_b.jpg">
<img src="http://farm7.staticflickr.com/6041/6379841309_e9fb48a272_m.jpg" alt="" />
</a>
            
<a href="http://farm7.staticflickr.com/6045/6379872473_6e3d0a8f91_b.jpg">
<img src="http://farm7.staticflickr.com/6045/6379872473_6e3d0a8f91_m.jpg" alt="" />
</a>
                                                                
                             </div>
                           
                        </div>
                        
                                                      
                         
                         
		    </div>               

<div id="gala-hosts">                        
                  <h2>HOST COMMITEE</h2>       

                   <div style="width:46%;float:right;">
Pam Caffray<br/>
Patricia & David Schulte<br/>
Rachel Goldstein<br/>
Randi & Boaz Sidikaro<br/>
Randy Phillips<br/>
Robert Hollander<br/>
Ryan Good<br/>
Ryan Smit<br/>
Scott Harrison<br/>
Shakil Khan<br/>
Shanti Kim Kandasamy<br/>
Sophia Bush<br/>
Zach Veach<br/> 
                  </div>                     
                  
                  <div style="width:46%;float:right;">
Alexander Soros<br/>
Arlenis Sosa<br/>
Ashley Bekton<br/>
Ashley Benson<br/>
Cabella Calloway Langsam<br/>
Charlie Wiggins<br/>
Farbood Nivi<br/>
Hope & Glenn Taitz<br/>
Jared Eng<br/>
Jay Williams<br/>
Jessica Stam<br/>
Matt Wiggins<br/>
Michael Duda<br/>  
Nicole Johnson<br/>
                  </div>                          
                          
 </div>            
            
            <div id="gala-logos">                        
                  <h2>SPECIAL THANKS</h2>       
	<?php
		$links = new Pod('logo_link');
		$links->findRecords('display_order ASC', -1, '');
		$links_total = $links->getTotalRows();
		$i = 1;
		
		if($links_total > 0) : 
			while($links->fetchRecord()) :
				$name = $links->display('name');
				$link = $links->display('link');
                                $page = $links->display('page');
				$image_raw = $links->display('logo');
                                $image = $image_raw[0]['guid'];
                                if ($page == 'gala') {
				?>
                                <div class="press-link" style="background: url(<?php echo $image; ?>) no-repeat center">
						<a href="<?php echo $link; ?>" ></a>
                                </div>                
                                <?php } ?>
			<?php endwhile; endif; ?>         
                          
                </div>
            
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>