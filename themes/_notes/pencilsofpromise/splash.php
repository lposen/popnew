<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
  Template Name: Splash_Page
 */
?>

<?php get_header(); ?>

<div id="platform">
    <div id="main">
        <div id="section1">
            <!--<div id="splash_infobar">
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Schools Completed</div>
                    <div id="infobar_info" class="BebasNeue">51</div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Schools Remaining</div>
                    <div id="infobar_info" class="BebasNeue">48</div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Funds Raised in 2012</div>
                    <div id="infobar_info" class="BebasNeue">$1,265,367</div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Campaigns</div>
                    <div id="infobar_info" class="BebasNeue">$194,937</div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Groups</div>
                    <div id="infobar_info" class="BebasNeue">$10,937</div>
                </div>
                <span class="stretch"></span> 
            </div> 
            <div id="splash_heading"class="BebasNeue text_gold">CHOOSE YOUR LEVEL OF IMPACT</div>
            <div id="splash_info"class="justify">
                <div  id="splash_infonav" class="inline"><a href="#" style="width: 145px;">Educate One Child</a>
                <div id="splash_tcell"></div></div>
                <div id="splash_infonav" class="inline"><a href="#" style="width: 165px;">Educate Ten Children</a>
                <div id="splash_tcell"></div></div>
                <div id="splash_infonav" class="inline"><a href="#" style="width: 170px;">Sponsor a Classroom</a>
                <div id="splash_tcell"></div></div>
                <div id="splash_infonav" class="inline"><a href="#" style="width: 140px;">Build a Classroom</a>
                <div id="splash_tcell"></div></div>
                <div id="splash_infonav" class="inline"><a href="#" style="width: 120px;">Build a School</a></div>
                <span class="stretch"></span> 
            </div>
            <div id="splash_pic"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/test_pic.png"></div>-->
            <div id="splash_login_video">    
                <div id="splash_login" class="p_link">
                    <div id="splash_login_button" class="light_grey BebasNeue"><a href="#">Create a Campaign</a></div>
                    <div id="splash_login_button" class="light_grey BebasNeue"><a href="#">Log In</a></div>
                </div>
                <div id="splash_video"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/video.png"></div>
            </div>
        </div>
        <hr>
        <div id="section2">
            <div id="splash_find" class="p_link">
                <div id="featured_header" class="BebasNeue text_gold">Find a Campaign</div>
                <form name="input" action="" method="get">
                    <div id="find_enter">
                        <input id="splash_search" type="submit" class="BebasNeue" value="Search" />
                        <input type="text" name="name" value="ENTER NAME" />
                    </div>
                </form>
                <span id="find_campaigns" class="BebasNeue light_grey p_link"><a href="#">Browse Campaigns</a></span>
                <span id="find_groups" class="BebasNeue light_grey"><a href="#">Browse Groups</a></span>
            </div>
            <div id="splash_featured">
                <div id="featured_header" class="BebasNeue text_gold p_link">Featured Campaign</div>
                <div id="featured_image"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                <div id="featured_title" class="p_link"><a href="#">Kim Smith’s 30th Birthday Party</a></div>
                <div id="featured_status">Kim Smith has completed <strong>70%</strong> of her <strong>$2,500</strong> campaign goal.</div>
                <div id="featured_donate" class="light_grey BebasNeue p_link"><a href="#">Donate</a></div>
                <div id="featured_info">KIM SAYS: In lieu of birthday wishes and gifts for my 30th, join my birthday campaign to help build a Pencils of Promise class- room. Please donate $30 or any combination: $300, $3000, $3030, $30,000 during the month of April!</div>
                <span class="profile_link textright"><a>+<em>learn more</em></a></span>
            </div>
            
        </div>
        <div id="splash_section3">
                    <div id="splash_campaigns" class="p_link">
                        <div id="splash_section3_header" class="BebasNeue">Top Campaigns</div>
                        <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">1. <a href="#">“Project Education” Finocchiaro Children</a>
                                <span id="donor_amt" class="BebasNeue">$55,999</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">2. <a href="#">Adam Braun</a>
                                <span id="donor_amt" class="BebasNeue">$37,078</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">3. <a href="#">Katrina Davies</a>
                                <span id="donor_amt" class="BebasNeue">$25,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">4. <a href="#">Gardner Pilot Academy</a>
                                <span id="donor_amt" class="BebasNeue">$23,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">5. <a href="#">Epiphany School 7th Grade Girls</a>
                                <span id="donor_amt" class="BebasNeue">$22,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">6. <a href="#">Julia Torres</a>
                                <span id="donor_amt" class="BebasNeue">$20,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">7. <a href="#">Team Pencils of Promise</a>
                                <span id="donor_amt" class="BebasNeue">$14,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">8. <a href="#">Lewis Howes	</a>
                                <span id="donor_amt" class="BebasNeue">$12,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">9. <a href="#">St. Theresa of Lisiez Catholic High School</a>
                                <span id="donor_amt" class="BebasNeue">$6,143</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">10. <a href="#">Chris Babcock and Mookie Margolis </a>
                                <span id="donor_amt" class="BebasNeue">$5,143</span></div>
                            </div>
                        </div>
                        <div id="splash_donors" class="p_link">
                            <div id="splash_section3_header" class="BebasNeue">Most Generous Donors</div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">1. <a href="#">Sam Smith</a>
                                <span id="donor_amt" class="BebasNeue">$1,534</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">2. <a href="#">Britney Jones</a>
                                <span id="donor_amt" class="BebasNeue">$1,323</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">3. <a href="#">Katrina Davies</a>
                                <span id="donor_amt" class="BebasNeue">$943</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">4. <a href="#">Gardner Pilot Academy</a>
                                <span id="donor_amt" class="BebasNeue">$923</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">5. <a href="#">Epiphany School 7th Grade Girls</a>
                                <span id="donor_amt" class="BebasNeue">$888</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">6. <a href="#">Julia Torres</a>
                                <span id="donor_amt" class="BebasNeue">$225</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">7. <a href="#">Team Pencils of Promise</a>
                                <span id="donor_amt" class="BebasNeue">$211</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">8. <a href="#">Lewis Howes	</a>
                                <span id="donor_amt" class="BebasNeue">$198</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">9. <a href="#">St. Theresa of Lisiez Catholic High School</a>
                                <span id="donor_amt" class="BebasNeue">$114</span></div>
                            </div>
                            <div id="section3_donors_content">
                                <div id="donor_pic"><a href="#"><img src="http://localhost:8888/PoP/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png"></a></div>
                                <div id="donor_name">10. <a href="#">Chris Babcock and Mookie Margolis</a>
                                <span id="donor_amt" class="BebasNeue">$111</span></div>
                            </div>
                    </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>