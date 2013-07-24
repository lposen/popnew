<?php
/**
 * Template Name: Fundraising Portal Template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div id="main-application">
<?php
    define("USERNAME", 'database@pencilsofpromise.org.developbox');
    define("PASSWORD", 'PoP12345');
    define("SECURITY_TOKEN", '455b0OrCTEYh0sy0HPoYxmM4');
    require_once ('soapclient/SforcePartnerClient.php');
    $mySforceConnection = new SforcePartnerClient();
    $mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
?>


<?php
    //initiate the cache
    $doCache=true;
    $cacheId = 'landing-50';
    $cacheHolder = array();
    $hasCache=false;
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/',
            'lifeTime' => 3600,
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
    //get the counts
    $stats;
    if ($hasCache) {
        $stats = $cacheHolder['stats'];
    }
    else {
        $fundCount;$campaignTotal;
        $query = "SELECT COUNT() FROM Fundraiser__c WHERE Marketing_Campaign__c = 'Impossible' LIMIT 1";
        $response = $mySforceConnection->query($query);
        $fundCount=$response->size;
        $query = "SELECT id, AmountWonOpportunities FROM Campaign WHERE name = 'Platform Impossible' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $campaignTotal=$record->fields->AmountWonOpportunities;
        };
        $stats=new PlatformStats($groupCount,$fundCount,$campaignTotal);
        if ($doCache) { $cacheHolder['stats']=$stats;}
    }
    $fund;
    if ($hasCache) {
        $fund = $cacheHolder['fund'];
    }
    else {
        $query = "SELECT id,Name,Type__c, Impact__c, Description__c, Status__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c,Marketing_Campaign__c, isClub__c FROM Fundraiser__c WHERE Featured__c=true AND Marketing_Campaign__c='Impossible' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fund = new Fundraiser($record->Id,$record->fields->Name,$record->fields->Type__c,$record->fields->Impact__c,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Video_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
            if ($doCache) { $cacheHolder['fund']=$fund;}
        };
    }
    //FUNDRAISERS in Array
    $fundraisersArray = array();
    if ($hasCache) {
        $fundraisersArray=$cacheHolder['fundraisersArray'];
    }
    else {
        $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c FROM Fundraiser__c WHERE Total_Raised__c>0 AND Marketing_Campaign__c = 'Impossible' ORDER BY Total_Raised__c DESC LIMIT 10";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c);
        };
        if ($doCache) { $cacheHolder['fundraisersArray'] = $fundraisersArray; }
    }
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }
    //DONATIONS in Array
    $donateArray = array();
    if ($hasCache) {
        $donateArray=$cacheHolder['donateArray'];
    }
    else {
        $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c,Anonymous__c FROM Opportunity WHERE CampaignId IN (SELECT id FROM Campaign WHERE Name = 'Platform Impossible') AND  Fundraiser__c!=null ORDER BY Amount DESC LIMIT 8";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $donateArray[]=new Donation($record->Id,$record->fields->CloseDate,$record->fields->Name,$record->fields->Amount,$record->fields->Platform_User__c,$record->fields->Fundraiser__c,$record->fields->Anonymous__c);
        };
        if ($doCache) { $cacheHolder['donateArray'] = $donateArray; }
    }
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }
 ?>

		<br/><br/><br/>

		<div id="splash_infobar">
                <div id="splash_box" class="light_grey even" >
                    <div id="infobar_title">Donate in 2012</div>
                    <div id="infobar_info" class="BebasNeue">$<?php echo number_format($stats->campaignTotal,0); ?></div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Campaigns</div>
                    <div id="infobar_info" class="BebasNeue"><?php echo $stats->fundCount; ?></div>
                </div>
                <span class="stretch"></span>
        </div>

		<br/><br/><br/>


<div id="splash_donors" class="p_link">
                        <div  id="splash_donors_inner">
                            <div id="splash_section3_header" class="BebasNeue text_gold">Most Generous Donors</div>
                            <ul id="sti-menu" class="sti-menu">
                            <?php
                                    usort($donateArray, array("Donation", "sort_amount"));
                                    foreach ($donateArray as &$donation) {
                                        ?>
                                <li data-hovercolor="black">
                                    <a href="http://development.pencilsofpromise.org/userprofile?u=<?php echo $donation->contact ?>">
                                        <?php $pieces = explode(" Donation to ", $donation->name);
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <!--<img src="<?php echo $photopath ?>"  data-type="icon" class="sti-icon sti-icon-care sti-item">-->
                                        <h2 data-type="mText" class="sti-item">Anonymous<br /><span> donated $<?php echo number_format($donation->amount,2); ?> to </span></h2>
                                        <h3 data-type="sText" class="sti-item"><?php echo $pieces[1]; ?></h3>
                                        <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
                                            <?php
                                        }
                                        else {
                                        ?>
                                        <!--<img src="<?php echo $photopath ?>" data-type="icon" class="sti-icon sti-icon-care sti-item">-->
                                        <h2 data-type="mText"  class="sti-item"> <?php echo $pieces[0]; ?><br /><span>donated $<?php echo number_format($donation->amount,2); ?> to </span></h2>
                                        <h3 data-type="sText" class="sti-item"><?php echo $pieces[1]; ?></h3>
                                        <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
                                            <?php
                                        }
                                        ?>
                                        </a>
                                </li>

                                    <!--<div id="section3_activity_user">
                                        <!--<div id="section3_user_date"><?php echo $donation->date; ?></div>-->
                                        <?php $pieces = explode(" Donation to ", $donation->name);
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <!--<div id="section3_user_info">Anonymous donated $<?php echo number_format($donation->amount,2); ?> to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                       <!-- <div id="section3_user_info"><a href="/userprofile?u=<?php echo $donation->contact ?>"><?php echo $pieces[0]; ?></a> donated $<?php echo number_format($donation->amount,2); ?> to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        ?>
                                    </div>-->
                                        <?php
                                    }
                                    if (count($donateArray)==0) {
                                        ?>
                                        No Donations to Display
                                        <?php
                                    }
                            ?>
                                        </ul>
                            </div>
                        </div>
                        <div id="splash_campaigns" class="p_link">
                        <div id="splash_section3_header" class="BebasNeue text_gold">Top Campaigns</div>
                        <ul id="sti-menu" class="sti-menu">
                            <?php
                                $i=0;
                                foreach ($fundraisersArray as &$fund) {
                                    $i++;
                                    ?>


                            <li data-hovercolor="black">
                                    <a href="http://development.pencilsofpromise.org/fundraise/fundraiser?f=<?php echo $fund->id; ?>">
                                            <h2 data-type="mText" class="sti-item" style="font-size: 14px;">
                                                <span style="font-size: 20px;"><?php echo $i; ?><br /></span>
                                                    <?php echo $fund->name; ?>
                                            </h2>
                                            <h3 data-type="sText" class="BebasNeue sti-item" style="font-size: 30px; margin-top: 0;">$<?php echo number_format($fund->raised,0); ?></h3>
                                            <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
            </span>
                                    </a>
                            </li>

                                    <!--<div id="section3_donors_content">
                                        <div id="donor_name"><?php echo $i; ?>. <a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                                        <div id="donor_amt" class="BebasNeue">$<?php echo number_format($fund->raised,0); ?></div>
                                    </div>  -->
                                    <?php
                                }
                                if (count($fundraisersArray)==0) {
                                    ?>
                                    No Fundraisers to Display
                                    <?php
                                }
                        ?>
                                    </ul>
                        </div>

<br/><br/><br/>

		<div id="splash_featured">
                <div>
                    <div id="featured_header" class="BebasNeue text_gold p_link">Featured Campaign</div>
                        <?php
                        $photopath = 'http://development.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($fund->photo!='') {
                            $photopath = $fund->photo;
                        }
                        ?>
                <div id="featured_image"><a href="http://development.pencilsofpromise.org/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><img src="http://development.pencilsofpromise.org/<?php echo $photopath; ?>"></a></div>
                <div id="featured_title" class="p_link"><a href="http://development.pencilsofpromise.org/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                <div id="featured_status"><strong><?php echo percent($fund->raised, $fund->goal); ?>%</strong> of the <strong>$<?php echo number_format($fund->goal,0); ?></strong> campaign goal completed.</div>
                <div id="featured_donate" class="platform-button"><a class="gold_button" href="http://development.pencilsofpromise.org/join-the-movement/donate?f=<?php echo $fund->id; ?>">Donate</a></div>
                <div id="featured_info"><?php echo $fund->description; ?></div>
                <!--<span class="profile_link textright" style="margin-right: 50px;"><a href="http://development.pencilsofpromise.org/fundraise/fundraiser?f=<?php echo $fund->id; ?>">+<em>learn more</em></a></span>-->
                </div>
        </div>

  		<br/><br/><br/>

		<b><a href="http://development.pencilsofpromise.org/fundraise/browse?m=Impossible">Browse Impossible Ones Fundraisers</a></b>

        <br/><br/><br/>



        <br/><br/><br/>


        <br/><br/><br/>


        <br/><br/><br/>



</div>
<?php get_footer(); ?>