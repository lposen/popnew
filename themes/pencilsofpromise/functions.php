<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
// doSalesforceConnect();
/***************************************
	Variables for use in theme files
***************************************/
$adamID		= 4;

if (!is_admin()){
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo('template_directory').'/js/jquery.js');
}

/***************************************
	Misc Theme Support Additions
***************************************/
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

/***************************************
	Set up Sidebar
***************************************/
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}


/***************************************
	Enable WP 3.0+ Menus
***************************************/
add_theme_support("menus");
register_nav_menu('header-nav', __('Header'));
register_nav_menu('footer-nav', __('Footer'));


/***************************************
	Return number of people who joined
***************************************/
function getMovementNumber() {
	$proto = ($_SERVER['HTTPS']) ? "https://" : "http://"; 
	
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($c, CURLOPT_URL, $proto.'graph.facebook.com/pencilsofpromise');

	$returnedJSON = curl_exec($c);
	curl_close($c);

	$returned = json_decode($returnedJSON);
	//return number_format($returned->fan_count); //Adds a comma per thousands
	$facebookLikes = $returned->fan_count;
	
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($c, CURLOPT_URL, $proto.'twitter.com/statuses/user_timeline/pencilsofpromis.json?count=1');

	$returnedJSON = curl_exec($c);
	curl_close($c);

	$returned = json_decode($returnedJSON, true);
	$twitterFollowers = $returned[0]["user"]["followers_count"];
        
	return ($facebookLikes + $twitterFollowers);
}

function truncate($string, $max, $cap=".", $pad="...") {
  $string = strip_tags($string);
  if (strlen($string) <= $max) return $string;
  if (false !== ($breakpoint = strpos($string, $cap, $max))) {
      if ($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
      }
  }
  return $string;
}

/***************************************
	Get supporting text for Platform
***************************************/
function text_from_impactlabel($label) {
    $returner="Pencils of Promise projects and programs whereever it is most needed";
        if (strtolower($label)=='laos') {
            $returner="projects and programs in Laos";
        }
        else if (strtolower($label)=='guatemala') {
            $returner="projects and programs in Guatemala";
        }
        else if (strtolower($label)=='nicaragua') {
            $returner="projects and programs in Nicaragua";
        }
        else if (strtolower($label)=='primary schools') {
            $returner="primary school projects and programs";
        }
        else if (strtolower($label)=='preschools') {
            $returner="preschool projects and programs";
        }
        else if (strtolower($label)=='mixeduse') {
            $returner="mixed-use projects and programs";
        }
    return $returner;
}

/***************************************
	Get thumbnails for Flickr module
***************************************/
function image_from_description($data) {
    preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
    return $matches[1][0];
}

function select_image($img, $size) {
    $img = explode('/', $img);
    $filename = array_pop($img);

    // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the $size variable to selct one.
    $s = array(
        '_s.', // square
        '_t.', // thumb
        '_m.', // small
        '.',   // medium
        '_b.'  // large
    );

    $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
    return implode('/', $img);
}

/***************************************
	Get Number of Projects by Type
***************************************/
function countProjects($parentTitle, $leading=true) {
	$pages_query = new WP_Query();
	$all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
	$parent =  get_page_by_title($parentTitle);		
	$children = get_page_children($parent->ID, $all_pages);
	return (count($children) < 10 && $leading) ? '0' . count($children) : count($children);
}

/************************************************
	Custom Walker to extract current sub-menu
************************************************/

class Extract_Current_Submenu extends Walker_Nav_Menu {

	var $found_parents = array();

