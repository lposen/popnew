<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Credit
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
	color: #fff;
	font-weight: bold;
	text-align: right;
	clear: both;
}
.inputerror{
    background: none repeat scroll 0 0 #c25f5f !important;
}
</style> 
<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_donate_now.jpg');"></div>        

<div id="p_donate-goback" class="gold_button p_link"><a href="<?php bloginfo('url'); ?>/join-the-movement/donate">Back</a></div>

<h2 id="p_almost-there">Almost finished...</h2>
<hr class="dotted_grey">
<div class="clearfix"></div>
<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_four.png"></div>
<div class="explanation">Review the donation and the impact it will make
</div>
<div class="form-container">
<div
    class="step-padding">
<div id="change-impact"></div>
<div id="change-amount"></div>
<input type='text' id="input-amt2" maxlength="8" name='amount'
    value='$100.00' /> <span class="amount-copy-provides">enables</span> <input
    type="text" name="days" id="input-days2" /> <span
    class="amount-copy-days">Days</span>
<div class="clearfix"></div>
                </div>
</div></div>
<hr class="dotted_grey">
<form method='POST' id="ppp_form" name="ppp_form"
    action='/join-the-movement/donate/enter-your-payment-information'>
<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_five.png"></div>
<div class="explanation">Fill in the form to submit your donation with
card of choice.</div>
<div class="form-container">
<div
    class="step-padding">
    <span>First Name: </span>
<input type='text' id='fname' name='fname' class="input-donate"
    value='' />
                                </div>
<div class="form-divider"></div>
<div
    class="step-padding">
    <span>Last Name: </span>
<input type='text' id='lname' name='lname' class="input-donate"
    value='' />
                                </div>
<div class="form-divider"></div>

<div
    class="step-padding">
    <span>Billing Address: </span>
<input type='text' id='address1' name='address1' class="input-donate"
    value='' />
                    </div>
<div class="form-divider"></div>

<div
    class="step-padding">
    <span>City: </span>
<input type='text' id='city' name='city' class="input-donate"
    value='' />
                    </div>
<div class="form-divider"></div>

<div id="provincerow"
    class="step-padding"><label
    for="province">Province:</label>
<div class="form-selects">                    
<SELECT id='province' name='province' >
<OPTION VALUE=''>-- Select --</OPTION>
<OPTION VALUE='AB'>Alberta</OPTION>
<OPTION VALUE='BC'>British Columbia</OPTION>
<OPTION VALUE='MB'>Manitoba</OPTION>
<OPTION VALUE='NB'>New Brunswick</OPTION>
<OPTION VALUE='NL'>Newfoundland and Labrador</OPTION>
<OPTION VALUE='NT'>Northwest Territories</OPTION>
<OPTION VALUE='NS'>Nova Scotia</OPTION>
<OPTION VALUE='NU'>Nunavut</OPTION>
<OPTION VALUE='ON'>Ontario</OPTION>
<OPTION VALUE='PE'>Prince Edward Island</OPTION>
<OPTION VALUE='QC'>Quebec</OPTION>
<OPTION VALUE='SK'>Saskatchewan</OPTION>
<OPTION VALUE='YT'>Yukon Territory</OPTION>
</SELECT>
</div>
<div class="clearfix"></div>
</div>
<div id="staterow"
    class="step-padding"><label
    for="state">State:</label>
