<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
/*
Template Name: Back to school
*/
?>
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/backtoschool.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery-ui-1.10.3.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/dropzone.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/backtoschool.css" rel="stylesheet" type="text/css">
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.20855.js"></script> 

<div id="bts">
    <nav id="header">
        <div id="uppernav">
            <!--<div id="progressbar"></div>-->
            <?php
                $url='http://www.stayclassy.org/api1/campaigns?cid=5417&token=utvVCIjXQWPvXIU80VME&eid=24994';
                $response = wp_remote_get( $url );
                if( is_wp_error( $response ) ) {
                   echo $response['body'];  
                } else {
                   $value = json_decode($response['body'],true);
                   //$campaigns = $value['campaigns'];
                   foreach ($value['campaigns'] as $campaign){
                         global $totalRaised;
                         $totalRaised = $campaign['total_raised'];
                 }
                }
             ?>
        </div>
        <div class="inner">
            <div class="left">
                <a href="https://fundraise.pencilsofpromise.org/checkout/set-donation?fcid=220466" class="donate">Donate</a>
            </div>
            <a href="" class="poplogo">
              <img src="http://www.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/logo55.png" alt="Pencils of Promise">
            </a>
            <div class="menu">
                <a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=24994&goal=25000">Start a Fundraising Page</a>
                <a href="https://fundraise.pencilsofpromise.org/fundraise/login?cid=5417&type=member" target="_blank">Login</a>
                <a href="#cheg">Share Your Photo</a>
            </div>
            
        </div>
        
    </nav> <!--end nav-->
    <div id="intro" class="section">
        <div id="slider">
            <img src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/slider_1.png">
        </div>
        <div id="campaignoverview">
            <span>Campaign Overview</span>
        </div>
        <div id="info" class="width">
            <div id="summary">
                <!--<iframe src="" frameborder="0"></iframe>-->
                <h3>We Believe Everyone Has Promise</h3>
                <p>More than half of students in rural Ghana, Laos and Guatemala don’t have
    what they need to go to secondary school. You can change that.</p>
                <a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=24994&goal=25000" class="getstarted">Get Started</a>
                <a href="https://fundraise.pencilsofpromise.org/fundraise/login?cid=5417&type=member">Login to your fundraising page</a>
            </div>
            <div class="divider"></div>
            <div id="progress">
                <h4>Our Progress</h4>
                <span class="zero">$0</span>
                <span class="total">$500,000</span>
                <div id="progressbar"></div>
                <div class="raised">$<?php echo $totalRaised; ?> raised</div>
                <div class="daysleft"><span id="daydiff"></span> Days Left</div>
                <div class="clearfix"></div>
                <hr>
                <div class="children">
                    <span id="children"></span>/5,000
                </div>
                <p>children are going back to school because of you.</p>
                <a href="https://fundraise.pencilsofpromise.org/checkout/set-donation?fcid=220466&amount=10" class="donate quick">Quick Donate: $10</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <hr>
        <!--<div class="cta">
            <a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=24994&goal=25000" class="fundraise">Fundraise</a>
            <a href="https://fundraise.pencilsofpromise.org/checkout/donation?fcid=220466" class="donate">Donate</a>
        </div>--> <!--end .cta-->
    </div> <!--end #intro-->
    <div class="clearfix"></div>
    <div id="scholarship">
        <img src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/scholarship.png">
        <div class="explanation">
            <h3>What Is A PoP Scholarship?</h3>
            <p>Scholarships give kids, most of them girls, what they
need for one year of secondary school. Every year of
school brightens the promise of a child’s future.</p>
            <p>Let’s send 5,000 students Back To School for just $100
each.</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="backback" class="section">      
        <div class="checklist">
            <form class="inner">
                <fieldset>
                    <h4>Back to School Checklist</h4>
                	<span class="custom-checkbox backpack">
                      <div class="plusminus">
                        <span class="plus">+</span>
                        <input type="text" class="number" value="0">
                        <span class="minus">-</span>
                      </div>
                      <input type="checkbox" value="100" class="" />
                      <span class="box"><span class="tick"></span></span>
                      <label>Backpack</label>
                      <span class="cost">$100</span>
                      <p>
                        Remember your new backpack every year? With your favorite superhero, cartoon character or cartoon-superhero on it? You can give that memory to a child.
                      </p> 
