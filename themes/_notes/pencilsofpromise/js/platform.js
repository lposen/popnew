/* Function to just input numbers */
jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            return (
                key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};
/* ----  */

function validate(type,value,match,length) {
    if (type=='empty') {
     if (value=='' | value==null) {
         return false;
     }
     else {
         return true;
     }
    }
    if (type=='undefined') {
     if (value=='undefined' | value==null) {
         return false;
     }
     else {
         return true;
     }
    }
    else if (type=='length') {
     if (value.length<length) {
         return false;
     }
     else {
         return true;
     }
    }
    else if (type=='match') {
     if (value!=match) {
         return false;
     }
     else {
         return true;
     }
    }
else if (type=='int') {
     if (isNaN(value)) {
         return false;
     }
     else {
         return true;
     }
    }    
}

function doLoginForm() {
    if (!validate('empty', $('#platform_user_login').val(),null,null)) {
        $('#account_error_js').html('You must enter an email address.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_user_password').val(),null,null)) {
        $('#account_error_js').html('You must enter a password.');
        $('#account_error_js').show();
    }
    else {
        $('#platform_login_form').submit();
    }
}


function doAccountForm() {
    if (!validate('empty', $('#platform_register_first_name').val(),null,null)) {
        $('#account_error_js').html('You must enter a first name.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_last_name').val(),null,null)) {
        $('#account_error_js').html('You must enter a last name.');
        $('#account_error_js').show();
    }
    else if (!validate('int', $('#platform_register_birthday_day').val()+$('#platform_register_birthday_month').val()+$('#platform_register_birthday_year').val(),null,null)) {
        $('#account_error_js').html('You must enter a valid birthday.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_zip').val(),null,null)) {
        $('#account_error_js').html('You must enter a postal code.');
        $('#account_error_js').show();
    }
    else if (validate('empty', $('#platform_register_password').val(),null,null)) { //password is set
        if (!validate('match', $('#platform_register_password').val(),$('#platform_register_password_confirm').val(),null,null)) {
            $('#account_error_js').html('Your password confirmation does not match.');
            $('#account_error_js').show();
        }
        else if (!validate('length', $('#platform_register_password').val(),null,6)) {
            $('#account_error_js').html('Your password must be at least 6 characters.');
            $('#account_error_js').show();
        }  
        else {
            $('#platform_account_form').submit();        
        }
    }
    else {
        $('#platform_account_form').submit();
    }
}

function doSignupForm() {
    if (!validate('empty', $('#platform_register_first_name').val(),null,null)) {
        $('#account_error_js').html('You must enter a first name.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_last_name').val(),null,null)) {
        $('#account_error_js').html('You must enter a last name.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_email').val(),null,null)) {
        $('#account_error_js').html('You must enter an email address.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_password').val(),null,null)) {
        $('#account_error_js').html('You must enter a password.');
        $('#account_error_js').show();
    }
    else if (!validate('length', $('#platform_register_password').val(),null,6)) {
        $('#account_error_js').html('Your password must be at least 6 characters.');
        $('#account_error_js').show();
    }    
    else if (!validate('match', $('#platform_register_password').val(),$('#platform_register_password_confirm').val(),null,null)) {
        $('#account_error_js').html('Your password confirmation does not match.');
        $('#account_error_js').show();
    }
    else if (!validate('int', $('#platform_register_birthday_day').val()+$('#platform_register_birthday_month').val()+$('#platform_register_birthday_year').val(),null,null)) {
        $('#account_error_js').html('You must enter a valid birthday.');
        $('#account_error_js').show();
    }
    else if (!validate('empty', $('#platform_register_zip').val(),null,null)) {
        $('#account_error_js').html('You must enter a postal code.');
        $('#account_error_js').show();
    }
    else {
        $('#platform_signup_form').submit();
    }
}

