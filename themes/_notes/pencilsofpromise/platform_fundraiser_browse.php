<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Fundraiser Browse
*/
?>

<?php get_header(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.pajinate.js" type="text/javascript" charset="utf-8"></script>
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
    $cacheId = 'browseFunds';
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
    //FUNDRAISERS in Array
    $fundraisersArray = array();
    if ($hasCache) {
        $fundraisersArray=$cacheHolder['fundraisersArray'];
    }
    else {    
        $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c FROM Fundraiser__c WHERE Published__c=true Order By LastModifiedDate DESC LIMIT 200";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c);
        };
        if ($doCache) { $cacheHolder['fundraisersArray'] = $fundraisersArray; }
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
    <script type="text/javascript">
            $(document).ready(function(){
                    $('#browse_fund').pajinate({show_first_last: false,items_per_page : 5});
            });         
    </script>
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
    <?php $sort=$_GET['q']; ?>
    
    <div>
        <div id="browse_header" class="p_link light_grey">
             <span class="light_grey"><a href="#">Browse Campaigns</a></span>
             <span id="sort">
                 <form action="">
                     <span style="font-size: 12px;">Sort By: </span>
                     <select name="sort" onchange="location.href='/fundraise/browse?q='+this.value+'&m=<?php echo $marketing; ?>'">
                         <option value="x">Recently Active</option>
                         <option value="r" <?php if ($sort=='r') { echo 'selected'; } ?>>Most Raised</option>
                         <option value="p" <?php if ($sort=='p') { echo 'selected'; } ?>>Closest to Goal</option>
                     </select>
                 </form>
             </span>
        </div>  
        <div class="paging_container_browse" id="browse_fund">
        <div class="page_navigation"></div>
        <ul class="content" style="margin: 0;">        
        <?php
                 if ( $sort=='r') {
                     usort($fundraisersArray, array("FundraiserQuick", "sort_raised"));
                 }
                 else if ($sort=='p') {
                     usort($fundraisersArray, array("FundraiserQuick", "sort_percent"));   
                 }
                 if (strtolower($marketing)=="impossible") {
                     $fundraisersArray = array_filter($fundraisersArray, array("FundraiserQuick", "filter_marketing_impossible"));
                 }
                 else if (strtolower($marketing)=="schools4all") {
                     $fundraisersArray = array_filter($fundraisersArray, array("FundraiserQuick", "filter_marketing_s4a"));
                 }
                 $platform_options = get_option('pop_platform_options');
                 $placeholder = $platform_options['platform_fundraiser_copy']; 
                 foreach ($fundraisersArray as &$fund) {
                     ?>
                                     <div id="list_box" class="p_link" style="padding: 0; padding-top: 10px;">
                                         <div id="flip" class="flip"><div id="browse_donate" class="platform-button p_link">
                                                <a class="gold_button"href="/join-the-movement/donate?f=<?php echo $fund->id; ?>">Donate</a>
                                         </div>
                                        <div id="browse_stats">
                                            <div id="browse_stats_button">
                                                <div id="browse_stats_amt" class="text_gold BebasNeue ">$<?php echo number_format($fund->raised,2); ?></div><div id="browse_stats_title">Amount Raised</div>
                                            </div>
                                            <div id="browse_stats_button">
                                                <div id="browse_stats_amt" class="text_gold BebasNeue ">$<?php echo number_format($fund->goal,0); ?></div><div id="browse_stats_title">Goal</div>
                                            </div>
                                        </div>
                                         <div id="section1_campaign_private">
                                            <?php
                                            $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                                            if ($fund->photo!='') {
                                                $photopath = $fund->photo;
                                            }
                                            ?>                                                                             
                                            <img class="img_centered" src="<?php echo $photopath ?>" style="width: 40px; height: 40px;"></span>
                                            <div id="fundraiser_heading" class="p_link browse_heading" style="width: 75%;"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                                        </div>
                                         <div id="description" class="description">
                                             <?php 
                                                //if it's not a custom description then reset it
                                                if ($fund->description == "|defaultdescription|") {                             
                                                    $fund->description = $placeholder;
                                                }
                                                echo $fund->description; 
                                             ?>
                                         </div>
                                         
                                         <div class="clearfix"></div>
                                         <hr>
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
      <?php /* window.location= "/error?e=.<?php echo urlencode($e); ?>"; */ ?>
      window.location= "/error";
   </script>
   <?php
}
?>    
    
<?php get_footer(); ?>