	function start_el(&$output, $item, $depth, $args) {
			global $wp_query;

			//this only works for second level sub navigations
			$parent_item_id = 0;

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;	

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';
			#current_page_item

			// Checks if the current element is in the current selection
			if (strpos($class_names, 'current-menu-item')
				|| strpos($class_names, 'current-menu-parent')
				|| strpos($class_names, 'current-menu-ancestor')
				|| (is_array($this->found_parents) && in_array( $item->menu_item_parent, $this->found_parents )) ) {

				// Keep track of all selected parents
				$this->found_parents[] = $item->ID;

				//check if the item_parent matches the current item_parent
				if($item->menu_item_parent!=$parent_item_id){

					$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

					$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
					$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
					$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
					$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

					$item_output = $args->before;
					$item_output .= '<a'. $attributes .'>';
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= '</a>';
					$item_output .= $args->after;
				}
				//}
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

	function end_el(&$output, $item, $depth) {
		global $found_parents;
		// Closes only the opened LI
		if ( is_array($found_parents) && in_array( $item->ID, $found_parents ) ) {
			$output .= "</li>\n";
		}
	}

	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		// If the sub-menu is empty, strip the opening tag, else closes it
		if (substr($output, -22)=="<ul class=\"sub-menu\">\n") {
			$output = substr($output, 0, strlen($output)-23);
		} else {
			$output .= "$indent</ul>\n";
		}
	}

}

/**********************************************************
	Adjusts the_excerpt length and what it ends with
**********************************************************/

function new_excerpt_length($length) {
	return 20;
}
function new_excerpt_more($more) {
	return '...';
}

/*
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('excerpt_length', 'new_excerpt_length');
*/

/***************************************
  Add Custom User Profile Fields
***************************************/

add_action('show_user_profile', 'my_show_platform_profile_fields');
add_action('edit_user_profile', 'my_show_platform_profile_fields');
add_action('show_user_profile', 'my_show_extra_profile_fields');
add_action('edit_user_profile', 'my_show_extra_profile_fields');

function my_show_platform_profile_fields($user) { ?>

  <h3>Platform Information</h3>
  <h4>This is used to connect to the Salesforce Fundraising Platform.</h4>

  <table class="form-table">
    <tr>
      <th><label for="userTwitter">Salesforce Id</label></th>
      <td>
			<input value="<?php echo get_user_meta($user->ID, 'userSalesforce', true); ?>" name="userSalesforce" />
			<br />
      </td>
    </tr>   
    <tr>
      <th><label for="userTwitter">Photo Location</label></th>   
      <td>
			<input value="<?php echo get_user_meta($user->ID, 'userPlatformPhoto', true); ?>" name="userPlatformPhoto" />
			<br />
      </td>      
    </tr>
  </table>
<?php }

add_action('personal_options_update', 'my_save_platform_profile_fields');
add_action('edit_user_profile_update', 'my_save_platform_profile_fields');

function my_save_platform_profile_fields($user_id) {
	if (!current_user_can('edit_user', $user_id)) return false;
	update_usermeta($user_id, 'userSalesforce', $_POST['userSalesforce']);
        update_usermeta($user_id, 'userPlatformPhoto', $_POST['userPlatformPhoto']);
}

function my_show_extra_profile_fields($user) { ?>

  <h3>Additional User Information</h3>
  <h4>This is used to control where the user appears in listings across the site.</h4>

  <table class="form-table">
    <tr>
      <th><label for="userTitle">User Title/Visibility</label></th>
      <td>
			<select name="userTitle">
				<?php $currentTitle = get_user_meta($user->ID, 'userTitle', true); ?>
				<option value="hidden" <?php if ($currentTitle == 'hidden') echo 'selected="selected" '; ?>>NEVER Appear on Site</option>
				<option value="leadership" <?php if ($currentTitle == 'leadership') echo 'selected="selected" '; ?>>Leadership Team</option>
				<option value="staff" <?php if ($currentTitle == 'staff') echo 'selected="selected" '; ?>>Staff Member</option>
				<option value="board" <?php if ($currentTitle == 'board') echo 'selected="selected" '; ?>>Board of Directors</option>
                                <option value="advisory" <?php if ($currentTitle == 'advisory') echo 'selected="selected" '; ?>>Advisory Board Member</option>
				<option value="volunteer" <?php if ($currentTitle == 'volunteer') echo 'selected="selected" '; ?>>Volunteer</option>
                                <option value="former" <?php if ($currentTitle == 'former') echo 'selected="selected" '; ?>>Former PoP Team Member</option>
			</select><br />
      </td>
    </tr>
	<tr>
      <th><label for="userRelatedLink">Related Link (Bio, Introductory Blog Post, etc.)</label></th>
      <td>
			<input value="<?php echo get_user_meta($user->ID, 'userRelatedLink', true); ?>" name="userRelatedLink" />
			<br />
      </td>
   </tr>
	<tr>
      <th><label for="userSubtitle">Affiliated Company or Subtitle</label></th>
      <td>
			<input value="<?php echo get_user_meta($user->ID, 'userSubtitle', true); ?>" name="userSubtitle" />
			<br />
      </td>
   </tr>
	<tr>
      <th><label for="userTwitter">Twitter Username</label></th>
      <td>
			<input value="<?php echo get_user_meta($user->ID, 'userTwitter', true); ?>" name="userTwitter" />
			<br />
      </td>
    </tr>
  </table>
<?php }

add_action('personal_options_update', 'my_save_extra_profile_fields');
add_action('edit_user_profile_update', 'my_save_extra_profile_fields');

function my_save_extra_profile_fields($user_id) {
	if (!current_user_can('edit_user', $user_id)) return false;
	update_usermeta($user_id, 'userTitle', $_POST['userTitle']);
	update_usermeta($user_id, 'userRelatedLink', $_POST['userRelatedLink']);
	update_usermeta($user_id, 'userSubtitle', $_POST['userSubtitle']);
	update_usermeta($user_id, 'userTwitter', $_POST['userTwitter']);
}

/***************************************
  Thumbnails
***************************************/

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 286, 286, true ); // Normal post thumbnails
	add_image_size( 'contest-post-thumbnail', 295, 321, true ); // Permalink thumbnail size
	add_image_size( 'project-small-thumbnail', 224, 224 );
	add_image_size( 'our-story-image', 300, 673 );
	add_image_size( 'blog-thumbnail', 382, 191);
	add_image_size( 'event-news', 382, 191);
	add_image_size( 'feature-image-thumb', 990, 370, true );
	add_image_size( 'approach-image-crop', 298, 535 );
	add_image_size( 'events-thumb', 80, 50 );
}

