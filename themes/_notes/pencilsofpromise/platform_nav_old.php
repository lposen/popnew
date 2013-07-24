<div id="platform-nav">
    <?php
    $current_user = wp_get_current_user();  
    if ( $current_user->ID > 0 ) {
        $name=$current_user->user_firstname . ' ' . $current_user->user_lastname;
        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
        if (get_user_meta($current_user->ID, 'userPlatformPhoto', true)!='') {
            $photopath = get_user_meta($current_user->ID, 'userPlatformPhoto', true);
        }
        if ($name==' ') { $name="Anonymous"; }
    ?>
        <div><img src="<?php echo $photopath ?>" style="float: right; width: 40px; height:40px; padding: 2px 10px 0px 0px;"><ul class="dropdown" class="top-level"><li style="padding-left:2px;"><a href="/userprofile"><?php echo $name; ?></a><ul class="platform_sub_menu"><li><a href="/userprofile">View Profile</a></li><li><a href="/fundraise?logout=true">Logout</a></li> </ul></li></ul></div>    
    <?php
    } else {
    ?>
        <div><ul class="dropdown"><li style="padding-left:2px;"><a href="/login">LOGIN</a></li><li style="padding-left:2px;"><a href="/signup">SIGNUP</a></li></ul></div>
    <?php
    }
    ?>
    <div class="logo"><a href="/fundraise"></a></div><div class="browse"><a href="/fundraise/browse">Browse Campaigns</a></div><div class="browse-groups"><a href="/groups/browse">Browse Groups</a></div><div class="downloads"><a href="/fundraise/downloads">Downloads</a></div>
</div>