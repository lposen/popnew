<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
  Template Name: Donation_Page
 */
?>

<?php get_header(); ?>
    
<div id="platform" class="p_link">
    <div id="donation_header" style="margin-top: 40px;">
        <img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/donation_banner.png" style="width: 100%;">
    </div>
    <div id="donation_body">
        <div id="section1">
            <div id="rsb">
                <div id="top" style="position: relative; top: -25px; margin-bottom: 20px;">
                    <img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/parthenon.png">
                </div>
                <div id="text">
                    <p>Pencils of Promise, Inc. is recognized as tax exempt under Section 501(c)(3) of the Internal Revenue Code. For a copy of our IRS 501(c)(3) ruling, click here.</p>
                </div>
            </div> 
            <div id="main">
                <div id="top">
                    $25
                </div>
                <div id="text">
                    <p>It only takes $25 to provide one year of sustainable education to one child. With your help, we can provide a lot more help than that.</p>
                </div>
            </div> 
            <div id="lsb">
                <div id="top">
                    100%
                </div>
                <div id="text">
                    <p>We promise that 100% of all funds donated or raised online will go directly towards education programs, 0% towards overhead.</p>
                </div>
            </div>
        </div>
        <div id="donation_campaign" class="p_link">
            This donation is for the campaign: <a href="#">Kim's 30th Birthday</a>
        </div>
        <div id="donation_amt">
            <div id="lsb"><span id="number">1</span></div>
            <div id="mid">Enter your desired donation amount which will show the impact your donation will make</div>
            <div id="rsb" style="font-weight: bold;">
                ENTER AMOUNT
                <div style="background: #bfbfbf; padding: 5px 10px; width: 210px; margin-bottom: 10px;">
                    <input id="donation_input" type="text" value="$1000" style="width: 200px;"/>
                </div>
            </div>
        </div>
        <div id="donation_recurring">
            <div id="lsb"><span id="number">2</span></div>
            <div id="mid">Increase your impact by making your donation recurring.</div>
            
            <div id="rsb">
                <div id="donation_button">
                    <div id="one_time_only"><a href="#">ONE TIME <br /> ONLY</a></div>
                    <div id="monthly"><a href="#">MONTHLY</a></div>
                    <div id="annually"><a href="#">ANNUALLY</a></div>
                </div>
            </div>
        </div>
        <div id="donation_pay">
            <div id="lsb"><span id="number">3</span></div>
            <div id="mid">Select your payment type to submit your donation.</div>
            <div id="rsb">
                <img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/paypal.png" style="padding-right: 30px;">
                <span style="position: relative; top: -15px;">OR</span>
                <img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/credit_cards.png" style="padding-left: 30px;">
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>