function resizeEventThumb($src) {
	$ext = substr($src, -4);
	$new_src = str_replace($ext, '', $src);
	$new_src .= '-80x50' . $ext;
	
	return $new_src;
}

function doHighlightNavItem($pageids,$post) {
	//return $post->post_parent;
        if (is_page($pageids)) { 
            return 'current_page_item'; 
        } 
        else if (in_array($post->post_parent, $pageids)) { 
            return 'current_page_parent';
        }
        else {
            return 'none';
        }
}

// show admin bar only for admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

/*function doSalesforceConnect() {
	define("CLIENT_ID", "3MVG9rFJvQRVOvk76HFkrf6Gy8E62Ml.1zEVsP_nY8aiJLmki38crrU8y2vN5kYeuRPyupGJNsoOL8jChrRrz");
	define("CLIENT_SECRET", "1334055187063761624");
	define("REDIRECT_URI", "https://www.pencilsofpromise.org/resttest/oauth_callback.php");
	define("LOGIN_URI", "https://login.salesforce.com");
    require_once ('resttest/oauth.php');
}*/

function doSalesforceConnect() {
    $platform_options = get_option('pop_platform_options');
    define("USERNAME", $platform_options['platform_sf_un']);
    define("PASSWORD", $platform_options['platform_sf_pw']);
    define("SECURITY_TOKEN", $platform_options['platform_sf_api']);
    require_once ('soapclient/SforcePartnerClient.php');
    $mySforceConnection = new SforcePartnerClient();
    $mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
    return $mySforceConnection;
}

function doPlatformLogin($user,$mySforceConnection) {
    $loginId;
    $loginId=get_user_meta($user->ID, 'userSalesforce', true);
    if (!$loginId) {
        $loginEmail=$user->user_email;
        if ($loginEmail) {
            $query = "SELECT Id FROM Contact WHERE Email = '".$loginEmail."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $loginId = $record->Id;
                update_usermeta($current_user->ID, 'userSalesforce', $loginId);
            }
        }    
    }
    return $loginId;
}

