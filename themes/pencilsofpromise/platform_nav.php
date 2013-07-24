
    <script> /*
        $(document).ready(function() {  
                $('#nav_menu').mouseenter(function(){
                        $('#nav').toggle();
                });
                $('#nav').mouseleave(function(){
                    $('#nav').toggle();
                });

                /*$('#campaigns').mouseenter(function(){
                        $('.campaigns').slideToggle('slow');
                });
                $('.campaigns').mouseleave(function(){
                    $('.campaigns').slideToggle();
                });
                $('#groups').mouseenter(function(){
                        $('.groups').slideToggle('slow');
                });
            /* $('.groups').mouseleave(function(){
                    $('.groups').slideToggle();
                });
            });   */
    </script>   
     <?php /*
    $current_user = wp_get_current_user();  
    if ( $current_user->ID > 0 ) {
        $name=$current_user->user_firstname . ' ' . $current_user->user_lastname;
        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
        if (get_user_meta($current_user->ID, 'userPlatformPhoto', true)!='') {
            $photopath = get_user_meta($current_user->ID, 'userPlatformPhoto', true);
        }
        if ($name==' ') { $name="Anonymous"; } */
    ?>
    
    <div  id="nav_menu"><a href="/fundraise"><img src="<?php echo $photopath ?>" style="width: 30px; padding-left: 5px; margin-bottom: 5px; float: right; margin-top: 2px;"><img src="<?php bloginfo('template_directory'); ?>/gfx/schoolbuilder_beta_logo.png" style="width: 180px;   margin-top: 7px;"></a></div>
    <!--<div id="nav" style="width: 565px;">
        <ul id="create">
            <li>Create</li>
            <li><a href="/fundraise/manage">+<span>Campaigns</span></a></li>
            <li><a href="/groups/manage">+<span>Groups</span></a></li>            
        </ul>
        <ul id="browse">
            <li >Browse</li>
            <li><a href="/fundraise/browse">+<span>Campaigns</span></a></li>
            <li><a href="/groups/browse">+<span>Groups</span></a></li>
            <li><a href="/fundraise/downloads">+<span>Downloads</span></a></li>
        </ul>
        <div style="border-right: 1px solid #FEBC11;">
            <a href="/userprofile">My Profile</a><br/>
            <a href="/userprofile#section1_campaign" id="campaigns">My Campaigns</a><br/>
               <!-- <ul class="campaigns">
                    <li><a href="#">Campaign 1</a></li>
                    <li><a href="#">Campaign 2</a></li>
                    <li><a href="#">Campaign 3</a></li>
                    <li><a href="#">Campaign 4</a></li>
                </ul><br />
            <a href="/userprofile#groups" id="groups">My Groups</a><br />
                <ul class="groups">
                    <li><a href="#">Group 1</a></li>
                    <li><a href="#">Group 2</a></li>
                    <li><a href="#">Group 3</a></li>
                </ul>
        </div>-->
        <!--<div id="userprofile">
            <a href="/userprofile">
                <img src="<?php /* echo $photopath */ ?>">
            </a><br />
            <span><a href="/userprofile">Hi <?php /* echo $name; */ ?>!</a></span>
        </div>-->
        <!--<a href="/fundraise?logout=true" class="grey_button right">Log Out</a>-->
    </div>
    <?php /*
    } else { */
    ?>
     <!--<div  id="nav_menu"><a href="/fundraise"><img src="<?php /* bloginfo('template_directory'); */ ?>/gfx/schoolbuilder_beta_logo.png" style="width: 200px;   margin-top: 5px;"></a></div>
        <div id="nav" style="width: 400px;">
        <div id="login">
            <a href="/login" class="gold_button">Login</a><br />
            <a href="/signup"  class="gold_button">Sign Up</a>
        </div>
        <ul id="create">
            <li>Create</li>
            <li><a href="/fundraise/manage">+<span>Campaigns</span></a></li>
            <li><a href="/groups/manage">+<span>Groups</span></a></li>
        </ul>
        <ul id="browse">
            <li >Browse</li>
            <li><a href="/fundraise/browse">+<span>Campaigns</span></a></li>
            <li><a href="/groups/browse">+<span>Groups</span></a></li>
            <li><a href="/fundraise/downloads">+<span>Downloads</span></a></li>
        </ul>
    </div>-->
    <?php /*
    } */
    ?>
