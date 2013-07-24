<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Jobs & Internships 
*/
?>

<?php get_header(); ?>

<div id="movement">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" class="join" style="background: url('<?php echo $thumb[0]; ?>');">
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	<div id="join-content">
		<div id="join-form">
	  <div id="subheader" class="paper team">
				<h2>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/jobsintheader.png" alt="Join the team" width="723" />
				<span></span>			  </h2>
   
		  </div>
			<?php gravity_form(1, false, false); ?>
		</div>
        
                        
		<div id="aside">
			<?php
			global $wp_query;
			$post_id = $wp_query->post->ID;
			$banners = simple_fields_get_post_group_values($post_id, 5, false, 2);
			//echo print_r($banners);
			foreach ($banners as $banner) {
				echo '<a href="'.$banner[2].'">'. wp_get_attachment_image($banner[1], "full") .'</a>';
			}
			?>
		</div>
        <div id="approach-accordion">
				<div class="title" id="one"><a href="#"><span>+</span>Creative Technologist</a></div>
				<div class="accordion">
                <p>Pencils of Promise is looking for an energetic, professional, and versatile Creative Technologist who loves innovation, writes exceptional code and is ready to push the definition of digital presence in the non-profit space. We need someone with a keen eye for design and technical prowess; someone who can translate comps and concepts into flawless implementations including standards-friendly code and the use of current web technologies; someone who can easily learn new technologies, thrive in a laid back but extremely fast paced and innovative environment, and can effectively and openly communicate. We want someone who is personable and helpful, who can be the digital authority for our organization, using his/her competencies to inspire our team and build our movement through digital channels.</p>
	 				<p>We want someone to design and develop rich user interfaces for web applications, as well as have a deep understanding of back-end systems and end-user functionality. You need to be someone who not only can develop, but also conceive innovative concepts that can be brought to the table to solve user and client needs.</p>
					<p>We need a passionate and committed individual who believes in the Pencils of Promise mission, and is focused on producing high quality interactive experiences using web standards, while assisting in developing and maintaining guidelines for Best Practices.</p>
					<p><b>Daily Responsibilities:</b></p>
                    <p><ul>
					<li><span>Creation: Using current web technologies, HTML5, CSS3, and jQuery, you’ll create static and dynamic prototypes and application pages based on UI guidelines. Turn ideas into wireframes, always following Best Practices, intuitive user patterns, and technical specifications, while maintaining a high level of creativity.</span></li>
					<li><span>Collaboration: You’ll work synergistically and closely with a leading digital agency; with Developers and Designers to come up with innovative techniques to bring concepts to life. Work closely with all members of the PoP Team – from Marketing to Youth Programming and Outreach- and lend technical knowledge to solve usability issues that influence design and concepts.</span></li>
					<li><span>Organization: Develop a clean codebase of applications that is efficient, organized and well structured. Provide documentation to support what you’ve developed and always develop with change and scalability in mind.</span></li>
				</ul></p>
                <p><b>Skills:</b></p>
                 <p><ul>
                 <li><span>Advance knowledge in HTML, CSS, and Javascript with in-depth knowledge of DOM</span></li>
                <li><span>Intermediate to Advanced knowledge of tools and applications such as Adobe Creative Suite</span></li>
                 <li><span>Experience with jQuery</span></li>
                  <li><span>Experience or familiarity of an MVC architecture is a plus</span></li>
                   <li><span>Knowledge of .NET, Java, XML is a plus</span></li>
                    <li><span>Experience with VSTS, SVN, and QA tools</span></li>
                     <li><span>Experience designing interfaces with seamless and intuitive user experience at the core</span></li>
                     <li><span>Ability to be communicative, flexible and precise under tight deadlines</span></li>
                     <li><span>Knowledge of JavaScript frameworks, such as: jQuery, Moo Tools and Script.aculo.us</span></li>
                     <li><span>Intermediate to Advanced knowledge of tools and applications such as Adobe Creative Suite</span></li>
                     <li><span>Well-versed in design fundamentals and concept development</span></li>
                     <li><span>Not required but desired – experience with Salesforce.com / Common Ground CRM platform</span></li>
                     <li><span>Experience designing interfaces with seamless and intuitive user experience at the core</span></li>
                     </ul></p>
                     <p><b>About Pencils of Promise:</b></p>
                     <p>Pencils of Promise is one of the fastest growing nonprofits in the country. In less than two years since founder Adam Braun started the organization at the age of 24 with just $25, PoP is about to complete its 15th school between Laos and Nicaragua. We have a devoted community of over 100,000 supporters, and the entire organization is run by a core of passionate 20-somethings.</p>
                     
                     <p>Together, we build sustainable schools, partnerships and solutions to enable basic education for underserved children in the developing world. We are proof that a generation empowered will empower the world: one child, one pencil at a time.</p>
                       <p><b>About the office:</b></p>
                       <p>We are a very passionate, driven and fun group of young individuals. We have a unique, energetic office culture that is always casual and light, but, at all times, the PoP team is very much focused and committed to working hard in the name of our cause. You will find nothing besides positive attitudes, determination, and smiles at the PoP office.</p>
                       
                     <p>This is a great opportunity for a qualified individual to gain experience in a dynamic startup environment.</p>
                     <p>Salary will be commensurate upon experience.</p>
                     </div>
	</div>
</div>
<?php get_footer(); ?>