function doCache() {
    $platform_options = get_option('pop_platform_options');
    return $platform_options['platform_cache'];
}

function percent($num_amount, $num_total) {
    if ($num_amount==0 || $num_total==0) { return 0;}
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    return $count;
}

//Platform Donation Class
class Donation {
    var $id,$date,$name,$amount,$contact,$fundraiser,$anonymous;

    function Donation($id,$date,$name,$amount,$contact,$fundraiser,$anonymous) {
        $this->id=$id;
        $this->date=$date;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->amount=$amount;
        $this->contact=$contact;
        $this->fundraiser=htmlspecialchars(stripslashes($fundraiser));
        $this->anonymous=$anonymous;
    }

    static function sort_date($a, $b)
    {
        $al = strtolower($a->date);
        $bl = strtolower($b->date);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }

    static function sort_amount($a, $b) {
        $al = strtolower($a->amount);
        $bl = strtolower($b->amount);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }
    
}

//Platform Fundraiser (Full) Class
class Fundraiser {
    var $id,$name,$type,$impact,$description,$status,$goal,$raised,$photo,$video,$marketing,$isclub;

    function Fundraiser($id,$name,$type,$impact,$description,$status,$goal,$raised,$photo,$video,$marketing,$isclub) {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->type=$type;
        $this->impact=$impact;     
        $this->description=str_replace('rnrn','<br/><br/>',htmlspecialchars(stripslashes($description)));
        $this->status=htmlspecialchars(stripslashes($status));
        $this->goal=$goal;
        $this->raised=$raised;
        $this->photo=$photo;
        $this->video=$video;
        $this->marketing=$marketing;
        $this->isclub=$isclub;
    }

    static function sort_raised($a, $b) {
        $al = strtolower($a->raised);
        $bl = strtolower($b->raised);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }
    
}

//Platform Fundraiser (Quick) Class
class FundraiserQuick {
    var $id,$name,$description,$goal,$raised,$photo,$marketing,$isclub,$percent;

    function FundraiserQuick($id,$name,$description,$goal,$raised,$photo,$marketing,$isclub='') {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->description=str_replace('rnrn',' ',htmlspecialchars(stripslashes($description)));
        $this->goal=$goal;
        $this->raised=$raised;
        $this->photo=$photo;
        $this->isclub=$isclub;
        $this->marketing=$marketing;
        $this->percent=percent($raised, $goal);
    }

    static function sort_raised($a, $b) {
        $al = strtolower($a->raised);
        $bl = strtolower($b->raised);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }

    static function sort_percent($a, $b) {
        $al = strtolower($a->percent);
        $bl = strtolower($b->percent);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }    
    
    static function filter_marketing_impossible($var) {     
        return (strtolower($var->marketing)=='impossible');
    }     

    static function filter_marketing_s4a($var) {     
        return (strtolower($var->marketing)=='schools4all');
    }      
    
}

//Platform Group (Full) Class
class Group {
    var $id,$name,$description,$zip,$affiliation,$members,$goal,$raised,$photo,$jointype,$fundraisers,$status;

    function Group($id,$name,$description,$zip,$affiliation,$members,$goal,$raised,$photo,$jointype,$fundraisers,$status) {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->description=str_replace('rnrn','<br/><br/>',htmlspecialchars(stripslashes($description)));
        $this->zip=$zip;
        $this->affiliation=$affiliation;
        $this->members=$members;        
        $this->goal=$goal;
        $this->raised=$raised;
        $this->photo=$photo;
        $this->jointype=$jointype;
        $this->fundraisers=$fundraisers;
        $this->status=htmlspecialchars(stripslashes($status));
    }

    static function sort_raised($a, $b) {
        $al = strtolower($a->raised);
        $bl = strtolower($b->raised);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }
    
}

//Platform Group (Quick) Class
class GroupQuick {
    var $id,$name,$description,$members,$raised,$goal,$photo,$fundraisers;