</span><br>
                    <span class="custom-checkbox supplies">
                      <div class="plusminus">
                        <span class="plus">+</span>
                        <input type="text" class="number" value="0">
                        <span class="minus">-</span>
                      </div>
                      <input type="checkbox" value="10" class="" />
                      <span class="box"><span class="tick"></span></span>
                      <label>Supplies</label>
                      <span class="cost">$10</span>
                      <p>
Every child deserves a set of perfectly sharpened pencils, a blank notebook to capture new ideas and knowledge, a folder to organize homework.
</p>
                      
                      
                    </span><br>
                    <span class="custom-checkbox uniform">
                      <div class="plusminus">
                        <span class="plus">+</span>
                        <input type="text" class="number" value="0">
                        <span class="minus">-</span>
                      </div>
                      <input type="checkbox" value="20" class="" />
                      <span class="box"><span class="tick"></span></span>
                      <label>Uniform</label>
                      <span class="cost">$20</span>
                      <p>
In Laos, Ghana and Guatemala secondary students wear uniforms to school. Give someone that fresh "First Day" look.
</p>
                      
                    </span><br>
                    <span class="custom-checkbox fees">
                      <div class="plusminus">
                        <span class="plus">+</span>
                        <input type="text" class="number" value="0">
                        <span class="minus">-</span>
                      </div>
                      <input type="checkbox" value="30" class="" />
                      <span class="box"><span class="tick"></span></span>
                      <label>School Fees</label>
                      <span class="cost">$30</span>
                      <p>
Tuition, workbooks for homework and exam fees can be expensive. Secondary schools are far from home for most PoP students. We cover transportation and dormitory costs, too.
</p>
                      
                    </span>
                </fieldset>
                <div id="boy">
                    <img src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/boy.png">
                    <img class="backpack" src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/backpack_big.png">
                </div>
                <div id="checksubmit">
                    <span class="dollar">$</span>
                    <input type="text" name="amount" class="amount">
                    <a id="checklistvalue" class="donate">Give</a>
                </div>
                <!--<input type="submit" value="Give" class="submit">-->
            </form>
        </div>
    </div> <!--end #backback-->
    <div class="clearfix"></div>
    <!--<div class="cta">
        <a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=24994&goal=25000" class="fundraise">Fundraise</a>
        <a href="https://fundraise.pencilsofpromise.org/checkout/donation?fcid=220466" class="donate">Donate</a>
    </div> <!--end .cta-->
    <div class="clearfix"></div>
    <div id="stories">
        <h3>Who You'll Be Helping</h3>
        <nav>
            <a href="#noonie">Noonie<span>Laos</span></a>
            <a href="#happy">Happy<span>Ghana</span></a>
            <a href="#darby">Darby<span>Guatamala</span></a>
            <a href="#koh">Koh<span>Ghana</span></a>
        </nav>
        <div class="stories">
            <div id="noonie">
                <img src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/backpack_big.png">
                <div class="info">
                    <h4>NOONIE</h4>
                    <p>Scholarships give kids, most of them
girls, what they need for one year
of secondary school. Every year of
school brightens the promise of a
child’s future.</p>
                    <a href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <div id="otherfundraisers" class="section">
        <h3>Back to School Scholarship Supporters</h3>
        
        <nav>
            <ul class="inner">
                <li class="closesttogoal">
                    <span>Closest to Goal</span>
                </li>
                <li class="mostraised">
                    <span>Most Raised</span>
                </li>
                <li class="biggestcontributers">
                    <span>Biggest Contributors</span>
                </li>
                <li class="featured">
                    <span>Featured Fundraisers</span>
                </li>
                <li class="recentlycreated">
                    <span>Recently Created</span>
                </li>
            </ul>
             <div class="bar"></div>
        </nav>
        <div class="clearfix"></div>
        <div class="main">
            <div id="closesttogoal" class="fundraiserlookup ca-container">
              <div class="ca-wrapper">
              <?php $url='http://www.stayclassy.org/api1/fundraisers?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=24994';

