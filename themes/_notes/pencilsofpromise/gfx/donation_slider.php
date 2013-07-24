<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Slider
*/
?>
<?php get_header(); ?>

   <div id="subheader" class="paper contest" style="margin: 0;"> 
  <h2><img src="<?php bloginfo('template_directory') ?>/gfx/donationCalcTitle.png" alt="Donation Calculator" /></h2> 
  <span></span> 
  <p>Pencils of Promise, Inc. is recognized as tax exempt under Section 501(c)(3) of the Internal Revenue Code. 
  For a copy of our IRS 501(c)(3) ruling, <a href=" ">click here</a>.</p> 
  </div> 
  <h2 id="page1-title">In 2009, 7 out of every 8 dollars donated went directly to funding both our domestic and international program services... </h2> 
  <p id="donate-money-desc">In order to provide sustainable education, we need funds to make things happen. If you have the means, we would appreciate any help you can provide. It only takes $0.32 to provide one day of sustainable education to one child. With your help, we can provide a lot more than that.</p> 
  <form action=" " method="post"> 
  <div class="step"> 
  <div class="step-number">1.</div> 
  <div class="explanation"> 
  Use the Slider To Select Your Desired Donation Amount. 
  </div> 
  <div class="form-container-nobg"></div> 
  </div> 
  <div class="step"> 
  <div class="step-number">2.</div> 
  <div class="explanation"> 
  Which will show you the impact your donation can make. 
  </div> 
  <div class="form-container"> 
  <div class="step-padding"> 
  <input type="text" name="amount" id="input-amt" /> 
  <span class="amount-copy-provides">Provides</span> 
  <input type="text" name="amount" id="input-days" /> 
  <span class="amount-copy-days">Days</span> 
  <span class="amount-copy-extra">of Quality Education</span> 
  <div class="clearfix"></div> 
  </div> 
  </div> 
  </div> 
  <div class="step"> 
  <div class="step-number">3.</div> 
  <div class="explanation"> 
  Increase your impact by making your donation recurring. 
  </div> 
  <div class="form-container-nobg"> 
  <div id="recurring"> 
  YES! I would like my donation to recur <input type="checkbox" name="recur_type" class="recur_type" value="monthly" /> monthly <br /> or <input type="checkbox" name="recur_type" value="yearly" class="recur_type" /> annually. 
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