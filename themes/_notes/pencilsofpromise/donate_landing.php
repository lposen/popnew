<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Donate Landing
*/
?>

<?php get_header(); ?>

<div id="donate">
   
<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_100.jpg');"></div>            
    
        <div style="float:left; width:380px; margin:30px 15px 20px 37px;">

            <div class="box100" style="width:100%; height:160px;">        

<h2 class="header100" style="width:210px;">THE 100% PROMISE</h2>

<p>We promise that 100% of all funds donated or raised online will go directly towards education programs, 0% towards overhead. </p>
<p>Through private and offline donations we separately raise the funds necessary to cover our operating expenses. Your donations exclusively impact the lives of those you seek to empower.</p>                
                
            </div>

            <div class="box100" style="width:100%; height:104px;">      
   
<h2 class="header100" style="width:230px;">BECOME A PARTNER</h2>
<p>Your organization can join in our commitment to increasing educational 
opportunities in developing countries. <a href="<?php bloginfo('url'); ?>/donate/corporate/">Click here to learn more.</a></p>   

            </div>            
    
            <div class="box100" style ="width:100%; height:104px;">      

<h2 class="header100" style="width:170px;">SEND A CHECK</h2>
<span class="address100"><strong>Attn: Tom Casazzone, Pencils of Promise</strong></span>
<span class="address100">37 West 28th Street, 3rd Floor</span>
<span class="address100">New York, NY 10001</span>           
                
            </div>                 

        </div>

<div style="float:left; width:460px; margin:30px 15px 20px 37px;">

        <div class="box100" style ="width:100%; height:110px;">      

<h2 class="header100" style="width:330px;">GIVE A RECURRING DONATION</h2>

<ul>
<li class="one">
    <div class="donate100left">
       <p><span class="recur100">A monthly recurring donation<br/>of $25 educates 12 children</span></p>
    </div>
    <div class="donate100rightrecur">
        <a class="donatebutton100" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?recurring=monthly&d=25"></a> 
    </div>
</li>
</ul>

        </div>    
    
        <div class="box100" style="width:100%; height:462px;">

<h2 class="header100" style="width:300px;">GIVE A ONE-TIME DONATION</h2>
<ul>
<li class="one">
    <div class="donate100left">
       <p><span class="number100">$25</span></p>
       <p><span class="value100">Educate One Child</span></p>
    </div> 
    <div class="donate100right">
        <a class="donatebutton100" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=25"></a> 
    </div>
</li>

<li class="two">
    <div class="donate100left">
       <p><span class="number100">$250</span></p>
       <p><span class="value100">Educate Ten Children</span></p>
    </div> 
    <div class="donate100right">
        <a class="donatebutton100" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=250"></a> 
    </div>    
</li>

<li class="three">
    <div class="donate100left">
       <p><span class="number100">$2,500</span></p>
       <p><span class="value100">Sponsor a Classroom</span></p>
    </div> 
    <div class="donate100right">
        <a class="donatebutton100" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=2500"></a> 
    </div>        
</li>

<li class="four">
    <div class="donate100left">
       <p><span class="number100">$10,000</span></p>
       <p><span class="value100">Build a Classroom</span></p>
    </div> 
    <div class="donate100right">
        <a class="donatebutton100" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=10000"></a> 
    </div>        
</li>

<li class="five">
    <div class="donate100left">
       <p><span class="number100">$25,000</span></p>
       <p><span class="value100">Build & Sponsor a School</span></p>
    </div> 
    <div class="donate100right">
        <a class="contactbutton100" href="<?php bloginfo('url'); ?>/contact-us"></a> 
    </div>        
</li>

</ul>
        </div>    

</div>

</div>
    
    
<?php /*    
    
 	<div id="introduction">
		<img src="<?php bloginfo('template_directory'); ?>/gfx/headerDonate.png" width="990" alt="Ways to Donate" />
	</div>
<div id="paper-content">
    <div class="donateBox donateBoxOneTime">
        <a href="<?php bloginfo('url'); ?>/join-the-movement/donate/"><p>It only takes $25 to educate one child.</p></a>
    </div>

    <div class="donateBox donateBoxRecurring">
        <a href="<?php bloginfo('url'); ?>/join-the-movement/donate/?recurring=monthly&d=25"><p>A monthly recurring donation of $25 educates 12 children.</p></a>
    </div>  

    <div class="donateBox donateBoxText">
        <a href="#"><p>This $10 donation to PoP can give a child in need with over 4 months of education. Just reply YES to confirm your gift.</p></a>
    </div>  
    
    <div class="donateBox donateBoxHonor">
        <a href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=500"><p>With a gift of $500 or more you will be acknowledged in our annual report and support 20 children's educations.</p></a>
    </div>  

    <div class="donateBox donateBoxPartner">
        <a href="<?php bloginfo('url'); ?>/donate/corporate/"><p>Learn how your organization can join in our commitment to increasing educational opportunities for children in developing countries.</p></a>
    </div> 
</div>     

*/?>


</div>

<?php get_footer(); ?>