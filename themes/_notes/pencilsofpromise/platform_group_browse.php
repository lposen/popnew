<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Groups Browse
*/
?>

<?php get_header(); ?>

<script src="<?php bloginfo('template_directory'); ?>/js/jquery.pajinate.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function() {   
    $(function() {
            $("#flip").each(function(){
                $(".flip").hover(function(){
                    $(this).parent().find(".description").slideToggle("fast");
                 });
        });
    });
});
</script>
<?php
//----------------------------- BACKEND CODE SECTION --------------------------------------//
?>

<?php
try { //page error handling
//platform init
$mySforceConnection = doSalesforceConnect();
$loginId;$groupId;$fundId;$contactId;
$loginId = doPlatformLogin($current_user,$mySforceConnection);
$groupId = $_GET["g"];
$fundId = $_GET["f"];
$contactId=$_GET["u"];
$marketing=$_GET["m"];
?>

<?php
    //initiate the cache
    $doCache=doCache();
    $cacheId = 'browseGroups';
    $cacheHolder = array();
    $hasCache=false;
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/browse/',
            'lifeTime' => 7200,
            'automaticSerialization' => true 
        );
        $cache = new Cache_Lite($cacheOptions);
        $refreshCache=isset($_GET["r"]);
        if (!$refreshCache) {
            if (($cacheHolder = $cache->get($cacheId)) === false) {
                $hasCache = false;
            }
            else {
                $hasCache = true;     
            }
        }
    }
?>

<?php
    //GATHER ALL THE DATA IN ARRAYS AND OBJECTS
    //GROUPS in array
    $groupsArray = array();   
    if ($hasCache) {
        $groupsArray=$cacheHolder['groupsArray'];
    }
    else {    
        $query = "SELECT id,Name,Description__c,Members__c,Total_Raised__c,Goal__c,Photo_URL__c,Fundraisers__c FROM Group__c WHERE Published__c=true Order By LastModifiedDate DESC  LIMIT 200";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            $groupsArray[]=new GroupQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Members__c,$record->fields->Total_Raised__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Fundraisers__c);
        }; 
        if ($doCache) { $cacheHolder['groupsArray'] = $groupsArray; }
    } 
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    } 
?>

<?php
//----------------------------- DISPLAY CODE SECTION --------------------------------------//
?>
<div id="platform">

<div id="main">
 
    <?php $sort=$_GET['q']; ?>
    
    <div>
        <div id="browse_header" class="p_link light_grey">
             <span class="light_grey"><a href="#">Browse Groups</a></span>
             <span id="sort">
                 <form action="">
                     <span style="font-size: 12px;">Sort By: </span>
                     <select name="sort" onchange="location.href='/groups/browse?q='+this.value">
                         <option value="x">Recently Active</option>
                         <option value="r" <?php if ($sort=='r') { echo 'selected'; } ?>>Most Raised</option>
                         <option value="p" <?php if ($sort=='p') { echo 'selected'; } ?>>Closest to Goal</option>
                     </select>
                 </form>
             </span>
        </div>
        <div class="paging_container_browse" id="browse_group" style="margin: 0; padding: 0; width: 100%;"> 
        <div class="page_navigation"></div>
        <ul class="content" style=" margin: 0;">        
        <?php
                 if ( $sort=='r') {
                     usort($groupsArray, array("GroupQuick", "sort_raised"));
                 }
                 else if ($sort=='p') {
                     usort($groupsArray, array("GroupQuick", "sort_percent"));  
                 } //$i=0;
                 $platform_options = get_option('pop_platform_options');
                 $placeholder = $platform_options['platform_group_copy'];
                 foreach ($groupsArray as &$group) { //$i++;
                     ?>
                <div id="list_box" class="p_link" style="padding: 0; padding-top: 10px;">
                    <div id="flip" class="flip">
                    <div id="browse_stats">
                        <div id="browse_stats_button">
                            <div id="browse_stats_amt" class="text_gold BebasNeue ">$<?php echo number_format($group->raised,2); ?></div><div id="browse_stats_title">Amount Raised</div>
                        </div>
                        <div id="browse_stats_button">
                            <div id="browse_stats_amt" class="text_gold BebasNeue ">$<?php echo number_format($group->goal,0); ?></div><div id="browse_stats_title">Goal</div>
                        </div>
                    </div>
                    
                    <div id="section1_campaign_private" style="width: 80%;">
                      <?php
                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($group->photo!='') {
                            $photopath = $group->photo;
                        }
                        ?>                                  
                        <img class="img_centered" src="<?php echo $photopath ?>" style="width: 40px; height: 40px;">
                        <span id="fundraiser_heading" class="p_link browse_heading"><a href="/groups/group?g=<?php echo $group->id; ?>"><?php echo $group->name; ?></a><br>
                        <?php 
                            if ($loginId) {
                        ?>
                            <span class="profile_link" style="margin-top: 3px; display: block;"><a href="/process?g=<?php echo $group->id; ?>&u=<?php echo $login->id; ?>&groupjoin=1">+<span>Join This Group</span></a></span></span>
                        <?php
                        } else {  
                        ?>
                            <span class="profile_link" style="margin-top: 3px; display: block;"><a href="/signup">+<span>Sign up to join groups</span></a></span></span>
                        <?php
                        }
                        ?>
                 
                    </div>
                    
                    <div id="description" class="description">
                    <?php 
                        //if it's not a custom description then reset it
                        if ($group->description == "|defaultdescription|") {                             
                            $group->description = $placeholder;
                        }
                        echo $group->description; 
                    ?>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>                      
                    </div>
                </div>            
                     <?php            
                }    
        ?>
        </ul>
        <div class="page_navigation"></div>
        </div>

    </div>
    
</div>    
</div>     
<?php
}
catch (Exception $e) {
    ?>
   <script type="text/javascript">
      window.location= "/error";
   </script>
   <?php
}
?>    
    
<?php get_footer(); ?>