$response = wp_remote_get( $url);
if( is_wp_error( $response ) ) {
   echo $response['body'];  
} else {
   $value = json_decode($response['body'],true);
   function cmp($a, $b)
{
   //return strcmp($a['goal'], $b['goal']);
   $at = $a['goal']-$a['total_raised'];
   $bt = $b['goal']-$b['total_raised'];
  if ($at > $bt && $at>0 && $bt>0) {
        return 1;
    } else if ($at < $bt) {
        return -1;
    } else {
        return 0; 
    }
}
usort($value['fundraisers'], "cmp");
   foreach ($value['fundraisers'] as $campaign){
        $title = $campaign['page_title'];
        $raised = $campaign['total_raised'];
        $donateUrl = $campaign['donation_url'];
        $fundraiserUrl = $campaign['fundraiser_url'];
        if (!$campaign['member_image_large']){
           $image =  "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg";
        }
        else {
            $image = $campaign['member_image_large'];
        }
        global $goal;
        $goal= $campaign['goal'];
        $diff = $goal-$raised;
        if($diff>0){
            echo "
   
                <div class='ca-item ca-item-1 fundraiser'>
                    <a href='".$fundraiserUrl."' target='_blank'>
                        <img src='".$image."'>
                        <h4>".$title."</h4>
                        <p class='sub'>$".$diff." to go</p>
                    </a>
                </div>";
        }
       
                 }
                 
} ?>
                  
              </div><!-- end .ca-wrapper -->
            </div> <!-- end #closesttogoal -->
            <div id="mostraised" class="fundraiserlookup ca-container">
            <div class="ca-wrapper">
                <?php 
               $url='http://www.stayclassy.org/api1/fundraisers?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=24994&order=total_raised';

$response = wp_remote_get( $url  );
if( is_wp_error( $response ) ) {
   echo $response['body'];  
} else {
   $value = json_decode($response['body'],true);
   foreach ($value['fundraisers'] as $campaign){
        $title = $campaign['page_title'];
        $raised = $campaign['total_raised'];
        $donateUrl = $campaign['donation_url'];
        $fundraiserUrl = $campaign['fundraiser_url'];
        if (!$campaign['member_image_large']){
           $image =  "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg";
        }
        else {
            $image = $campaign['member_image_large'];
        }
        echo "
   
                <div class='ca-item ca-item-1 fundraiser'>
                    <a href='".$fundraiserUrl."' target='_blank'>
                        <img src='".$image."'>
                        <h4>".$title."</h4>
                        <p class='sub'>$".$raised." raised</p>
                    </a>
                </div>";
                 }
} ?>
               
              </div><!-- end .ca-wrapper -->
            </div> <!--end #mostraised-->
            <div id="biggestcontributers" class="fundraiserlookup ca-container">
               <div class="ca-wrapper">
               <?php 
               $url='http://www.stayclassy.org/api1/donations?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=24994';

$response = wp_remote_get( $url  );
if( is_wp_error( $response ) ) {
   echo $response['body'];  
} else {
   $value = json_decode($response['body'],true);
      function donate($a, $b)
{
  if ($a['donate_amount'] > $b['donate_amount']) {
        return -1;
    } else if ($a['donate_amount'] < $b['donate_amount']) {
        return 1;
    } else {
        return 0; 
    }
}
usort($value['donations'], "donate");
   foreach ($value['donations'] as $campaign){
        $firstname = $campaign['first_name'];
        $lastname = $campaign['last_name'];
        $date = $campaign['donation_date'];
        $amount = $campaign['donate_amount'];
        if (!$campaign['member_image_large']){
           $image =  "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg";
        }
        else {
            $image = $campaign['member_image_large'];
        }
        echo "
   
                <div class='ca-item ca-item-1 fundraiser'>
                    <a href='".$fundraiserUrl."' target='_blank'>
                        <img src='".$image."'>
                        <h4>".$firstname." ".$lastname."</h4>
                        <p class='sub'>$".$amount." donated</p>
                    </a>
                </div>";
                 }
} ?>
              </div><!-- end .ca-wrapper -->
            </div> <!--end #biggestcontributers-->
                        <div id="featured" class="fundraiserlookup ca-container">
            <div class="ca-wrapper">
                <?php 
                $params = array( 
                    'field'   => 'fcid', 
                    'limit'   => -1  // Return all rows 
                ); 
                $featured = pods( 'bts_featured', $params );
                //$featured = pods( 'bts_featured' ); 
                if ( 0 < $featured->total() ) { 
                    while ( $featured->fetch() ) { 
                        $fcid = $featured->display( 'fcid' );
                        $url='http://www.stayclassy.org/api1/fundraiser-info?token=utvVCIjXQWPvXIU80VME&cid=5417&fcid='.$fcid;
                        $response = wp_remote_get( $url  );
                        if( is_wp_error( $response ) ) {
                           echo $response['body'];  
                        } 
                        else {
                           $value = json_decode($response['body'],true);
                            $title = $value['page_title'];
                            $raised = $value['total_raised'];
                            $donateUrl = $value['donation_url'];
                            $fundraiserUrl = $value['fundraiser_url'];
                            if (!$value['member_image_large']){
                               $image =  "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg";
                            }
                            else {
                                $image = $value['member_image_large'];
                            }
                            echo "
                                <div class='ca-item ca-item-1 fundraiser'>
                                    <a href='".$fundraiserUrl."' target='_blank'>
                                        <img src='".$image."'>
                                        <h4>".$title."</h4>
                                        <p class='sub'>$".$raised." raised</p>
                                    </a>
                                </div>";
                        }} 
      
        }  ?>
               
              </div><!-- end .ca-wrapper -->
            </div> <!--end #featured-->
            
            <div id="recentlycreated" class="fundraiserlookup ca-container">
            <div class="ca-wrapper">
                <?php 
               $url='http://www.stayclassy.org/api1/fundraisers?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=24994';

