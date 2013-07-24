<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Modify Payment Method
*/
//do_action('ajaxDecideNextStep');
get_header();

if(!isset($_REQUEST['save_modify_method'])){
    do_action('pp_modify_payment_method');
}
?>
<div>
<div class="account_error">
<?php
if (isset($donation_errors)) {
    foreach ($donation_errors as $error) {
        echo $error . "<br />";
    } 
}

?>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
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

    function GoBack() {
    	window.location = "<?php echo $my_paypalpro->donation_dashboard_url ?>";
    }
</script>

<form method='POST' id="modify_method_form" name="modify_method_form" action='<?php echo $_SERVER['REQUEST_URI'] ?>'>
<input type="hidden" name="rp_id" value="<?php echo $_REQUEST['rp_id'] ?>" />

<div class="step">
<div class="explanation">Fill in the form to submit your donation with
card of choice.</div>
<div class="form-container">
<div class="step-padding<?php if (isset($pp_errors['fname'])) echo " error"?>">
<input type='text' id='fname' name='fname' class="input-donate"
	value='<?php
        echo htmlSafe($fname);
        ?>' />
                    <?php
        if (isset($pp_errors['fname'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['fname']?></div><span class="input-error"></span>
                    <?php
        }
        ?>
			</div>
<div class="form-divider"></div>
<div class="step-padding<?php if (isset($pp_errors['lname'])) echo " error"?>">
<input type='text' id='lname' name='lname' class="input-donate"
	value='<?php
        echo htmlSafe($lname);
        ?>' />
                    <?php
        if (isset($pp_errors['lname'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['lname']?></div><span class="input-error"></span>
                    <?php
        }
        ?>
			</div>
<div class="form-divider"></div>

<div class="step-padding<?php if (isset($pp_errors['address1'])) echo " error"?>">
<input type='text' id='address1' name='address1' class="input-donate"
	value='<?php
        echo htmlSafe($address1);
        ?>' />
                    <?php
        if (isset($pp_errors['address1'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['address1']?></div><span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div class="step-padding<?php if (isset($pp_errors['city'])) echo " error"?>">
<input type='text' id='city' name='city' class="input-donate"
	value='<?php
        echo htmlSafe($city);
        ?>' />
                    <?php
        if (isset($pp_errors['city'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['city']?></div><span class="input-error"></span>
                    <?php
        }
        ?>
</div>
<div class="form-divider"></div>

<div id="provincerow" class="step-padding<?php if (isset($pp_errors['province'])) echo " error"?>"><label for="province">Province:</label>
<div class="form-selects">                    
<?php
        echo formSelect('province', $province, $province_select, 
            '-- Select --');
        if (isset($pp_errors['province'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['province']?></div><span class="input-error"></span>
                    <?php
        }
        ?>
</div>
<div class="clearfix"></div>
</div>
<div id="staterow" class="step-padding<?php if (isset($pp_errors['state'])) echo " error"?>"><label for="state">State:</label>
<div class="form-selects">                    
<?php echo formSelect('state', $state, $state_select, '-- Select --'); ?>
</div>
<?php if (isset($pp_errors['state'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['state']?></div><span class="input-error"></span>
                    <?php
        } ?>
<div class="clearfix"></div>
</div>

<div class="form-divider"></div>

<div class="step-padding<?php if (isset($pp_errors['zip'])) echo " error"?>">
<input type='text' id='zip' name='zip' class="input-donate"
	value='<?php
        echo htmlSafe($zip);
        ?>' />
                    <?php
        if (isset($pp_errors['zip'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['zip']?></div><span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div class="step-padding<?php if (isset($pp_errors['country'])) echo " error"?>"><label for="country">Country:</label>
<div class="form-selects">                    
<?php echo formSelect('country', $country, $country_select);?>
</div>
<?php if (isset($pp_errors['country'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['country']?></div><span class="input-error"></span>
                    <?php
        } ?>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>

<div class="step-padding<?php if (isset($pp_errors['eaddr'])) echo " error"?>">
<input type='text' id='eaddr' name='eaddr' class="input-donate"
	value='<?php
        echo htmlSafe($eaddr);
        ?>' />
                    <?php
        if (isset($pp_errors['eaddr'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['eaddr']?></div><span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div class="step-padding"><label for="cc_type">Credit card type:</label>
<div class="form-selects">                    <?php
        echo formSelect('cc_type', $cc_type, $credit_cards);
        ?>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div class="step-padding<?php if (isset($pp_errors['cc_num'])) echo " error"?>">
<input type='text' id='cc_num' name='cc_num' class="input-donate"
	value='<?php
        echo htmlSafe($cc_num);
        ?>' />
                    <?php
        if (isset($pp_errors['cc_num'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['cc_num']?></div><span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>
<div class="step-padding"><label for="expiration-month">Expiration:</label>
<div class="form-selects">
<?php
        echo expMonthDropdown('cc_exp_month', $cc_exp_month);
        ?>
<?php

        echo expYearDropdown('cc_exp_year', $cc_exp_year);
        ?>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div class="step-padding<?php if (isset($pp_errors['cc_cvc'])) echo " error"?>">
<div id="cvv-help"><strong>Where's my CVV?</strong> <img
	src="<?php
        bloginfo('template_directory');
        ?>/gfx/donateMoney2CVV.png"
	alt="Where's my CVV?" /> <span>Amex: Front</span> <span>Visa/MC/Discover:
Back</span></div>
<input type='text' id='cc_cvc' name='cc_cvc' class="input-donate"
	value='<?php
        echo htmlSafe($cc_cvc);
        ?>' />
                    <?php
        if (isset($pp_errors['cc_cvc'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['cc_cvc']?></div><span class="input-error"></span>
                    <?php
        }
        ?></div>

<!--  -->
<br/>

</div>
</div>
<div class="step" style="padding-top: 10px;">
<div class="step-padding"><input type="submit" name="save_modify_method" value="Save" class="formsubmit methodsave" />
<input type="button" onclick="GoBack();" name="go_back" value="Cancel" class="formsubmit" /><br />
<input type="hidden" name="old_cc_type" value="<?php echo htmlSafe($cc_type) ?>" />
<input type="hidden" name="old_cc_num" value="<?php echo htmlSafe($cc_num) ?>" />
<input type="hidden" name="old_cc_exp_month" value="<?php echo htmlSafe($cc_exp_month) ?>" />
<input type="hidden" name="old_cc_exp_year" value="<?php echo htmlSafe($cc_exp_year) ?>" />
</form>
</div>
<?php 
get_footer();
ob_end_flush();
?>