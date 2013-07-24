<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 Template Name: Our People
 */

get_header(); ?>

<style>
    body {
      background:#fff
      font-size:13px;
    }
    #wrap {
      position:relative;
      width:220px;
      margin:50px auto 0;
    }
    #header{position:relative;line-height:1em;}
    .filterform {
      width:220px;
      font-size:12px;
      display:block;
	  float: right;
    }
    .filterform input {
      -moz-border-radius:5px;
      border-radius:5px;
      -webkit-border-radius:5px;
    }
   </style>
   

	<div id="primary" class="site-content">
    
		

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
                
                

                <?php 
				$uIDs = $wpdb->get_col("SELECT ID FROM $wpdb->users WHERE user_status = 0");
				shuffle($uIDs);
				array_rand($uIDs);
				$data = array(
					'hide_empty' => false,
					'echo' => false,
					'style' => none
				);
				
				foreach($uIDs as $uID) { 
					$theirTitle = get_user_meta($uID, 'userTitle', true);
				}
				?>
                  
                <section id="options">
                	<ul id="filters" class="option-set" data-option-key="filter">
                      <li><a href="#" data-option-value="*" data-filter="*" class="selected">show all</a></li>
                      <li><a href="#" data-option-value=".leadership" data-filter=".leadership">leadership</a></li>
                      <li><a href="#" data-option-value=".staff" data-filter=".staff">staff</a></li>
                      <li><a href="#" data-option-value=".advisory" data-filter=".advisory">advisory</a></li>
                      <li><a href="#" data-option-value=".board" data-filter=".board">board</a></li>
                    </ul>
                    <form class="peoplefilter">
                        <input type="text" id="filterinput">
                    </form>
                </section>
                <span class="clearfix"></span>
                <ul id="content" class="people clearfix" role="main">
                
				<?php 
				$authors_arr = explode(',', wp_list_authors($data));
				$i=0;
				foreach($authors_arr as $author) {
				  $info = get_userdata($i++);
				  $user_id = $info->ID;
				  $first_name = $info-> user_firstname;
				  $last_name = $info-> user_lastname;
				  $avtr = get_avatar($user_id, 130);
				  $title = $info-> userTitle;
				  $user_title 	= get_user_meta($user_id, 'userTitle', true);
				  $subtitle = $info-> userSubtitle;
				  if ($user_title != "hidden" && $user_title == "leadership" && $user_id != $adamID) {
					  $peopleclass= 'leadership';
				  };
				  if ($user_title != "hidden" && $user_title == "staff" && $user_id != $adamID) {
					   $peopleclass= 'staff';
				  };
				  if ($user_title != "hidden" && $user_title == "advisory" && $user_id != $adamID) {
					   $peopleclass= 'advisory';
				  };
				  if ($user_title != "hidden" && $user_title == "board" && $user_id != $adamID) {
					   $peopleclass= 'board';
				  };
				  if ($user_title == "hidden" || $first_name == "") {
					  $peopleclass= 'none';
				  }
				  echo ' <li class="element ' . $peopleclass . '"><div class="drop-shadow">'.$avtr.'<div style="margin-top: 3px;" class="name">'.$first_name.' '.$last_name.'</div><div class="subtitle">'.$subtitle.'</div></div></li>';
				};
?>
			<?php endwhile; // end of the loop. ?>
</ul>
		</div><!-- #content -->
	</div><!-- #primary -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/jquery.isotope.js'?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/fake-element.js'?>"></script>
<script src="https://raw.github.com/riklomas/quicksearch/master/jquery.quicksearch.js" type="text/javascript"></script>
<script>
$(function() {
   var $content = $('#content');
	$content.isotope({
	  // options
	  itemSelector : '.element',
	  layoutMode : 'fitRows'
	});
    
	var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
		
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
		
		var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
       	$content.isotope( options );
        return false;
      });
    
    $('input#filterinput').quicksearch('#content .element', {
        'show': function() {
            $(this).addClass('quicksearch-match');
        },
        'hide': function() {
            $(this).removeClass('quicksearch-match');
        }
    }).keyup(function(){
        setTimeout( function() {
            $content.isotope({ filter: '.quicksearch-match' }).isotope(); 
        }, 100 );
    });
	});
	;

</script>
<script>
/*$(document).ready(function() {
    // custom css expression for a case-insensitive contains()
  jQuery.expr[':'].Contains = function(a,i,m){
      return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  };
	
	function listFilter(header, list) { // header is any element, list is an unordered list
    // create and add the filter form to the header
    var form = $("<form>").attr({"class":"filterform","action":"#"}),
        input = $("<input>").attr({"class":"filterinput","type":"text","placeholder":"Beuler?"});
    $(form).append(input).appendTo(header);
	
	var $content = $('#content');
	$content.isotope({
	  // options
	  itemSelector : '.element',
	  layoutMode : 'fitRows'
	});
	
	var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
		
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        $('input.filterinput').quicksearch('#content .element', {
        'show': function() {
            $(this).addClass('quicksearch-match');
        },
        'hide': function() {
            $(this).removeClass('quicksearch-match');
        }
    }).keyup(function(){
        setTimeout( function() {
            $content.isotope({ filter: '.quicksearch-match' }).isotope(); 
        }, 100 );
    });
	  
/*	  $(input)
      .change( function () {
		 	var filter1 = $(this).val();
			//var filtername = $content.isotope({
			  //getSortData : {
				//	name : function ( $elem ) {
				//	return $elem.find('.name').text(filter1);
				//}
		//	});
        	if(filter1) {
          // this finds all links in a list that contain the input,
          // and hide the ones not containing the input while showing the ones that do
		//		$('.element').addClass(filtername);
		//	}
          $(list).find(".name:not(:Contains(" + filter1 + "))").parent().parent().hide();
          $(list).find(".name:Contains(" + filter1 + ")").parent().parent().show();
		  
		  //value = value === 'false' ? false : value;
       } 
       	
        return false;
      })
    .keyup( function () {
		
        // fire the above change event after every letter
        $(this).change();
		$content.isotope( 'reLayout');
		
    });
	
	var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
       	$content.isotope( options );
        return false;
      });
  }
	  
	  $(function () {
    listFilter($("#options"), $("#content"));
  });
});*/
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>