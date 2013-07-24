<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Test Donate
*/
?>

<?php get_header(); ?>
<?php 
$url = "https://api.sandbox.paypal.com/v1/oauth2/token";
$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                'Accept-Language: en_US '             
                                                                          
);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: OAuth $access_token"));

    $json_response = curl_exec($curl);
    curl_close($curl);
    curl https://api.sandbox.paypal.com/v1/oauth2/token \
 -H "Accept: application/json" \
 -H "Accept-Language: en_US" \
 -u "EOJ2S-Z6OoN_le_KS1d75wsZ6y0SFdVsY9183IvxFyZp:EClusMEUk8e9ihI7ZdVLF5cZ6y0SFdVsY9183IvxFyZp" \
 -d "grant_type=client_credentials"

?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/paypal-button.min.js?merchant=JFCEK5V2URB9G" 
    data-button="donate" 
    data-name="Donation" 
    data-shipping="0" 
    data-tax="0" 
    data-callback="https://local2/popnew/test-donate" 
    data-env="sandbox"
></script>

<?php get_footer(); ?>