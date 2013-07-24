function start() {
        var button;
        var userInfo;
        
        window.fbAsyncInit = function() {
            FB.init({ appId: '197934993616615', //change the appId to your appId
                status: true, 
                cookie: true,
                xfbml: true,
                oauth: true});

           showLoader(true);
           
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
                        showLoader(true);
                        FB.login(function(response) {
                            if (response.authResponse) {
                                FB.api('/me', function(info) {
                                    login(response, info);
                                });	   
                            } else {
                                //user cancelled login or did not grant authorization
                                showLoader(false);
                            }
                        }, {scope:'email,user_birthday,status_update,publish_stream,user_about_me'});  	
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
                var accessToken                                 =   response.authResponse.accessToken;

                fqlQuery();

                userInfo.innerHTML                             = '<img src="https://graph.facebook.com/' + info.id + '/picture">' + info.name;
                button.innerHTML                               = 'Logout';
                showLoader(false);
                document.getElementById('other').style.display = "block";

fqlQuery();
            }
        }
    
        function logout(response){
            userInfo.innerHTML                             =   "";
            document.getElementById('debug').innerHTML     =   "";
            document.getElementById('other').style.display =   "none";
            showLoader(false);
        }



		   };
		
		
        //stream publish method
        function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
            showLoader(true);
            FB.ui(
            {
                method: 'stream.publish',
                message: '',
                attachment: {
                    name: name,
                    caption: '',
                    description: (description),
                    href: hrefLink
                },
                action_links: [
                    { text: hrefTitle, href: hrefLink }
                ],
                user_prompt_message: userPrompt
            },
            function(response) {
                showLoader(false);
            });

        }
        function showStream(){  //publish FB wall post
            FB.api('/me', function(response) {
                //console.log(response.id);
                streamPublish('My Fundraiser for Pencils of Promise', 'Please help me advocate Pencils of Promise and build schools in the developing world one pencil at a time.', response.name, 'http://fundraise.pencilsofpromise.org/' + response.name, "Share PoP");
            });
        }

        function share(){
            showLoader(true);
            var share = {
                method: 'stream.share',
                u: 'http://fundraise.pencilsofpromise.org/' //fundraising page
            }; 

            FB.ui(share, function(response) { 
                showLoader(false);
                console.log(response); 
            });
        }

        function donationStreamPublish(){ //graphapi for donation
            showLoader(true);
            
            FB.api('/me/feed', 'post', 
                { 
                    message     : "Please help me advocate Pencils of Promise and build schools in the developing world one pencil at a time.",
                    link        : "http://fundraise.pencilsofpromise.org/' + response.name'",
                    picture     : 'http://www.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/whoweareImage3.png',
                    name        : 'My Fundraiser for Pencils of Promise',
                    description : 'Pencils of Promise partners with local communities to build schools and increase educational opportunities in the developing world. We focus on early education, high potential females and empowering a new generation of passionate young leaders to create profound good.'
                    
            }, 
            function(response) {
                showLoader(false);
                
                if (!response || response.error) {
                    alert('Error occured');
                } else {
                    alert('Post ID: ' + response.id);
                }
            });
        }

        function fqlQuery(){
            showLoader(true);
            
            FB.api('/me', function(response) {
                showLoader(false);
                
                //http://developers.facebook.com/docs/reference/fql/user/
                var query       =  FB.Data.query('select name, first_name, last_name, profile_url, email, about_me, activities, movies, sex, pic_small from user where uid={0}', response.id);
                query.wait(function(rows) {
                   document.getElementById('debug').innerHTML =  
                     'FQL Information: '+  "<br />" + 
                     'Your Full Name: '      +  rows[0].name                                                            + "<br />" +
					 'Your First Name: '      +  rows[0].first_name                                                            + "<br />" +
					 'Your Last Name: '      +  rows[0].last_name                                                            + "<br />" +
                     'Your Sex: '       +  (rows[0].sex!= undefined ? rows[0].sex : "")                            + "<br />" +
					 'Your Email: '       +  rows[0].email                            + "<br />" +
					 'Your About Me: '       +  rows[0].about_me                            + "<br />" +
					 'Your Activities: '       +  rows[0].activities                         + "<br />" +
                     'Your Movies: '       +  rows[0].movies                         + "<br />" +
					'Your Profile: '   +  "<a href='" + rows[0].profile_url + "'>" + rows[0].profile_url + "</a>" + "<br />" +
                     '<img src="'       +  rows[0].pic_small + '" alt="" />' + "<br />";


//<!---  #########################   Call Javascript Variable to TextForm -->	
document.getElementById('User_Full_Name').value = rows[0].name;
document.getElementById('User_First_Name').value = rows[0].first_name;
document.getElementById('User_Last_Name').value = rows[0].last_name;
document.getElementById('User_Sex').value = rows[0].sex!= undefined ? rows[0].sex : "";
document.getElementById('User_Email').value = rows[0].email;
document.getElementById('User_About_Me').value = rows[0].about_me;
document.getElementById('User_Movies').value = rows[0].movies;
document.getElementById('User_Profile_Pic').value = rows[0].pic_small;
//<!---document.forms["User_Info"].submit(); -->
                 });

            });

						
			}

        function setStatus(){  //write post on FB wall
            showLoader(true);
            
            status1 = document.getElementById('status').value;
            FB.api(
              {
                method: 'status.set',
                status: status1
              },
              function(response) {
                if (response == 0){
                    alert('Your Facebook status not updated. Give Status Update Permission.');
                }
                else{
                    alert('Your Facebook status updated');
                }
                showLoader(false);
              }
            );
        }
        
        function showLoader(status){
            if (status)
                document.getElementById('loader').style.display = 'block';
            else
                document.getElementById('loader').style.display = 'none';
        }