$response = wp_remote_get( $url  );
if( is_wp_error( $response ) ) {
   echo $response['body'];  
} else {
   $value = json_decode($response['body'],true);
   foreach ($value['fundraisers'] as $campaign){
        $title = $campaign['page_title'];
        $raised = $campaign['total_raised'];
        $donateUrl = $campaign['donation_url'];
        $fundraiserUrl = $campaign['fundraiser_url'];
        if (!$campaign['member_image_large']){
           $image =  "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg";
        }
        else {
            $image = $campaign['member_image_large'];
        }
        echo "
   
                <div class='ca-item ca-item-1 fundraiser'>
                    <a href='".$fundraiserUrl."' target='_blank'>
                        <img src='".$image."'>
                        <h4>".$title."</h4>
                        <p class='sub'>$".$raised." raised</p>
                    </a>
                </div>";
                 }
} ?>
               
              </div><!-- end .ca-wrapper -->
            <?php /*<div class='ca-wrapper'>
            <?php
            $url='http://www.stayclassy.org/api1/account-activity?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=24994&type=22';

$response = wp_remote_get( $url  );
if( is_wp_error( $response ) ) {
   echo $response['body'];  
} else {
   $value = json_decode($response['body'],true);
   //$campaigns = $value['campaigns'];
   foreach ($value['activity'] as $campaign){
        $string = $campaign['activity_string'];
        $fundraiserUrl = $campaign['url'];
        //echo '<div>'.$string.' '.$place.'</div>';
        echo "
              
              
                <div class='ca-item ca-item-1 fundraiser'>
                    <a href='".$fundraiserUrl."' target='_blank'>
                        <img >
                        <p class='sub'>".$string."</p>
                    </a>
                </div>";
                 }
}
?>
            </div> <!--end #recentlycreated--> */ ?>
          </div><!-- end .ca-wrapper -->
        </div>
        <div id="searchbox">
            <input type="text" class="fundraiser_search" name="fundraiser_search" placeholder="Search Fundraisers">
            <div id="searchresponse" class="fundraiserlookup ca-container">
                <div class='ca-wrapper'></div>
            </div>
        </div>
    </div> <!--end #otherfundraisers-->
    <div class="clearfix"></div>
    <img src="<?php bloginfo('template_directory'); ?>/gfx/backtoschool/girl.png">
	<div id="waystohelp" class="section">
		<h3>What Did Your First Day Of School Look Like?</h3>
		<div id="cheg">
			<div class="intro">
				<img src="" alt="">
				<p>Because of our generous partners, Chegg, each photo shared
will be an automatic $10 donation to PoP up to $100,000</p>
			</div>
			<div id="facewall">
             <div class="row-1">
            <?php 
            session_start();
require_once ('twitteroauth-master/twitteroauth/twitteroauth.php');

//Twitter OAuth Settings
$search = "@timberners_lee OR netneutrality";
$notweets = 5;
$consumerkey = "LuZmjzE8jnN0Qkbncv5Q";
$consumersecret = "4YOPIdyxiGtCt5hHtKTEAuBG8QeyotLcE902nxVtkc";
$accesstoken = "23095095-oADZPARVY0HwitIoB9UI6h4obQhEkbTnqK2SrSIQ4";
$accesstokensecret = "jEWOtqMFu8arhg6vfvGtgNb3TMh963WmtTk3yjRh5QI";
define('CONSUMER_KEY', 'Ph0CTKxVrZAUKXXwVkWKMA');
define('CONSUMER_SECRET', 'yzQyRYnQs0dRk5Gt1ghBPZ8v0Ff8rBtKmdNAf1Y8');
define('ACCESS_TOKEN', '23095095-oADZPARVY0HwitIoB9UI6h4obQhEkbTnqK2SrSIQ4');
define('ACCESS_TOKEN_SECRET', 'jEWOtqMFu8arhg6vfvGtgNb3TMh963WmtTk3yjRh5QI');
 
