<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Direct Payment Donation Form
*/
?>
<?php 
	get_header();
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>
<script type="text/javascript">
    $(document).ready(function()
    {
    	initDonate(2);
        CheckCountrySelection();
        $("input").click(function () {
            $(this).removeClass('inputerror');
        });
        $("#country").click(function () {
            CheckCountrySelection();
        });
        $("#state").focus(function () {
            $(this).removeClass('inputerror');
        });
        $("#province").focus(function () {
            $(this).removeClass('inputerror');
        });
    });

    function CheckCountrySelection() {
        var country = $('#country option:selected').val();
        if (country == "US") {
            ShowStates();
            HideProvinces();
        }
        else if (country == "CA") {
            HideStates();
            ShowProvinces();
        }
        else {
            HideStates();
            HideProvinces();
        }
    }

    function ShowStates() {
        $("#staterow").show();
    }
    function HideStates() {
        $("#staterow").hide();
    }
    function ShowProvinces() {
        $("#provincerow").show();
    }
    function HideProvinces() {
        $("#provincerow").hide();
    }
</script>
<style>
.errortext {
	margin: 0;
	padding-top: 5px;
	font-size: 12px;
	color: #CC0000;
	font-weight: bold;
	text-align: right;
	clear: both;
}
.inputerror{
    background: none repeat scroll 0 0 #c25f5f !important;
}
</style>      

<div id="p_donate-goback" class="gold_button p_link"><a href="<?php bloginfo('url'); ?>/join-the-movement/donate">Back</a></div>

<?php do_action('pp_direct_payment_form'); ?>
<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>