<div class="form-selects">                    
<SELECT id='state' name='state' >
<OPTION VALUE=''>-- Select --</OPTION>
<OPTION VALUE='AL'>Alabama</OPTION>
<OPTION VALUE='AK'>Alaska</OPTION>
<OPTION VALUE='AZ'>Arizona</OPTION>
<OPTION VALUE='AR'>Arkansas</OPTION>
<OPTION VALUE='CA'>California</OPTION>
<OPTION VALUE='CO'>Colorado</OPTION>
<OPTION VALUE='CT'>Connecticut</OPTION>
<OPTION VALUE='DE'>Delaware</OPTION>
<OPTION VALUE='DC'>District of Columbia</OPTION>
<OPTION VALUE='FL'>Florida</OPTION>
<OPTION VALUE='GA'>Georgia</OPTION>
<OPTION VALUE='HI'>Hawaii</OPTION>
<OPTION VALUE='ID'>Idaho</OPTION>
<OPTION VALUE='IL'>Illinois</OPTION>
<OPTION VALUE='IN'>Indiana</OPTION>
<OPTION VALUE='IA'>Iowa</OPTION>
<OPTION VALUE='KS'>Kansas</OPTION>
<OPTION VALUE='KY'>Kentucky</OPTION>
<OPTION VALUE='LA'>Louisiana</OPTION>
<OPTION VALUE='ME'>Maine</OPTION>
<OPTION VALUE='MD'>Maryland</OPTION>
<OPTION VALUE='MA'>Massachusetts</OPTION>
<OPTION VALUE='MI'>Michigan</OPTION>
<OPTION VALUE='MN'>Minnesota</OPTION>
<OPTION VALUE='MS'>Mississippi</OPTION>
<OPTION VALUE='MO'>Missouri</OPTION>
<OPTION VALUE='MT'>Montana</OPTION>
<OPTION VALUE='NE'>Nebraska</OPTION>
<OPTION VALUE='NV'>Nevada</OPTION>
<OPTION VALUE='NH'>New Hampshire</OPTION>
<OPTION VALUE='NJ'>New Jersey</OPTION>
<OPTION VALUE='NM'>New Mexico</OPTION>
<OPTION VALUE='NY'>New York</OPTION>
<OPTION VALUE='NC'>North Carolina</OPTION>
<OPTION VALUE='ND'>North Dakota</OPTION>
<OPTION VALUE='OH'>Ohio</OPTION>
<OPTION VALUE='OK'>Oklahoma</OPTION>
<OPTION VALUE='OR'>Oregon</OPTION>
<OPTION VALUE='PA'>Pennsylvania</OPTION>
<OPTION VALUE='RI'>Rhode Island</OPTION>
<OPTION VALUE='SC'>South Carolina</OPTION>
<OPTION VALUE='SD'>South Dakota</OPTION>
<OPTION VALUE='TN'>Tennessee</OPTION>
<OPTION VALUE='TX'>Texas</OPTION>
<OPTION VALUE='UT'>Utah</OPTION>
<OPTION VALUE='VT'>Vermont</OPTION>
<OPTION VALUE='VA'>Virginia</OPTION>
<OPTION VALUE='WA'>Washington</OPTION>
<OPTION VALUE='WV'>West Virginia</OPTION>
<OPTION VALUE='WI'>Wisconsin</OPTION>
<OPTION VALUE='WY'>Wyoming</OPTION>
</SELECT>
</div>
<div class="clearfix"></div>
</div>

<div class="form-divider"></div>

<div
    class="step-padding">
    <span>Zip Code: </span>
<input type='text' id='zip' name='zip' class="input-donate"
    value='' />
                    </div>
<div class="form-divider"></div>

<div
    class="step-padding"><label
    for="country">Country:</label>
<div class="form-selects">                    
<SELECT id='country' name='country' >
<OPTION VALUE='US'>United States</OPTION>
<OPTION VALUE='AR'>Argentina</OPTION>
<OPTION VALUE='AU'>Australia</OPTION>
<OPTION VALUE='AT'>Austria</OPTION>
<OPTION VALUE='BS'>Bahamas</OPTION>
<OPTION VALUE='BH'>Bahrain</OPTION>
<OPTION VALUE='BE'>Belgium</OPTION>
<OPTION VALUE='BM'>Bermuda</OPTION>
<OPTION VALUE='BO'>Bolivia</OPTION>
<OPTION VALUE='BR'>Brazil</OPTION>
<OPTION VALUE='BG'>Bulgaria</OPTION>
<OPTION VALUE='CA'>Canada</OPTION>
<OPTION VALUE='CL'>Chile</OPTION>
<OPTION VALUE='CO'>Colombia</OPTION>
<OPTION VALUE='CY'>Cyprus</OPTION>
<OPTION VALUE='DK'>Denmark</OPTION>
<OPTION VALUE='EC'>Ecuador</OPTION>
<OPTION VALUE='EG'>Egypt</OPTION>
<OPTION VALUE='ES'>Espanol/Spain</OPTION>
<OPTION VALUE='FI'>Finland</OPTION>
<OPTION VALUE='FR'>France</OPTION>
<OPTION VALUE='GE'>Georgia</OPTION>
<OPTION VALUE='DE'>Germany</OPTION>
<OPTION VALUE='GI'>Gibraltar</OPTION>
<OPTION VALUE='GB'>Great Britain/England</OPTION>
<OPTION VALUE='GR'>Greece</OPTION>
<OPTION VALUE='GL'>Greenland</OPTION>
<OPTION VALUE='GU'>Guam (US)</OPTION>
<OPTION VALUE='GT'>Guatemala</OPTION>
<OPTION VALUE='HN'>Honduras</OPTION>
<OPTION VALUE='HK'>Hong Kong</OPTION>
<OPTION VALUE='HU'>Hungary</OPTION>
<OPTION VALUE='IS'>Iceland</OPTION>
<OPTION VALUE='IN'>India</OPTION>
<OPTION VALUE='IR'>Ireland</OPTION>
<OPTION VALUE='IE'>Ireland</OPTION>
<OPTION VALUE='IL'>Israel</OPTION>
<OPTION VALUE='IT'>Italy</OPTION>
<OPTION VALUE='JM'>Jamaica</OPTION>
<OPTION VALUE='JP'>Japan</OPTION>
<OPTION VALUE='JO'>Jordan</OPTION>
<OPTION VALUE='KE'>Kenya</OPTION>
<OPTION VALUE='KR'>Korea (South)</OPTION>
<OPTION VALUE='KW'>Kuwait</OPTION>
<OPTION VALUE='LI'>Liechtenstein</OPTION>
<OPTION VALUE='LU'>Luxembourg</OPTION>
<OPTION VALUE='MO'>Macau</OPTION>
<OPTION VALUE='MX'>Mexico</OPTION>
<OPTION VALUE='MC'>Monaco</OPTION>
<OPTION VALUE='MZ'>Mozambique</OPTION>
<OPTION VALUE='NA'>Namibia</OPTION>
<OPTION VALUE='NL'>Netherlands</OPTION>
<OPTION VALUE='NZ'>New Zealand</OPTION>
<OPTION VALUE='NI'>Nicaragua</OPTION>
<OPTION VALUE='NO'>Norway</OPTION>
<OPTION VALUE='PA'>Panama</OPTION>
<OPTION VALUE='PY'>Paraguay</OPTION>
<OPTION VALUE='PE'>Peru</OPTION>
<OPTION VALUE='PL'>Poland</OPTION>
<OPTION VALUE='PT'>Portugal</OPTION>
<OPTION VALUE='PR'>Puerto Rico (US)</OPTION>
<OPTION VALUE='QA'>Qatar</OPTION>
<OPTION VALUE='RO'>Romania</OPTION>
<OPTION VALUE='RW'>Rwanda</OPTION>
<OPTION VALUE='SA'>Saudi Arabia</OPTION>
<OPTION VALUE='SC'>Scotland</OPTION>
<OPTION VALUE='SG'>Singapore</OPTION>
<OPTION VALUE='ZA'>South Africa</OPTION>
<OPTION VALUE='SE'>Sweden</OPTION>
<OPTION VALUE='CH'>Switzerland</OPTION>
<OPTION VALUE='TW'>Taiwan</OPTION>
<OPTION VALUE='TZ'>Tanzania</OPTION>
<OPTION VALUE='TR'>Turkey</OPTION>
<OPTION VALUE='UA'>Ukraine</OPTION>
<OPTION VALUE='AE'>United Arab Emirates</OPTION>
<OPTION VALUE='UK'>United Kingdon</OPTION>
<OPTION VALUE='VE'>Venezuela</OPTION>
<OPTION VALUE='YU'>Yugoslavia</OPTION>
<OPTION VALUE='ZR'>Zaire</OPTION>
<OPTION VALUE='ZM'>Zambia</OPTION>
<OPTION VALUE='ZW'>Zimbabwe</OPTION>
</SELECT>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>

