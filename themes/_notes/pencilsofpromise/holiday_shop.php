<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Product Shop
*/
?>

<?php get_header(); ?>

<div id="subpage-shop">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');"></div> 
        <div id="subpage-content">
		<div id="main-column">

        <div style="clear:both;"></div>                     
                    <?php the_content(); ?>        
                <div id="product-links">
<div class="pod_section">
	<?php
		$links = new Pod('product');
                $params = array('where'=>'t.section=1','orderby'=>'display_order ASC');
		$links->findRecords($params);
		$links_total = $links->getTotalRows();
		$i = 1;
                
		if($links_total > 0) :
                    ?> <h2><?php echo simple_fields_get_post_value(get_the_id(), 'Category 1 Title', true); ?></h2> <?php
			while($links->fetchRecord()) :
				$name = $links->get_field('name');
				$link = $links->get_field('link');
				$linkText = $links->get_field('link_text');
                                $linkCustomCode = $links->get_field('link_custom_code');
                                $price = $links->get_field('price');
                                $page = $links->get_field('page');
                                $desc = $links->get_field('description');
				$image_raw = $links->get_field('photo');
                                $image = $image_raw[0]['guid'];
				$closeup_raw = $links->get_field('photo_large');                            
                                $closeup = $image;
                                if (!$linkText) {
                                    $linkText="Buy Now";
                                }
				?>
                                    <div class="product-link" id="productfeatured<?php echo $i ?>" style="background:url(<?php echo $image; ?>) no-repeat center">
						<a class="product-tout" href="#productfeaturedcontent<?php echo $i ?>" ></a>
                                    </div>
                                    
                                    <div style="display:none">
                                        <div class="product-overlay" id="productfeaturedcontent<?php echo $i ?>">
                                            <div class="interior">
                                                <div id="name"><?php echo $name; ?></div>                                             
                                                <?php 
                                                if (!$closeup_raw) {
                                                ?>
                                                <div id="photo" style="overflow:hidden">
                                                <img src="<?php echo $image; ?>" width="160"/>
                                                </div>
                                                <?php    
                                                } else {
                                                ?>
                                                <div id="photo" class="panzoom">
                                                <a href="<?php echo $closeup; ?>"><img src="<?php echo $image; ?>" width="160" height="160" id="imagePan" style="display:none;"/></a>
                                                </div>
                                                <?php    
                                                }
                                                ?>                                                
                                                <div id="text"><?php echo $desc; ?></div>
                                                <div id="link">
                                                    <?php if ($linkCustomCode) { ?>
                                                    <?php echo $linkCustomCode; ?>
                                                    <?php } else { ?>
                                                    <a href="<?php echo $link; ?>" target="_blank"><?php echo $linkText ?></a>
                                                    <?php } ?>
                                                </div>    
                                                <div id="price">$<?php echo $price; ?></div> 
                                                                                  
                                            </div>
                                        </div>
                                    </div>
                    
                                    <?php $i++; ?> 
			<?php endwhile; endif; ?>
