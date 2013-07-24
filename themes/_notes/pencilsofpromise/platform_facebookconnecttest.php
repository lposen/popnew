<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform FBTEST
*/
?>

<!DOCTYPE html>
<html xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>New JavaScript SDK & OAuth 2.0 based FBConnect Tutorial | Thinkdiff.net</title>
        <!--
            @author: Mahmud Ahsan (http://mahmud.thinkdiff.net)
        -->
    </head>
    <body>
        <div id="fb-root"></div>
        <script type="text/javascript">
            var button;
            var userInfo;

            window.fbAsyncInit = function() {
                FB.init({ appId: '449055625110934', //change the appId to your appId
                    status: true,
                    cookie: true,
                    xfbml: true,
                    oauth: true});

               function updateButton(response) {
                    button       =   document.getElementById('fb-auth');
                    userInfo     =   document.getElementById('user-info');

                    if (response.authResponse) {
                        //user is already logged in and connected
                        FB.api('/me', function(info) {
                            login(response, info);
                        });

                        button.onclick = function() {
                            FB.logout(function(response) {
                                logout(response);
                            });
                        };
                    } else {
                        //user is not connected to your app or logged out
                        button.innerHTML = 'Login';
                        button.onclick = function() {
                            FB.login(function(response) {
                                if (response.authResponse) {
                                    FB.api('/me', function(info) {
                                        login(response, info);
                                    });
                                } else {
                                    //user cancelled login or did not grant authorization
                                }
                            }, {login:'email,user_birthday,user_about_me'});
                        }
                    }
                }

                // run once with current status and whenever the status changes
                FB.getLoginStatus(updateButton);
                FB.Event.subscribe('auth.statusChange', updateButton);
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol
                    + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());


            function login(response, info){
                if (response.authResponse) {
                    var accessToken = response.authResponse.accessToken;
                    var query_result_sex;
                    var query_result_pic;
                    var query_result_bdate;
					FB.api('/me', function(response) {
						var query =  FB.Data.query('select name, birthday_date, sex, pic_big from user where uid={0}', response.id);
						query.wait(function(rows) {
						   query_result_bdate = rows[0].birthday_date;
						   query_result_sex = rows[0].sex;
						   query_result_pic = rows[0].pic_big;
                    	   button.innerHTML = 'Logout';;
                    	   var url = "http://localhost/process?fb_first_name="+escape(info.first_name)+"&fb_last_name="+escape(info.last_name)+"&fb_email="+escape(info.email)+"&fb_id="+escape(info.id)+"&fb_birthday="+escape(query_result_bdate)+"&fb_gender="+escape(query_result_sex)+"&fb_bigpic="+escape(query_result_pic);
						   userInfo.innerHTML = '<img src="https://graph.facebook.com/' + info.id + '/picture">' + info.name + "<br /> Your Access Token: " + accessToken + "<br/> Your Registration URL is: " + url;
						 });
					});
                }
            }

            function logout(response){
                userInfo.innerHTML                             =   "";
                document.getElementById('debug').innerHTML     =   "";
                document.getElementById('other').style.display =   "none";
            }

            function fqlQuery(){

                FB.api('/me', function(response) {
                    //http://developers.facebook.com/docs/reference/fql/user/
                    var query       =  FB.Data.query('select name, profile_url, sex, pic_small from user where uid={0}', response.id);
                    query.wait(function(rows) {
                       document.getElementById('debug').innerHTML =
                         'FQL Information: '+  "<br />" +
                         'Your name: '      +  rows[0].name                                                            + "<br />" +
                         'Your Sex: '       +  (rows[0].sex!= undefined ? rows[0].sex : "")                            + "<br />" +
                         'Your Profile: '   +  "<a href='" + rows[0].profile_url + "'>" + rows[0].profile_url + "</a>" + "<br />" +
                         '<img src="'       +  rows[0].pic_small + '" alt="" />' + "<br />";
                     });
                });
            }

        </script>

        <h3>New JavaScript SDK & OAuth 2.0 based FBConnect Tutorial | Thinkdiff.net</h3>
        <button id="fb-auth">Login</button>
            <img src="/wp-content/themes/pencilsofpromise/gfx/ajax-loader.gif" alt="loading" />
        </div>
        <br />
        <div id="user-info"></div>
        <br />
        <div id="debug"></div>
    </body>
</html>