function doFundForm(step, isChanged, theForm, fundId, type, preSetGoal) {
    if (step==1) {
        if (type=="save") {
                if (isChanged) {
                    $('#next').val('1');
                    theForm.submit();
                }
                else {
                    location.href='fundraiser?f='+fundId+'&n=1';   
                }
        }
        else if(type == "delete"){
        	$('#fund-action').val('delete');
        	theForm.submit();
        }
        else {
                if (!validate('undefined', $("input[name=fundtype]:checked").attr('id'),null,null)) {
                    $('#account_error_js_1').html('You must choose a campaign type.');
                    $('#account_error_js_1').show();                    
                }
                else {
                    if ($("input[name=fundtype]:checked").attr('id')=='fundtype-bld') { //if it's a schools prest goal
                        $('#fundgoal-25k').click();
                    }
                    else if (preSetGoal) {
                        if (preSetGoal=='250') { $('#fundgoal-0250').click(); }
                        else if (preSetGoal=='2500') { $('#fundgoal-2500').click(); }
                        else if (preSetGoal=='10000') { $('#fundgoal-10k').click(); }
                        else if (preSetGoal=='25000') { $('#fundgoal-25k').click(); }
                    }
                    $('#showOne').hide();
                    $('#showTwo').show();  
                }
        }
    }
    else if (step==2) {
        if (type=="save") {
                if (isChanged) {
                    $('#next').val('2');
                    theForm.submit();       
                }
                else {
                    location.href='fundraiser?f='+fundId+'&n=2';   
                }
        }
        else if (type=="back") {
                $('#showTwo').hide();
                $('#showOne').show();
        }
        else {
            // validation changed a little bit to work with empty fields
            if( !($('#fundgoal-amt').val()) ) {
                $('#account_error_js_2').html('You must enter a campaign goal amount.');
                $('#account_error_js_2').show();
            } else {            
                $('#showTwo').hide();
                $('#showThree').show(); 
            }

        }
    }
    else if (step==3) {
        if (type=="save") {
                if (isChanged) {
                    $('#next').val('3');
                    theForm.submit();                 
                }
                else {
                    location.href='fundraiser?f='+fundId+'&n=3';   
                }
        }
        else if (type=="back") {
                $('#showThree').hide();
                $('#showTwo').show();
        }        
        else {
            if (!validate('empty', $('#fundname').val(),null,null)) {
                $('#account_error_js_3').html('You must enter a campaign name.');
                $('#account_error_js_3').show();
            }
            else if (!validate('empty', $('#funddescription').val(),null,null)) {
                $('#account_error_js_3').html('You must enter a campaign description.');
                $('#account_error_js_3').show();
            }
            else {
                theForm.submit();
            }
        }
    }  
}


function doGroupForm(step, isChanged, theForm, groupId, type) {
    if (step==1) {
        var doSubmit = false;
        if (type=="save") {
            if (isChanged) {
                $('#next').val('1');
                doSubmit=true;    
            }
            else if (groupId) {
                location.href='group?g='+groupId+'&n=1';
            }
        }
        else {
            if (isChanged) {
                doSubmit=true;
            }
            else if (groupId) {
                location.href='manage?g='+groupId+'&n=2';
            }            
        }
        if (doSubmit) {
            if (!validate('empty', $('#clubname').val(),null,null)) {
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('#account_error_js_1').html('You must enter a group name.');
                $('#account_error_js_1').show();
            }
            else if (!validate('empty', $('#clubdescription').val(),null,null)) {
                $('html, body').animate({ scrollTop: 0 }, 0);
                $('#account_error_js_1').html('You must enter a group description.');
                $('#account_error_js_1').show();
            }
            else {
                theForm.submit();
            }
        }
    }
    else if (step==2) {
        buildInviteList();
            if (type=="save") {
                if ($('#clubinvitees').val()!="") {
                    $('#next').val('2');
                    theForm.submit();          
                }
                else {
                    location.href='manage?g='+groupId+'&n=2';    
                }             
            }
            else if (type=="back") {
                    location.href='manage?g='+groupId+'&n=1';
            }
            else {
                if ($('#clubinvitees').val()!="") {
                    theForm.submit();
                }
                else {
                    location.href='manage?g='+groupId+'&n=3';    
                }
            }
    }
    else if (step==3) {
       if (type=="back") {
            location.href='manage?g='+groupId+'&n=2';
       }
    }    
}