    function GroupQuick($id,$name,$description,$members,$raised,$goal,$photo,$fundraisers) {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->description=str_replace('rnrn',' ',htmlspecialchars(stripslashes($description)));
        $this->members=$members;      
        $this->raised=$raised;
        $this->goal=$goal;
        $this->photo=$photo;
        $this->fundraisers=$fundraisers;
        $this->percent=percent($raised, $goal);
    }

    static function sort_raised($a, $b) {
        $al = strtolower($a->raised);
        $bl = strtolower($b->raised);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }

    static function sort_percent($a, $b) {
        $al = strtolower($a->percent);
        $bl = strtolower($b->percent);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }      
    
}

//Platform Contact (Full) Class
class Contact {
    var $id,$name,$description,$status,$goal,$raised,$donated,$photo,$ripple,$marketing,$hasName;

    function Contact($id,$name,$description,$status,$goal,$raised,$donated,$photo,$ripple,$marketing) {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->description=htmlspecialchars(stripslashes($description));
        $this->status=htmlspecialchars(stripslashes($status));
        $this->goal=$goal;
        $this->raised=$raised;
        $this->donated=$donated;
        $this->photo=$photo;
        $this->ripple=$ripple;
        $this->marketing=$marketing;
        $hasName = true;
        if ($this->name == "Platform Anonymous") {
            $hasName=false;   
        }
        $this->hasName=$hasName; 
    }

    static function sort_raised($a, $b) {
        $al = strtolower($a->raised);
        $bl = strtolower($b->raised);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }
    
}

//Platform Contact (Quick) Class
class ContactQuick {
    var $id,$name,$photo,$ripple,$hasName;

    function ContactQuick($id,$name,$photo,$ripple,$email = null) {
        $this->id=$id;
        $this->name=htmlspecialchars(stripslashes($name));
        $this->photo=$photo;
        $this->email=$email;
        $this->ripple=$ripple;
        $hasName = true;
        if ($this->name == "Platform Anonymous") {
            $hasName=false;   
        }
        $this->hasName=$hasName;        
    }

    static function sort_name($a, $b) {
        $al = strtolower($a->name);
        $bl = strtolower($b->name);
        if ($al == $bl) {
            return 0;
        }
        return ($bl > $al) ? +1 : -1;
    }
    
}

//Platform Contact (Full) Class
class User {
    var $id,$firstname,$lastname,$description,$status,$goal,$photo,$birthdate,$email,$postcode,$marketing;

    function User($id,$firstname, $lastname,$description,$status,$goal,$photo,$birthdate,$email,$postcode) {
        $this->id=$id;
        $this->firstname=htmlspecialchars(stripslashes($firstname));
        $this->lastname=htmlspecialchars(stripslashes($lastname));
        $this->description=htmlspecialchars(stripslashes($description));
        $this->status=htmlspecialchars(stripslashes($status));
        $this->goal=$goal;
        $this->photo=$photo;
        $this->birthdate=$birthdate;
        $this->email=$email;
        $this->postcode=$postcode;
    }
  
}

//Platform Contact (Quick) Class
class PlatformStats {
    var $groupCount, $fundCount, $campaignTotal;

    function PlatformStats($groupCount, $fundCount, $campaignTotal) {
        $this->groupCount=$groupCount;
        $this->fundCount=$fundCount;
        $this->campaignTotal=$campaignTotal;
    }
    
}

/* returns the shortened url */
function bitlyLink($url,$format='txt') {
  $login = 'pencilsofpromiseteam';
  $appkey='R_d8c99e8c26a02e7b79b424b7d5efaa7c';
  $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
  return curl_get_result($connectURL);
}

/* returns a result form url */
function curl_get_result($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function curPageURL() {
 $pageURL="http://www.pencilsofpromise.org";
 $SNAME = $_SERVER["SERVER_NAME"];
 if (strpos("development",$SNAME) === false && strpos("staging",$SNAME) === false  && strpos("localhost",$SNAME) === false) {
     $RURI = str_replace("&r=1", "", $_SERVER["REQUEST_URI"]);
     $pageURL = 'http';
     if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
     $pageURL .= "://";
     if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$RURI;
     } else {
      $pageURL .= $_SERVER["SERVER_NAME"].$RURI;
     }
 }
 return $pageURL;
}

?>