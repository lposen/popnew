<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Dashboard For Recurring Payments
*/

get_header();

do_action('pp_donation_dashboard');

$headtext = "Your Account";
if (count($profiles) > 0){
    $headtext = "Your Account";
}
//print_r($register_errors);
if ( (isset($register_errors)) && (count($register_errors) > 0) ){
?>
<script>
$(document).ready(function()
{
	editAccount();
});

</script>
<?php
}

?>
<div id="managecontainer">
	<h1 id="manage" class="BebasNeue text_gold">Manage your donations</h1>
	<div id="managebox">
		<input type="button" class="gold_button" onclick="editAccount();" value="Edit" />
		<p><?php echo $headtext ?></p>
	</div>
</div>
<?php
$i = 1;
foreach ($profiles as $profile) {
    if ($profile->billingperiod == "Month") {
        $billingperiod = "/gfx/manageImgMonthly.png";
    }
    if ($profile->billingperiod == "Year") {
        $billingperiod = "/gfx/manageYearly.png";
    }
    
    if ($profile->cardtype == "Amex") {
        $lastFourDigits = "****-******-*" . $profile->last_four_digits; 
    } else {
        $lastFourDigits = "****-****-****-" . $profile->last_four_digits; 
    }
    ?>
<div class="donationcontainer">
	<p class="number">Donation <?php echo $i; ?></p>
	<div class="details">
		<sup>$</sup><span class="fancy-serif amount"><?php echo $profile->amount ?></span> on a <img src="<?php bloginfo('template_directory'); echo $billingperiod; ?>" alt="" /> basis
	</div>
	<div class="payment-options">
		<input id="mrd" type="button" onclick="showModifyRecurringDonation('<?php echo $profile->amount ?>', '<?php echo $profile->rp_id ?>');" value="" />
		<input id="crd" type="button" onclick="cancelRecurringDonation('<?php echo $profile->rp_id ?>');" value="" />
	</div>
	<p class="number">Payment Method</p>
	<div class="payment-method">
		<img src="<?php bloginfo('template_directory'); echo '/gfx/manageImgCC' . $profile->cardtype . '.png'; ?>" alt="" /> <?php echo $lastFourDigits; ?> <input id="mpm" type="button" onclick="showModifyPaymentMethod('<?php echo $profile->rp_id ?>');" value="" />
	</div>
</div>
    <?php
    $i++;
}
?>
<div id="result"></div>
<script>
$('input[name=new_amount]').live('keydown', function(evt) {
	if(evt.keyCode == '13') {
		ConvertToDays(this.value, .32);
	}
});

$('input[name=new_amount]').live('blur', function(evt) {
	ConvertToDays(this.value, .32);
});

$('#days').live('keydown', function(evt) {
	if(evt.keyCode == '13') {
		ConvertToMoney(this.value, .32);
	}
});

$('#days').live('blur', function(evt) {
	ConvertToMoney(this.value, .32);
});

function ConvertToDays(amount, d) {
	var new_value = amount;
	var first_value = new_value.substr(0, 1);
	if(first_value == '$') {
		new_value = parseInt(new_value.substr(1));	
	} else {
		new_value = parseInt(new_value);
	}
	var donation = new_value / d;
	    donation = Math.round(donation);
	
	if(donation > 365) {
		var days = donation / 365;
		donation = Math.round(days*10)/10;
		$('.donationfield span.days-text').text('year(s)');
	} else {
		$('.donationfield span.days-text').text('day(s)');
	}
	
	$('#days').val(donation);
}

function ConvertToMoney(amount, d) {
	if(amount > 365) {
		$('.donationfield span.days-text').text('year(s)');
	} else {
		$('.donationfield span.days-text').text('day(s)');
	}
	var donation = amount*d;
		donation = Math.round(donation);
	var donation_amt = donation;
	if(isNaN(donation_amt)) {
		var newer_value = 0;
	}

	if(donation_amt < 1000) {
		var newer_value = donation_amt+'.00';
	} else {
		var newer_value = donation_amt;
	}
	$('#money').val(newer_value);
}
	
function cancelRecurringDonation(rpid) {
	$('#result').html("");
    $.get('<?php echo $my_paypalpro->cancel_recurring_donation_url ?>', { rp_id: rpid }, function(data) {
        $('#result').html(data);
    	$("#result" ).dialog({
    		height: 300,
    		width: 509,
    		modal: true,
    		dialogClass: 'modal result-cancel'
    	});
    });
}

function showModifyRecurringDonation(amount, rpid) {
	$('#result').html("");
    $.get('<?php echo $my_paypalpro->modify_recurring_donation_url ?>', { current_amount: amount, rp_id: rpid }, function(data) {
        $('#result').html(data);
    	$("#result" ).dialog({
    		height: 325,
    		width: 509,
    		modal: true,
    		dialogClass: 'modal result-donate'
    	});
    });
}

function showModifyPaymentMethod(rpid) {
	window.location = "<?php echo $my_paypalpro->modify_payment_method_url ?>?rp_id=" + rpid;
}

function showModifyPaymentMethod_old(rpid) {
	$('#result').html("");
    $.get('<?php echo $my_paypalpro->modify_payment_method_url ?>', { rp_id: rpid }, function(data) {
        $('#result').html(data);
    	$("#result" ).dialog({
    		height: 800,
    		width: 800,
    		modal: true
    	});
    });
}

function editAccount() {
	$('#result').html("");
    $.get('<?php echo $my_paypalpro->edit_account_url ?>', '', function(data) {
        $('#result').html(data);
    	$("#result" ).dialog({
    		height: 530,
    		width: 509,
    		modal: true,
    		dialogClass: 'modal result-pay'
    	});
    });
}

function closeMe(success) {
	$("#result").dialog("close");
	if(success){
		location.reload();
	}
}

function sendData(sendTo, formId, dialogH, dialogW){
	$.post(sendTo, $("#" + formId).serialize(), function(data) {
		$('#result').html(data);
		$("#result" ).dialog({
			height: dialogH,
			width: dialogW,
			modal: true
		});
	});
}

</script>

<?php

get_footer();

ob_end_flush();
?>