</div>
<div class="pod_section">
	<?php
		$links = new Pod('product');
                $params = array('where'=>'t.section=2','orderby'=>'display_order ASC');
		$links->findRecords($params);
		$links_total = $links->getTotalRows();
                
		if($links_total > 0) :
                        ?> <h2><?php echo simple_fields_get_post_value(get_the_id(), 'Category 2 Title', true); ?></h2> <?php
			while($links->fetchRecord()) :
				$name = $links->get_field('name');
				$link = $links->get_field('link');
				$linkText = $links->get_field('link_text');
                                $linkCustomCode = $links->get_field('link_custom_code');
                                $price = $links->get_field('price');
                                $page = $links->get_field('page');
                                $desc = $links->get_field('description');
				$image_raw = $links->get_field('photo');
                                $image = $image_raw[0]['guid'];
				$closeup_raw = $links->get_field('photo_large');                            
                                if (!$closeup_raw) {
                                    $closeup = $image;
                                }
                                else {
                                    $closeup = $closeup_raw[0]['guid'];   
                                }
                                if (!$linkText) {
                                    $linkText="Buy Now";
                                }
				?>
                                    <div class="product-link" id="productfeatured<?php echo $i ?>" style="background:url(<?php echo $image; ?>) no-repeat center">
						<a class="product-tout" href="#productfeaturedcontent<?php echo $i ?>" ></a>
                                    </div>
                                    
                                    <div style="display:none">
                                        <div class="product-overlay" id="productfeaturedcontent<?php echo $i ?>">
                                            <div class="interior">
                                                <div id="name"><?php echo $name; ?></div>
                                                <?php 
                                                if (!$closeup_raw) {
                                                ?>
                                                <div id="photo" style="overflow:hidden">
                                                <img src="<?php echo $image; ?>" width="160"/>
                                                </div>
                                                <?php    
                                                } else {
                                                ?>
                                                <div id="photo" class="panzoom">
                                                <a href="<?php echo $closeup; ?>"><img src="<?php echo $image; ?>" width="160" height="160" id="imagePan" style="display:none;"/></a>
                                                </div>
                                                <?php    
                                                }
                                                ?>  
                                                <div id="text"><?php echo $desc; ?></div>
                                                <div id="link">
                                                    <?php if ($linkCustomCode) { ?>
                                                    <?php echo $linkCustomCode; ?>
                                                    <?php } else { ?>
                                                    <a href="<?php echo $link; ?>" target="_blank"><?php echo $linkText ?></a>
                                                    <?php } ?>
                                                </div>    
                                                <div id="price">$<?php echo $price; ?></div> 
                                                                                  
                                            </div>
                                        </div>
                                    </div>
                    
                                    <?php $i++; ?> 
			<?php endwhile; endif; ?>
 </div> 
<div class="pod_section">
	<?php
		$links = new Pod('product');
                $params = array('where'=>'t.section=3','orderby'=>'display_order ASC');
		$links->findRecords($params);
		$links_total = $links->getTotalRows();
                
		if($links_total > 0) : 
                        ?> <h2><?php echo simple_fields_get_post_value(get_the_id(), 'Category 3 Title', true); ?></h2> <?php
			while($links->fetchRecord()) :
				$name = $links->get_field('name');
				$link = $links->get_field('link');
				$linkText = $links->get_field('link_text');
                                $linkCustomCode = $links->get_field('link_custom_code');
                                $price = $links->get_field('price');
                                $page = $links->get_field('page');
                                $desc = $links->get_field('description');
				$image_raw = $links->get_field('photo');
                                $image = $image_raw[0]['guid'];
				$closeup_raw = $links->get_field('photo_large');                            
                                if (!$closeup_raw) {
                                    $closeup = $image;
                                }
                                else {
                                    $closeup = $closeup_raw[0]['guid'];   
                                }
                                if (!$linkText) {
                                    $linkText="Buy Now";
                                }
				?>
                                    <div class="product-link" id="productfeatured<?php echo $i ?>" style="background:url(<?php echo $image; ?>) no-repeat center">
						<a class="product-tout" href="#productfeaturedcontent<?php echo $i ?>" ></a>
                                    </div>
                                    
                                    <div style="display:none">
                                        <div class="product-overlay" id="productfeaturedcontent<?php echo $i ?>">
                                            <div class="interior">
                                                <div id="name"><?php echo $name; ?></div>
                                                <?php 
                                                if (!$closeup_raw) {
                                                ?>
                                                <div id="photo" style="overflow:hidden">
                                                <img src="<?php echo $image; ?>" width="160"/>
                                                </div>
                                                <?php    
                                                } else {
                                                ?>
                                                <div id="photo" class="panzoom">
                                                    <a href="<?php echo $closeup; ?>"><img src="<?php echo $image; ?>" width="160" height="160"/></a>
                                                </div>
                                                <?php    
                                                }
                                                ?>  
                                                <div id="text"><?php echo $desc; ?></div>
                                                <div id="link">
                                                    <?php if ($linkCustomCode) { ?>
                                                    <?php echo $linkCustomCode; ?>
                                                    <?php } else { ?>
                                                    <a href="<?php echo $link; ?>" target="_blank"><?php echo $linkText ?></a>
                                                    <?php } ?>
                                                </div>
                                                <div id="price">$<?php echo $price; ?></div> 
                                                                                  
                                            </div>
                                        </div>
                                    </div>
                    
                                    <?php $i++; ?> 
			<?php endwhile; endif; ?>
 </div> 
                </div>      
        
		</div>    
	</div>
    
        <?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>