<div
    class="step-padding">
    <span>Email: </span>
<input type='text' id='eaddr' name='eaddr' class="input-donate"
    value='' />
                    </div>
<div class="form-divider"></div>

<div class="step-padding"><label for="cc_type">Credit card type:</label>
<div class="form-selects">                    <SELECT id='cc_type' name='cc_type' >
<OPTION VALUE='1'>Visa</OPTION>
<OPTION VALUE='2'>MasterCard</OPTION>
<OPTION VALUE='3'>Discover</OPTION>
</SELECT>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div
    class="step-padding">
    <span>Card Number: </span>
<input type='text' id='cc_num' name='cc_num' class="input-donate"
    value='' />
                    </div>
<div class="form-divider"></div>
<div class="step-padding"><label for="expiration-month">Expiration:</label>
<div class="form-selects">
<select id='cc_exp_month' name='cc_exp_month'><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06' SELECTED>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select><select id='cc_exp_year' name='cc_exp_year'><option value='2012'>2012</option><option value='2013'>2013</option><option value='2014'>2014</option><option value='2015'>2015</option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option><option value='2019'>2019</option><option value='2020'>2020</option><option value='2021'>2021</option></select></div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div class="step-padding">
<div id="cvv-help"><strong>Where's my CVV?</strong> <img
    src="http://staging.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/donateMoney2CVV.png"
    alt="Where's my CVV?" /> <!-- <span>Amex: Front</span> --> <span>Visa/MC/Discover:
Back</span></div>
    <span>CVV: </span>
<input type='text' id='cc_cvc' name='cc_cvc' class="input-donate"
    value='' style="
    margin-bottom: 20px;
" />
                    </div>
<div class="form-divider"></div>
</div>
<div class="clearfix"></div>
<p id="required">All fields required</p>
</div>
    <hr class="dotted_grey">
<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_six.png"></div>
<div class="explanation">Submit your donation to be processed</div>
<div>
<div><input type="hidden" id="payment_amount" name="amount"
    value="100.00" /><input type="hidden" id="fundraiser" name="fundraiser"
    value="a0GK00000042Ni0MAE" /><input type="hidden" id="anonymous" name="anonymous"
    value="0" /><input type="button" id="submitpayment"
    name="submitpayment"
    value="Click to submit donation"  class="grey_button p_link"/></div>
</div>
</div>
</form>

<style type="text/css" media="all">#avatar_footer { display: none; } /* Change this in Users > Avatars. */ </style><div id="avatar_footer">Avatars by <a href="http://www.sterling-adventures.co.uk/blog/">Sterling Adventures</a></div>        <div class="clearfix"></div>
    </div>    
    
  
<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>