function addMemberInvite() {
        var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
        var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added

        // create the new element via clone(), and manipulate it's ID using newNum value
        var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

        // manipulate the name/id values of the input inside the new element
        newElem.children(':first').attr('id', 'invite' + newNum).attr('name', 'invite' + newNum, 'value','');
        // insert the new element after the last "duplicatable" input field
        $('#input' + num).after(newElem);
        $('#invite'+ newNum).val("");
        // enable the "remove" button
        $('#btnDel').show();
        
        // business rule: you can only add 5 names
        if (newNum == 5)
            $('#btnAdd').hide();
}

function removeMemberInvite() {
        var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
        $('#input' + num).remove();     // remove the last element

        // enable the "add" button
        $('#btnAdd').show();

        // if only one element remains, disable the "remove" button
        if (num-1 == 1)
            $('#btnDel').hide();
}

function buildInviteList() {
  buildString = "";
  for (i=1; i<=5; i++) {
      if ($('#invite'+i).val()) {
        buildString+=$('#invite'+i).val() + " ";
      }
  }
  $('#clubinvitees').val(buildString);
} 

//handle any image radio buttons for the platform
(function($) {

	$.fn.screwDefaultButtons = function(options) {
	options = $.extend($.fn.screwDefaultButtons.defaults, options);
		
		var checkedImage = options.checked;
		var uncheckedImage = options.unchecked;
		var disabledImage = options.disabled;
		var disabledCheckImage = options.disabledChecked;
		var selectAllBtn = options.selectAll;
		var width = options.width;
		var height = options.height;
		
		
		var checkPath = checkedImage.slice(4,-1);
		var uncheckPath = uncheckedImage.slice(4,-1);
		
		$('body').append('<img class="preloadCheck" src="' + checkPath + '" width="0" height="0" />');
		$('body').append('<img class="preloadUnCheck" src="' + uncheckPath + '" width="0" height="0"  />');
		$('.preloadCheck').fadeOut(0);
		$('.preloadUnCheck').fadeOut(0);
		
		if($(this).is(":radio")){
			// ------------ Styled Radio Buttons ---------------
                        if ($(this).parent().attr('id')!="") {
			var radioButton = $(this);
			$(radioButton).wrap('<div class="styledRadio" ></div>').hide();
			$('.styledRadio').css({width: width, height:height});
                        if ($(this).attr('id').indexOf('checkbox-')!=-1) {
                            $('.styledRadio').css({'float': 'left', 'margin':'15px 8px 0 0'});
                        }
                        else {
                            $('.styledRadio').css({'float': 'left', 'margin':'15px 40px'});
                        }
                        $(radioButton).parent().css({"background-image":uncheckedImage});
			$(radioButton).filter(':checked').parent().addClass('checked').css({"background-image":checkedImage});

			if (disabledImage !== false || disabledCheckImage !== false ){
				$(radioButton).filter(':disabled').each(function(){
					if ($(this).is(':checked')){
						$(this).parent().addClass('disabled').css({"background-image":disabledCheckImage});	
					}
					else {
						$(this).parent().addClass('disabled').css({"background-image":disabledImage});	
					}
				});
			}
			
			$(radioButton).each(function(){
				var radioButtonClass = $(this).attr('class');
				var radioButtonClick = $(this).attr('onclick');
				$(this).parent().addClass(radioButtonClass);
				$(this).parent().attr('onclick',radioButtonClick );
			});


			$('.styledRadio').click(function(){
				
				if(!($(this).hasClass('disabled'))){
				
					thisCheckName = $(this).find("input:radio").attr("name");
		
					if(!($(this).hasClass('checked'))){ 
						$('.selected').removeClass('selected')
						$(this).addClass('checked').addClass('selected')
						.css({backgroundImage:checkedImage})
						.find('input:radio')
							.attr('checked','checked')
							.trigger('change');
						$('.styledRadio').each(function(){
							otherCheckName = $(this).find("input:radio").attr("name")
							if(otherCheckName == thisCheckName){
								if(!($(this).hasClass('selected'))){
									if($(this).hasClass('disabled')){
										$(this).removeClass('checked');
										$(this).css({backgroundImage:disabledImage});
									}
									else {
										$(this).removeClass('checked');
                                        if ($(this).css("backgroundImage").indexOf('spc')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_spc.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('set')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_set.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('bday')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bday.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('bld')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bld.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('0250')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_0250.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('2500')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_2500.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('10k')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_10k.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('25k')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_25k.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('onetime')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_onetime.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('monthly')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_monthly.png)');
                                        }
                                        else if ($(this).css("backgroundImage").indexOf('yearly')>-1) {
                                            $(this).css('background-image','url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_yearly.png)');
                                        }
									}	
								}
							}
						});
					}
				}
			});
			
			
			$('label').click(function(){
				var labelFor = $(this).attr('for');
				var radioForMatch = $('input:radio').filter('#' + labelFor);
				if(!($(radioForMatch).is(':disabled'))){
					var thisCheckName = radioForMatch.attr("name");
					if (!(radioForMatch.parent().hasClass("checked"))){
						$('.selected').removeClass('selected');
						radioForMatch.attr('checked','checked').trigger('change');
						radioForMatch.parent().addClass('checked').addClass('selected')
							.css({backgroundImage:checkedImage});
							
						$('.styledRadio').each(function(){
							otherCheckName = $(this).find("input:radio").attr("name")
							if(otherCheckName == thisCheckName){
								if(!($(this).hasClass('selected'))){
									if($(this).hasClass('disabled')){
										$(this).removeClass('checked')
										.css({backgroundImage:disabledImage});
									}
									else {
										$(this).removeClass('checked')
										.css({backgroundImage:uncheckedImage});
									}
								}
							}
						});
					}
				}
			});
			
			// ------------------------------------------------
			
		}
                }
		else if ($(this).is(":checkbox")){
			
			// -------------- Styled Checkboxes ---------------
			var checkbox = $(this);
			
			$(checkbox).wrap('<div class="styledCheckbox" ></div').hide();
			$('.styledCheckbox').css({backgroundImage:uncheckedImage, width: width, height:height});
			$(checkbox).filter(':checked').parent().addClass('checked').css({"background-image":checkedImage});
			
			if (disabledImage !== false || disabledCheckImage !== false ){
				$(checkbox).filter(':disabled').each(function(){
					if ($(this).is(':checked')){
						$(this).parent().addClass('disabled').css({"background-image":disabledCheckImage});	
					}
					else {
						$(this).parent().addClass('disabled').css({"background-image":disabledImage});	
					}
				});
			}
			
			$(checkbox).each(function(){
				var checkboxClass = $(this).attr('class');
				var checkboxClick = $(this).attr('onclick');
				
				$(this).parent().addClass(checkboxClass);
				$(this).parent().attr('onclick',checkboxClick );
			});
			
			$('.styledCheckbox').click(function(){						
				if(!($(this).hasClass('disabled'))){
												
					if(!($(this).hasClass('checked'))){
						$(this).addClass('checked')
						.css({"background-image":checkedImage})
						.find('input:checkbox')
							.attr('checked','checked')
							.trigger('change');	
					}
					else{
						$(this).removeClass('checked')
						.css({"background-image":uncheckedImage})
						.find('input:checkbox')
							.removeAttr('checked','checked')
							.trigger('change');
						$(selectAllBtn).removeAttr('checked','checked')
							.parent('.styledCheckbox')
							.removeClass('checked')
							.css({"background-image":uncheckedImage});
					}
					
					
					if (selectAllBtn != null){
						if ($(this).find('input:checkbox').is(selectAllBtn)){
							if($(this).hasClass('checked')){
								$(checkbox).each(function(){
									$(this).attr('checked','checked')
									.trigger('change')
									.parent('.styledCheckbox')
									.addClass('checked')
									.css({"background-image":checkedImage});
								});
							}
							else {
								$(checkbox).each(function(){
									$(this).removeAttr('checked','checked')
									.trigger('change')
									.parent('.styledCheckbox')
									.removeClass('checked')
									.css({"background-image":uncheckedImage});
								});
							}
						}
					}
				
				}
			});
			
			
			$('label').click(function(){
				var labelFor = $(this).attr('for');
				var radioForMatch = $('input:checkbox').filter('#' + labelFor);
				if (!(radioForMatch.parent().hasClass("checked"))){
					if ( $.browser.msie ) {
                        if( $.browser.version == 7.0 || $.browser.version == 8.0 ){
                            radioForMatch.attr('checked','checked')
                                .trigger('change')
                                .parent('.styledCheckbox')
                                .addClass('checked')
                                .css({"background-image":checkedImage});
					  
					
						if (radioForMatch.is(selectAllBtn)){
							$(checkbox).each(function(){
								$(this).attr('checked','checked')
								.trigger('change')
								.parent('.styledCheckbox')
								.addClass('checked')
								.css({"background-image":checkedImage});
							});
						}
					
					  }
					}
				}	
				else if (radioForMatch.parent().hasClass("checked")){
					if ( $.browser.msie ) {
					  if( $.browser.version == 7.0 || $.browser.version == 8.0 ){
						radioForMatch.removeAttr('checked','checked')
							.trigger('change')
							.parent('.styledCheckbox')
							.removeClass('checked')
							.css({"background-image":uncheckedImage});
						
					  
						$(selectAllBtn).removeAttr('checked','checked')
							.trigger('change')
							.parent('.styledCheckbox')
							.removeClass('checked')
							.css({"background-image":uncheckedImage});
						
					  }
					}
				}
			});
			// ------------------------------------------------
		}
		
		$('.styledRadio').css({'cursor':'pointer', "background-repeat":"no-repeat"});
		$('.styledCheckbox').css({'cursor':'pointer', "background-repeat":"no-repeat"});

	};
	
	
	$.fn.screwDefaultButtons.defaults = {
		checked: 	"url(images/radio_Checked.jpg)",
		unchecked:	"url(images/radio_Unchecked.jpg)",
		disabled:	false,
		disabledChecked:	false,
		selectAll:  null,
		width:		20,
		height:		20
	};



})(jQuery);

function donateRadios() {
            $('#checkbox-00').screwDefaultButtons({
                    checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_onetime_on.png)",
                    unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_onetime.png)",
                    width:		148,
                    height:		60
           });
            $('#checkbox-01').screwDefaultButtons({
                    checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_monthly_on.png)",
                    unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_monthly.png)",
                    width:		148,
                    height:		60
           });
            $('#checkbox-02').screwDefaultButtons({
                    checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_yearly_on.png)",
                    unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_donation_recurring_yearly.png)",
                    width:		148,
                    height:		60
           }); 
}


//do textarea maxlengths
$(document).ready(function() {
    $('textarea[maxlength]').keyup(function(){  
        //get the limit from maxlength attribute  
        var limit = parseInt($(this).attr('maxlength'));  
        //get the current text inside the textarea  
        var text = $(this).val();  
        //count the number of characters in the text  
        var chars = text.length;  
  
        //check if there are more characters then allowed  
        if(chars > limit){  
            //and if there are use substr to get the text before the limit  
            var new_text = text.substr(0, limit);  
  
            //and change the current text with the new text  
            $(this).val(new_text);  
        }
    });  

    // invoke the 'ForceNumericOnly' function
    $("#fundgoal-amt").ForceNumericOnly();
  
}); 