function search(array $query)
{
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $toa->get('search/tweets', $query);
}
 
$query = array(
  "q" => "backtoschooltest",
  "include_entities" => 1
);
  
$response = search($query);
$results = $response->statuses;
//echo json_encode($results, true);  
foreach ($results as $result) {
 
  //echo $result->text;
  //$image = $result->user->profile_background_image_url;
  //$imagetwo = $result->entities->url->urls->expanded_url;
  //$imagetwo = $result->source;
  //echo $result->entities->media;
  $tw_media = array();
  if (isset($result->entities->media)) {
        $screenName = $result->user->screen_name;
        $text = $result->text;
        foreach ($result->entities->media as $media) {
            $media_url = $media->media_url;
           // echo "Found media in tweet: $media_url\n";
 
            # Strip the path part from the attachment
           $img = preg_replace("$.*/$", "", $media_url);
 
            # Fetch the picture and put it in /tmp
           system("wget -q -O /tmp/$img $media_url");
        }
        //echo $result->text . "\n\n";
        echo "<div class='image twitter'><img src='".$media_url."'><div class='screenname'><p>@".$screenName."</p></div></div>";
    }
  //echo "<div>".$text." ".$screenName." #".$imagetwo."<img src='".$imagetwo."'></div>";
  
}

require 'instagram.class.php';
      
   require_once 'instagram.class.php';

    // Initialize class with client_id
    // Register at http://instagram.com/developer/ and replace client_id with your own
    $instagram = new Instagram('c232cb886010469095929df0bdddb9c3');

    // Set keyword for #hashtag
    $tag = 'backtoschooltest';

    // Get latest photos according to #hashtag keyword
    $media = $instagram->getTagMedia($tag);

    // Set number of photos to show
    $limit = 5;

    // Set height and width for photos
    //$size = '100';

    // Show results
    // Using for loop will cause error if there are less photos than the limit
    foreach(array_slice($media->data, 0, $limit) as $data)
    {
        // Show photo
        echo "<div class='image instagram'><img src='".$data->images->thumbnail->url."'' height='".$size."' width='".$size."' alt='Instagram Image'></div>";
    }

            ?>
				
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
				</div>
				<div class="row-1">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
				</div>
				<div class="row-1">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
					<img src="" alt="">
                                            <!--<form enctype="multipart/form-data" action="btsuploader.php" method="POST">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                                <input name="uploadedfile" type="file" /><br />
                                                <input type="submit" value="Upload File" />
                                            </form>-->
                                            <form action="twitteroauth-master/btsuploader.php"
      class="dropzone"
      id="my-awesome-dropzone">
                <input type="file" name="file" />
                <input type="submit" href="" class="twitterupload">
            </form>
				</div>
			</div> <!--end #facewall-->
            <div class="stats">
            	<div class="photosshared">
            		<h4># of Photos Shared: <span></span></h4>
            	</div>
            	<div class="dollarsraised">
            		<h4>Dollars Raised through Social: <span></span></h4>
            	</div>
            </div>
            <?php

?>

		</div> <!--end #cheg-->
	</div> <!--end #waystohelp-->
    <div class="clearfix"></div>
    <div id="sponsors" class="section">
    	<h2>Thank you to Sponsors</h2>
    	<div class="sponsorlogos">
    		<a href="">
    			<img src="" alt="">
    		</a>
    		<a href="">
    			<img src="" alt="">
    		</a>
    		<a href="">
    			<img src="" alt="">
    		</a>
    		<a href="">
    			<img src="" alt="">
    		</a>
    	</div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.mousewheel.js"></script>  
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.contentcarousel.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jQueryRotateCompressed.2.2.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-ui-1.10.3.custom.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dropzone.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/backtoschool.js"></script> 

<script>
$(document).ready(function(){
    $( "#progressbar" ).progressbar({
        value: (<?php echo $totalRaised; ?>/500000)*100
    });
    
    $childrenEducated = Math.round(<?php echo $totalRaised; ?>/100);
    $("#children").text($childrenEducated);
     
});

</script>
