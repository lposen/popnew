var Cackle=Cackle||{};
(function(){var H=location.protocol;
var E=H+"//cackle.me";
var A="4271996d252d+";
function I(){var J=document.createElement("img");
J.setAttribute("src",E+"/static/img/comment-wait.gif");
document.getElementById("mc-container").appendChild(J)
}function G(N,M,L,K){var J=N%10;
if((J==1)&&((N==1)||(N>20))){return N+" "+M
}else{if((J>1)&&(J<5)&&((N>20)||(N<10))){return N+" "+L
}else{return N+" "+K
}}}function C(l){I();
l(document).unbind(".cackle");
var g={google:{name:"Google",url:E+"/j_spring_openid_security_check?openid_identifier=https://www.google.com/accounts/o8/id"},googleplus:{name:"Google+",url:E+"/signin/googleplus/proxy?scope=https://www.googleapis.com/auth/userinfo.profile%20https://www.googleapis.com/auth/userinfo.email"},yahoo:{name:"Yahoo",url:E+"/j_spring_openid_security_check?openid_identifier=http://me.yahoo.com/"},yandex:{name:"Яндекс",url:E+"/j_spring_openid_security_check?openid_identifier=http://openid.yandex.ru"},vkontakte:{name:"Вконтакте",url:E+"/signin/vkontakte/proxy?scope=wall,offline,notify"},facebook:{name:"Facebook",url:E+"/signin/facebook/proxy?scope=email,status_update,offline_access"},twitter:{name:"Twitter",url:E+"/signin/twitter/proxy"},linkedin:{name:"Linkedin",url:E+"/signin/linkedin/proxy"},mymailru:{name:"Мой Мир@Mail.Ru",url:E+"/signin/mymailru/proxy?scope=stream"},odnoklassniki:{name:"Одноклассники",url:E+"/signin/odnoklassniki/proxy?scope=VALUABLE%20ACCESS"},mailru:{name:"Mail.Ru",label:"Введите ваше имя пользователя на Mail.ru",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.id.mail.ru/&openid_username={username}"},rambler:{name:"Рамблер",label:"Введите ваше имя пользователя на Рамблер",url:E+"/j_spring_openid_security_check?openid_identifier=http://id.rambler.ru/users/{username}&openid_username={username}"},myopenid:{name:"MyOpenID",label:"Введите ваше имя пользователя на MyOpenID",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.myopenid.com/&openid_username={username}"},livejournal:{name:"Живой Журнал",label:"Введите ваше имя в Живом Журнале",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.livejournal.com/&openid_username={username}"},flickr:{name:"Flickr",label:"Введите ваше имя на Flickr",url:E+"/j_spring_openid_security_check?openid_identifier=http://flickr.com/{username}/&openid_username={username}"},wordpress:{name:"Wordpress",label:"Введите ваше имя на Wordpress.com",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.wordpress.com/&openid_username={username}"},blogger:{name:"Blogger",label:"Ваш Blogger аккаунт",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.blogspot.com/&openid_username={username}"},verisign:{name:"Verisign",label:"Ваше имя пользователя на Verisign",url:E+"/j_spring_openid_security_check?openid_identifier=http://{username}.pip.verisignlabs.com/&openid_username={username}"}};
var o=null;
var O="";
var i="32";
var a=null;
var T=true;
var u=true;
var b=true;
var V=0;
var X=(typeof mcLocale!="undefined")?"&locale="+mcLocale:"";
var h={};
var c="";
var s=(typeof mcNoCss!="undefined")?mcNoCss:false;
var Y="";
var d="";
var j=false;
var p="standard";
var m=true;
var J;
var P;
var e=(typeof mcCallback!="undefined")?mcCallback:null;
var K=g;
var t={xPostProviders:{vkontakte:true,mymailru:true,facebook:true,twitter:true},content:"",init:function(){this.content=l("<div/>").addClass("mc-cleanslate").addClass("mc-content");
if(!s){this.loadCss()
}this.loadHtml();
l(".mc-postbox-container textarea",this.content).bind("keyup",q.textareaAutoResize);
l(".mc-user-logout",this.content).click(function(){n.logoutWindow()
})
},loadCss:function(){var v=l("<link>",{rel:"stylesheet",type:"text/css",href:E+"/static/css/comment-min.css?v="+A});
v.appendTo("head")
},loadHtml:function(){var v='<style type="text/css">${mcCss}</style>
<div class="mc-auth-container">
	<span class="mc-auth-label">${msg.from}</span>
	<div class="mc-auth-providers"></div>
</div>

<div class="mc-widget-container">
	<div class="mc-avatar-container">
		<img class="mc-avatar-img" src="${mcAnonymAvatar}" height="36" width="36">
			<span class="mc-user-logout">${msg.logout}</span>
	</div>
	<div class="mc-theme-${mcTheme}"><ul class="mc-comment-list"></ul></div>
	<div class="mc-pagination"><button class="mc-button mc-comment-next" title="0">${msg.nextComments}</button></div>
		<div class="mc-postbox-container">
		<div class="mc-editor">
			<div class="mc-editor-wrapper">
				<div class="mc-editor-message">
					<textarea placeholder="${msg.placeholder}">
					</textarea>
					<div class="mc-editor-controls">
						<div class="mc-spinner-control" style="display:none">
						</div>
						<div class="mc-attachmedia-control" title="${msg.media}">
						</div>
					</div>
				</div>
				<div class="mc-editor-media">
					<textarea placeholder="${msg.mediaPlaceholder}">
					</textarea>
					<div class="mc-editor-controls">
						<button class="mc-button mc-addmedia-control">${msg.add}</button>
					</div>
				</div>
			</div>
		</div>
		<div class="mc-submit">
			<span class="mc-social-xpost">
				<table><tbody><tr>
				<td>
				<input class="mc-social-xpost-checkbox" type="checkbox"/></td>
				<td><label>${msg.socialSubmit}</label></td>
				<td><span class="mc-social-xpost-icon"></span></td>
				</tr></tbody></table>
			</span>
			<button class="mc-button mc-comment-submit">${msg.submit}</button>
		</div>
		<div class="mc-info">
			<h4>${msg.commentCount}: 
				<span class="mc-comment-count">0</span>
			</h4>
		</div>
	</div>
</div>';
this.content.html(f.template(v,{mcCss:Y,mcAnonymAvatar:c,mcTheme:p}));
if(a){this.content.prepend(l("<h3></h3>").text(a))
}l("#mc-container").html(this.content);
this.buildCopyright();
this.buildAuthProviders();
this.buildLoggedUser(h);
this.initSocialXPost()
},buildCopyright:function(){var w=l("#mc-link");
if(!j&&(w.length==0||!w.is(":visible")||w.text()==="")){var v='<h6 class="mc-copyright"';
if(m===true){v+=' style="display:inline-block!important;"'
}v+='>powered by <a href="http://cackle.me"><b style="color:#4FA3DA!important">CACKL</b><b style="color:#F65077!important">E</b></a></h6>';
l(".mc-info",this.content).append(v)
}},buildAuthProviders:function(){var v=l(".mc-auth-providers",this.content);
if(typeof mcSSOProvider!="undefined"){this.buildSSOProvider(v)
}l.each(O.split(";"),function(w,x){if(K[x]){l(v).each(function(){l(this).append('<span class="mc-auth-provider mc-auth-'+x+'" title="'+K[x].name+'"/>')
})
}})
},buildSSOProvider:function(v){l(v).each(function(){var x=l('<span class="mc-sso-provider" title="'+mcSSOProvider.name+'"/>'),w=l('<img src="'+mcSSOProvider.logo+'"></img>');
x.append(w);
if(mcSSOProvider.width){x.css("width",mcSSOProvider.width);
w.css("width",mcSSOProvider.width)
}if(mcSSOProvider.height){x.css("height",mcSSOProvider.height);
w.css("height",mcSSOProvider.height)
}x.click(function(){n.loginWindow(mcSSOProvider.url,true)
});
l(this).append(x)
})
},buildLoggedUser:function(w){var v=l(".mc-avatar-container img",this.content);
if(w.id){v.attr("src",this.buildAvatarSrc(w,v.height()));
if(this.xPostProviders[w.provider]){this.showSocialXPost(w.provider)
}else{this.hideSocialXPost()
}l(".mc-user-logout",this.content).show()
}else{v.attr("src",this.buildAvatarSrc({avatar:c,id:w.id},v.height()));
l(".mc-user-logout",this.content).hide();
l(".mc-social-xpost",this.content).hide()
}},buildAvatarSrc:function(v,w){var x,y=w||i;
if(!v.avatar){if(u&&v.hash&&v.provider!="guest"){x="http://gravatar.com/avatar/"+v.hash+"?d=wavatar&r=PG&s="+y
}else{x=c
}}else{x=v.avatar
}return x
},buildWaitAvatar:function(){l(".mc-avatar-container img",this.content).attr("src",E+"/static/img/load-avatar.gif")
},showWaitComment:function(){l(".mc-info",this.content).append('<div class="mc-comment-wait"><img src="'+E+'/static/img/comment-wait.gif"/></div>')
},removeWaitComment:function(){l(".mc-info .mc-comment-wait",this.content).remove()
},initSocialXPost:function(){var v=this;
l(".mc-social-xpost-checkbox",this.content).click(function(){var x=l(".mc-social-xpost-icon",v.content),w=v.getSocialXPostProvider(x.attr("class"));
if(l(this).is(":checked")){k.create(w,"on",365)
}else{k.create(w,"off",365)
}})
},getSocialXPostProvider:function(w){var v="";
l.each(w.split(" "),function(x,y){if(y!="mc-social-xpost-icon"){v=y;
return 
}});
return v
},showSocialXPost:function(z){var v=k.read("mc-xpost-"+z),y=l(".mc-social-xpost-checkbox",this.content),w=l(".mc-social-xpost-icon",this.content),x=l(".mc-social-xpost",this.content);
if((b==false&&v!="on")||v=="off"){y.removeAttr("checked")
}else{y.attr("checked","checked")
}w.attr("class","mc-social-xpost-icon mc-xpost-"+z);
w.attr("title",z);
x.css("display","inline-block")
},hideSocialXPost:function(){l(".mc-social-xpost",this.content).css("display","none")
},setCommentCount:function(v){l(".mc-comment-count",this.content).text(v)
},upCommentCount:function(){var v=l(".mc-comment-count",this.content);
v.text(parseInt(v.text())+1)
}};
var Z={TEMPL:"",liCache:{},init:function(){if(p==="standard"){this.TEMPL='<li id="mc-${id}"><div class="mc-comment-wrapper mc-comment-${status}"><div class="mc-comment-head"><table><tbody><tr><td class="mc-comment-avatar-td"><a class="mc-comment-author" href="#"><img class="mc-avatar-img" src="${avatar}" style="height:${avatarSize}px!important;width:${avatarSize}px!important"><span class="mc-comment-provider mc-${provider}"></span></a></td><td class="mc-comment-user-td"><a class="mc-comment-username" href="${userWww}" author="${userId}" target="_blank">${userName}</a></td><td class="mc-comment-vote-td"><div class="mc-comment-vote"><table><tbody><tr><td class="mc-comment-rating mc-comment-rating-${ratingColor}" title="${msg.rating}">${rating}</td><td class="mc-comment-like"><a class="mc-comment-thumbsup" href="${likeUrl}" title="${msg.ratingUp}"><span></span></a></td><td class="mc-comment-unlike"><a class="mc-comment-thumbsdown" href="${unlikeUrl}" title="${msg.ratingDown}"><span></span></a></td></tr></tbody></table></div></td></tr></tbody></table></div><div class="mc-comment-body">${message}</div><div class="mc-comment-footer"><a class="mc-comment-created" href="${url}" timestamp="${timestamp}">${created}</a><a class="mc-comment-edit" href="#">${msg.edit}</a><a class="mc-comment-remove" href="#">${msg.remove}</a><span class="mc-comment-moderate"><a href="#">${msg.moderate}</a></span><a class="mc-comment-reply" href="#">${msg.answer}</a></div></div></li>'
}else{this.TEMPL='<li id="mc-${id}"><div class="mc-comment-user"><a class="mc-comment-author" href="#"><img class="mc-avatar-img" src="${avatar}" style="height:${avatarSize}px!important;width:${avatarSize}px!important"></a></div><div class="mc-comment-wrapper mc-comment-${status}"><div class="mc-comment-head"><a class="mc-comment-username" href="${userWww}" author="${userId}" target="_blank">${userName}</a><span class="mc-comment-bullet"> • </span><a class="mc-comment-created" href="${url}" timestamp="${timestamp}">${created}</a></div><div class="mc-comment-body">${message}</div><div class="mc-comment-footer"><span class="mc-comment-rating mc-comment-rating-${ratingColor}" title="${msg.rating}">${rating}</span><a class="mc-comment-thumbsup" href="${likeUrl}" title="${msg.ratingUp}"><span></span></a><span class="mc-comment-bullet"> • </span><a class="mc-comment-reply" href="#">${msg.answer}</a><span class="mc-comment-bullet"> • </span><a class="mc-comment-edit" href="#">${msg.edit}<span class="mc-comment-bullet"> • </span></a><a class="mc-comment-remove" href="#">${msg.remove}<span class="mc-comment-bullet"> • </span></a><span class="mc-share-container"><a href="#">${msg.share}</a><span class="mc-share-icons"><span class="mc-twitter"></span><span class="mc-facebook"></span><span class="mc-googleplus"></span><span class="mc-vkontakte"></span><span class="mc-odnoklassniki"></span><span class="mc-mymailru"></span></span></span><span class="mc-comment-moderate"><a href="#">${msg.moderate}</a></span></div></div></li>';
l(".mc-share-container").live("mouseover.cackle",function(){l(".mc-share-icons",this).css("display","inline-block")
});
l(".mc-share-container").live("mouseout.cackle",function(){l(".mc-share-icons",this).hide()
});
l(".mc-share-icons span").live("click.cackle",function(){var AA=l(this),y=AA.attr("class").replace("mc-",""),AC=AA.parents("li"),v=AA.parents(".mc-comment-wrapper"),w=l(".mc-comment-created",v).attr("href"),AB=l(".mc-comment-username",v).text(),AD=l(".mc-comment-body",v).text();
var z,x=l(".mc-comment-media a:first",v);
if(x.length>0){z=x.attr("href")
}else{z=l(".mc-comment-author img",AC).attr("src")
}N[y]({url:w,title:AB,text:AD,img:z})
})
}},findParent:function(AA,x){var v,z="#mc-"+AA,w;
if(this.liCache[z]){v=this.liCache[z]
}else{v=l("#mc-"+AA);
this.liCache[z]=v
}if(x=="approved"&&v.is(":hidden")){v.show();
l(v.parents("li")).each(function(){l(this).show()
})
}var y=l(v.children("ul.mc-comment-child"));
if(y.length){w=y
}else{w=l("<ul/>").addClass("mc-comment-child");
v.append(w)
}return w
},prepareData:function(AA){var x=AA.author,w=AA.anonym,AC,AB,AE,y="",AD="",AF="zero",v=AA.rating,AG=l("<div/>");
if(x){AB=x.id;
AE=x.name;
AD=x.provider;
if(x.www){if(x.www.match("^https?://")){y=x.www
}else{y="http://"+x.www
}}if(!x.avatar){if(u&&x.hash){AC="http://gravatar.com/avatar/"+x.hash+"?d=wavatar&r=PG&s="+i
}else{AC=c
}}else{AC=x.avatar
}}else{if(w){AB=w.id;
AE=w.name;
AC=c;
if(w.www){if(w.www.match("^https?://")){y=w.www
}else{y="http://"+w.www
}}}else{AB=0;
AE="";
AC=c
}}if(AE){var z=l("<div/>");
z.text(AE);
AE=z.html()
}if(v>0){v="+"+v;
AF="plus"
}else{if(v<0){AF="neg"
}}if(AA.message){AG.text(AA.message)
}else{AG.text(o["comment-"+AA.status])
}if(T){html=AG.html();
AG.html(q.replaceURLWithHTMLLinks(html))
}return{avatar:AC,userId:AB,userName:AE||o.guest,userWww:y||"#",provider:AD,ratingColor:AF,rating:v,message:AG.html()}
},buildCommentUrl:function(w){var v=q.getBeforeAnchor(window.location.href);
return v+"#mc-"+w
},appendComment:function(AA,AE){if(l("#mc-"+AA.id).length>0){return 
}var v=0,w=l(".mc-comment-list",t.content);
if(AA.parentId>0){w=this.findParent(AA.parentId,AA.status);
v=w.parents("li").length
}var AD=this.prepareData(AA),AC=f.template(this.TEMPL,{id:AA.id,status:AA.status,avatar:AD.avatar,userId:AD.userId,userName:AD.userName,userWww:AD.userWww,avatarSize:i,provider:AD.provider,ratingColor:AD.ratingColor,rating:AD.rating,likeUrl:E+"/comment/"+AA.id+"/vote/up",unlikeUrl:E+"/comment/"+AA.id+"/vote/down",message:AD.message,url:this.buildCommentUrl(AA.id),created:q.getTimeAgo(AA.created,o),timestamp:AA.created}),AB=l(AC),z=l(".mc-comment-body",AB),x=l(".mc-comment-footer",AB);
l(".mc-comment-reply",AB).click({handler:r},r.replyShow);
if(AA.message||AA.media){z.after(Q.makeContent(AA.message+" "+AA.media))
}if(V>0&&v>=V&&AA.status==="approved"){l(".mc-comment-reply, .mc-comment-bullet:first",x).remove()
}this.updateUserBtnsState(AD.userId,AA.created,AB);
var y=l(".mc-comment-moderate a",x);
S.bind(y);
if(AE){AB.hide();
w.prepend(AB);
AB.slideDown("slow")
}else{if(!h.paidAccount&&AA.status!="approved"){AB.hide()
}w.append(AB)
}},updateAppearance:function(){var v=this;
l(".mc-comment-list .mc-comment-wrapper",t.content).each(function(){var z=l(".mc-comment-created",this),y=parseInt(z.attr("timestamp")),x=q.getTimeAgo(y,o);
z.text(x);
var w=parseInt(l(".mc-comment-username",this).attr("author"));
v.updateUserBtnsState(w,y,this)
})
},updateUserBtnsState:function(w,x,v){this.updateUserBtnState(J,".mc-comment-edit",w,x,v);
this.updateUserBtnState(P,".mc-comment-remove",w,x,v)
},updateUserBtnState:function(y,z,x,AA,v){if(y==null&&h.id===x){l(z,v).show()
}else{if(y==0||h.id!=x){l(z,v).hide()
}else{if(y>0&&h.id===x){var w=new Date().getTime();
if(AA+(y*60*1000)<w){l(z,v).hide()
}else{l(z,v).show()
}}else{l(z,v).hide()
}}}},changeMessage:function(w,y){var x=l("<div/>"),v=l("#mc-"+w+" .mc-comment-body:first");
x.text(y);
if(T){html=x.html();
x.html(q.replaceURLWithHTMLLinks(html))
}v.html(x.html());
if(y){v.after(Q.makeContent(y))
}},changeRating:function(x,y){var v=l("#mc-"+x+" .mc-comment-rating:first"),w="mc-comment-rating-zero";
if(y>0){w="mc-comment-rating-plus";
y="+"+y
}else{if(y<0){w="mc-comment-rating-neg"
}}v.attr("class","mc-comment-rating");
v.addClass(w);
v.text(y)
},changeStatus:function(x,w){var v=l("#mc-"+x);
if(h.paidAccount){var y=v.children(".mc-comment-wrapper");
y.attr("class","mc-comment-wrapper mc-comment-"+w)
}else{if(w!="approved"){v.remove()
}}}};
var f={template:function(v,w){return v.replace(/\$\{([\s\S]+?)\}/g,function(x,y){if(y.indexOf("msg.")==0){return o[y.replace("msg.","")]
}return w[y]
})
}};
var N={vkontakte:function(v){url="http://vkontakte.ru/share.php?";
url+="url="+encodeURIComponent(v.url);
url+="&title="+encodeURIComponent(v.title);
url+="&description="+encodeURIComponent(v.text);
url+="&image="+encodeURIComponent(v.img);
url+="&noparse=true";
this.popup(url)
},odnoklassniki:function(v){url="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1";
url+="&st.comments="+encodeURIComponent(v.text);
url+="&st._surl="+encodeURIComponent(v.url);
this.popup(url)
},googleplus:function(v){url="https://plus.google.com/share?";
url+="&url="+encodeURIComponent(v.url);
this.popup(url)
},facebook:function(v){url="http://www.facebook.com/sharer.php?s=100";
url+="&p[title]="+encodeURIComponent(v.title);
url+="&p[summary]="+encodeURIComponent(v.text);
url+="&p[url]="+encodeURIComponent(v.url);
url+="&p[images][0]="+encodeURIComponent(v.img);
this.popup(url)
},twitter:function(w){var v=w.title.length+w.url.length+10,x;
if(w.text.length+v>140){x=w.text.substring(0,140-v)+"..."
}else{x=w.text
}url="http://twitter.com/share?";
url+="text="+encodeURIComponent('"'+x+'" - '+w.title);
url+="&url="+encodeURIComponent(w.url);
url+="&counturl="+encodeURIComponent(w.url);
this.popup(url)
},mymailru:function(v){url="http://connect.mail.ru/share?";
url+="url="+encodeURIComponent(v.url);
url+="&title="+encodeURIComponent(v.title);
url+="&description="+encodeURIComponent(v.text);
url+="&imageurl="+encodeURIComponent(v.img);
this.popup(url)
},popup:function(v){window.open(v,"","toolbar=0,status=0,width=626,height=436")
}};
var r={channel:"",url:"",title:"",demoCommentId:100,init:function(){this.initElements();
this.recive(null,this.initListeners);
l(".mc-comment-submit").click({handler:this,postbox:l(".mc-postbox-container")},this.commentSubmit);
l(".mc-comment-thumbsup,.mc-comment-thumbsdown").live("click.cackle",this.vote);
l(".mc-comment-list li div").live("mouseover.cackle",this.showModerateLink);
l(".mc-comment-list li div").live("mouseout.cackle",this.hideModerateLink);
l(".mc-comment-edit").live("click.cackle",this.editComment);
l(".mc-comment-remove").live("click.cackle",this.removeComment);
l(".mc-comment-username").live("click.cackle",function(w){var v=l(w.target);
if(v.attr("href")!="#"){return true
}return false
})
},initElements:function(){this.url=this.getUrl();
this.channel=this.getChannel();
this.title=encodeURIComponent(l("title").text().replace(/(\r\n|\n|\r)/gm,""))
},initListeners:function(v){l(document).mouseup(function(x){var w=l(".mc-comment-moderate");
if(w.has(x.target).length===0){l(".mc-comment-moderate .mc-controls").remove()
}})
},getUrl:function(){var v=window.location.href,w;
if(typeof mcUrl!="undefined"){w=mcUrl
}else{w=q.getBeforeAnchor(v)
}return w
},getChannel:function(){var v=window.location.href,w;
if(typeof mcChannel!="undefined"){w=mcChannel
}else{if(typeof mcUrl!="undefined"){w=q.getBeforeAnchor(mcUrl)
}else{w=q.getBeforeAnchor(v)
}}if(typeof w==="string"&&w.indexOf("https")==0){w=w.replace("https","http")
}return w
},getParentId:function(v){if(v.hasClass("mc-comment-reply-box")){return v.parents("li:first").attr("id").replace("mc-","")
}return 0
},commentSubmit:function(x){var w=x.data.handler,v=x.data.postbox;
if(!h.id){n.authPopup(function(){w.submit(v)
})
}else{w.submit(v)
}return false
},recive:function(x,y){if(d==0){return 
}var w=this,v=this.reciveUrl(this.channel);
t.showWaitComment();
l.getJSON(v,function(z){t.removeWaitComment();
l(z.comments).each(function(){Z.appendComment(this,x)
});
t.setCommentCount(z.size);
w.gotoComment();
if(z.next!=false){M.show()
}else{M.hide()
}if(y){y(w)
}})
},reRecive:function(){l(".mc-comment-list",t.content).empty();
Z.liCache={};
M.setPage(0);
this.recive()
},reciveUrl:function(w){var v=h.paidAccount?"/fullComments":"/comments";
return E+"/widget/"+mcSite+v+"?sitePage="+d+"&page="+M.getPage()+"&callback=?"
},gotoComment:function(){var v=window.location.href;
if(v.indexOf("#mc-")>0){document.location.replace(v)
}},submit:function(AC){var z=(".mc-comment-submit",AC),AA=this.getParentId(AC),AB=l(".mc-editor-message textarea",AC),v=l(".mc-editor-media textarea",AC),AD=AB.val(),x=l(".mc-comment-media ul li a",AC),w=this.submitUrl(AD,x,AA),y=l(".mc-spinner-control",AC);
y.show();
z.attr("disabled","disabled");
R.send(w.url,w.data,function(AE){var AG=l.parseJSON(AE.data),AH=AG.comment,AF=AG.error;
y.hide();
if(AH){if(AH.status==="pending"){alert(o.commentPreModer)
}else{Z.appendComment(AH,true)
}AB.val("");
v.val("");
l(".mc-comment-media",AC).remove();
l(".mc-editor-media",AC).hide();
if(AA>0){AC.slideUp("slow")
}}else{if(AF){alert(o[AF])
}}},function(AE){},function(){AB.focus();
z.removeAttr("disabled")
})
},demoSubmit:function(AC,y,v,x,z,AF,AB,AE,AD){var w="";
v.each(function(){w+=" "+l(this).attr("href")
});
var AA={id:AC.demoCommentId,parent:x,message:z,media:w,rating:0,status:"approved",created:new Date()};
if(h.id){AA.author=h
}else{AA.anonym={}
}Z.appendComment(AA,true);
AC.demoCommentId=AC.demoCommentId+1;
AB.hide();
y.val("");
l("#mc-text-container .mc-media").remove();
if(AE){AE()
}AD()
},submitUrl:function(y,AA,x){var w="";
AA.each(function(){w+=" "+l(this).attr("href")
});
var v=E+"/widget/"+mcSite+"/createComment",z={msg:q.escapeSpecialChars(y),media:w?l.trim(w):w,parentId:0,social:""};
if(d>0){z.sitePage=d
}else{z.chan=this.channel;
z.url=this.url;
z.title=this.title
}if(x>0){z.parentId=x
}if(l(".mc-social-xpost:visible .mc-social-xpost-checkbox:checked",t.content).length){z.social="on"
}return{url:v,data:z}
},vote:function(){if(!h.id){return false
}var v=l(this).attr("href")+"?callback=?";
l.getJSON(v,function(w){Z.changeRating(w.id,w.rating)
});
return false
},replyShow:function(y){var x=y.data.handler,v=l(y.target).parents("li:first .mc-comment-wrapper"),w=l(".mc-comment-reply-box",v);
if(w.length>0&&!w.is(":hidden")){w.hide()
}else{if(w.length==0){w=l("<div/>").addClass("mc-comment-reply-box");
w.html('<div class="mc-editor"><div class="mc-editor-wrapper"><div class="mc-editor-message"><textarea class="mc-answer-textarea" placeholder="'+o.placeholder+'"></textarea><div class="mc-editor-controls"><div class="mc-spinner-control" style="display:none"></div><div class="mc-attachmedia-control" title="'+o.media+'"></div></div></div><div class="mc-editor-media"><textarea placeholder="'+o.mediaPlaceholder+'"></textarea><div class="mc-editor-controls"><button class="mc-button mc-addmedia-control">'+o.add+'</button></div></div></div></div><button class="mc-button mc-comment-submit">'+o.submit+"</button>");
l(".mc-comment-submit",w).click({handler:x,postbox:w},x.commentSubmit);
l(".mc-attachmedia-control",w).click(Q.showMediaTextarea);
l(".mc-addmedia-control",w).click({handler:Q,container:w},Q.recognizeMedia);
l("textarea",w).bind("keyup",q.textareaAutoResize);
l(".mc-comment-footer",v).after(w)
}w.css("display","inline-block");
l(".mc-editor-message textarea",w).focus()
}return false
},showModerateLink:function(y){var x=l(y.target),v=x.parents("li:first");
if(h.moderator){var w=l(".mc-comment-footer .mc-comment-moderate:first",v);
w.show()
}},hideModerateLink:function(y){var x=l(y.target),v=x.parents("li:first"),w=l(".mc-comment-footer .mc-comment-moderate:first",v);
if(h.moderator&&l(".mc-controls",w).length==0){w.hide()
}},editComment:function(AB){var AA=l(AB.target),x=AA.parents("li:first"),z=x.attr("id").replace("mc-",""),v=l(".mc-comment-body:first",x),y=v.text();
if(l(".mc-answer-textarea",v).length>0){return false
}v.html('<div class="mc-comment-edit-box"><div class="mc-editor"><div class="mc-editor-wrapper"><div class="mc-editor-message"><textarea class="mc-answer-textarea" placeholder="'+o.placeholder+'">'+y+'</textarea><div class="mc-editor-controls"><div class="mc-spinner-control" style="display:none"></div><div class="mc-attachmedia-control" title="'+o.media+'"></div></div></div><div class="mc-editor-media"><textarea placeholder="'+o.mediaPlaceholder+'"></textarea><div class="mc-editor-controls"><button class="mc-button mc-addmedia-control">'+o.add+'</button></div></div></div></div><button class="mc-button mc-comment-save">'+o.save+'</button><button class="mc-button mc-save-cancel">'+o.cancel+"</button></div>");
l(".mc-answer-textarea",v).focus();
l(".mc-attachmedia-control",v).click(Q.showMediaTextarea);
l(".mc-addmedia-control",v).click({handler:Q,container:v},Q.recognizeMedia);
l("textarea",v).bind("keyup",q.textareaAutoResize);
var w=l(".mc-answer-textarea",v);
w.height(w.prop("scrollHeight"));
l(".mc-comment-save",v).click(function(){var AD=l(".mc-answer-textarea",v).val(),AC=l(".mc-spinner-control",v);
AC.show();
R.send(E+"/comment/"+z+"/edit",{msg:q.escapeSpecialChars(AD)},function(AE){var AF=l.parseJSON(AE.data);
AC.hide();
if(AF&&AF.error){alert(o[AF.error])
}},function(){},function(){});
return false
});
l(".mc-save-cancel",v).click(function(){Z.changeMessage(z,y);
return false
});
return false
},removeComment:function(y){var x=l(y.target),v=x.parents("li:first"),w=v.attr("id").replace("mc-","");
if(confirm(o.removeConfirm)){R.send(E+"/comment/"+w+"/remove",{msg:"test"},function(z){v.remove()
},function(){},function(){})
}return false
}};
var W={etag:"0",time:null,init:function(){var v=this,w;
if(d>0){if(v.time===null){v.time=q.dateToUTCString(new Date())
}if(window.XDomainRequest){setTimeout(function(){v.poll_IE(v)
},2000)
}else{Cackle.mcXHR=w=new XMLHttpRequest();
w.onreadystatechange=w.onload=function(){if(4===w.readyState){if(200===w.status&&w.responseText.length>0){v.etag=w.getResponseHeader("Etag");
v.time=w.getResponseHeader("Last-Modified");
v.action(w.responseText)
}if(w.status>0){v.poll(v,w)
}}};
this.poll(v,w)
}}},poll:function(x,y){Z.updateAppearance();
var w=(new Date()).getTime(),v="http://stream.cackle.me/lp/"+d+"?callback=?&v="+w;
y.open("GET",v,true);
y.setRequestHeader("If-None-Match",x.etag);
y.setRequestHeader("If-Modified-Since",x.time);
y.send()
},poll_IE:function(x){Z.updateAppearance();
var y=new window.XDomainRequest();
var w=(new Date()).getTime(),v="http://stream.cackle.me/lp/"+d+"?callback=?&v="+w;
Cackle.mcXHR=y;
y.onprogress=function(){};
y.onload=function(){x.action(y.responseText);
x.poll_IE(x)
};
y.onerror=function(){x.poll_IE(x)
};
y.open("GET",v,true);
y.send()
},action:function(y){var w=y.indexOf("["),x=y.lastIndexOf("}");
var v=l.parseJSON(y.substring(w+1,x+1));
if(v.event==="status"){Z.changeStatus(v.id,v.status.toLowerCase())
}else{if(v.event==="vote"){Z.changeRating(v.id,v.rating)
}else{if(v.event==="edit"){Z.changeMessage(v.id,v.msg)
}else{t.upCommentCount();
Z.appendComment(v,true)
}}}}};
var n={init:function(){l(".mc-auth-provider").click({handler:this},this.loginClick)
},loginClick:function(y){var v=y.data.handler,x=l(y.target),w=v.getAuthProvider(x.attr("class")),z=K[w];
if(!z||z.label){v.authPopup(v.afterLogin,"&provider="+w)
}else{v.loginWindow(z.url)
}},getAuthProvider:function(w){var v="";
l.each(w.split(" "),function(x,y){if(y!="mc-auth-provider"){v=y.replace("mc-auth-","");
return 
}});
return v
},loginWindow:function(v,w){t.buildWaitAvatar();
var x=window.open(v,o.auth,"width=850,height=500,location=1,status=1,resizable=yes");
this.checkConnection(x,1000,this.afterLogin,w)
},logoutWindow:function(){t.buildWaitAvatar();
var v=window.open(E+"/j_spring_security_logout_mc",o.logout,"width=400,height=400,location=1,status=1,resizable=yes");
this.checkConnection(v,1000)
},afterLogin:function(w){var v=w.widgetUser;
if(v.paidAccount){r.reRecive()
}if(v.id){l(".mc-editor-message textarea:first").focus()
}},authPopup:function(x,w){var v=window.open(E+"/widget/"+mcSite+"/authenticate?"+X+(w||""),"","width="+500+",height="+350+",location=1,menubar=0,scrollbars=0,resizable=1,status=0");
this.checkConnection(v,200,x)
},authorizeUser:function(x,w){var v=E+"/widget/"+mcSite+"/authorize?callback=?";
l.getJSON(v,function(y){h=y.widgetUser;
t.buildLoggedUser(h);
Z.updateAppearance();
if(x){x(y)
}if(w){window.location.reload()
}})
},checkConnection:function(z,x,AA,w){var y=this;
function v(){if(z&&z.closed){y.authorizeUser(AA,w)
}else{setTimeout(v,x)
}}setTimeout(v,x)
}};
var L={init:function(){if(typeof mcSSOAuth!="undefined"){if(mcSSOAuth.indexOf("e30= ")<0&&!h.id){this.auth(mcSSOAuth)
}else{if(mcSSOAuth.indexOf("e30= ")==0&&h.id&&h.provider=="sso"){this.logout()
}}}},auth:function(v){l.getJSON(E+"/widget/"+mcSite+"/ssoAuth?callback=?&token="+v,function(w){if(w.result=="success"){n.authorizeUser()
}})
},logout:function(){l.getJSON(E+"/widget/"+mcSite+"/ssoOut?callback=?",function(v){if(v.result=="success"){n.authorizeUser()
}})
}};
var M={container:"",init:function(){this.container=l(".mc-pagination",t.content);
l(".mc-comment-next",this.container).click({handler:this},this.next)
},setPage:function(v){return l(".mc-comment-next",this.container).attr("title",v)
},getPage:function(){var v=l(".mc-comment-next",this.container);
if(v.length){return parseInt(v.attr("title"))
}else{return 0
}},next:function(w){var v=w.data.handler;
v.showWait();
v.setPage(v.getPage()+1);
r.recive(null,function(){v.removeWait()
});
return false
},show:function(){l(".mc-pagination",t.content).show()
},hide:function(){l(".mc-pagination",t.content).hide()
},showWait:function(){l(".mc-comment-next",this.container).append(this.waitImg())
},removeWait:function(){l(".mc-pagination-wait",this.container).remove()
},waitImg:function(){return'<img class="mc-pagination-wait" src="'+E+'/static/img/comment-wait.gif"/>'
}};
var q={days:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],months:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],replaceURLWithHTMLLinks:function(y){var x=/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,v=/(^|[^\/])(www\.[\S]+(\b|$))/ig,w=y.replace(x,'<a href="$1" target="_blank">$1</a>');
return w.replace(v,'$1<a href="http://$2" target="_blank">$2</a>')
},textareaAutoResize:function(){var v=l(this);
v.height(0);
if(parseInt(v.height())<this.scrollHeight){v.height(this.scrollHeight)
}},getBeforeAnchor:function(v){if(v.indexOf("#")>0){return v.substring(0,v.indexOf("#"))
}else{return v.substring(0,v.length)
}},getAfterAnchor:function(v){return v.substring(v.indexOf("#"),v.length)
},escapeSpecialChars:function(w){var x=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,v={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"};
x.lastIndex=0;
return x.test(w)?w.replace(x,function(y){var z=v[y];
return typeof z==="str"?z:"\\u"+("0000"+y.charCodeAt(0).toString(16)).slice(-4)
}):w
},getTimeAgo:function(w,z){var v=new Date().getTime(),AC=v-w,AE=AC/1000,x=AE/60,AA=x/60,AB=AA/24,AD=AB/365;
if(AE<45){return z.second
}else{if(AE<90){return z.minute
}else{if(x<45){return z.minutes(x)
}else{if(x<90){return z.hour
}else{if(AA<24){return z.hours(AA)
}else{if(AA<48){return z.day
}else{if(AB<30){return z.days(AB)
}else{if(AB<60){return z.month
}else{if(AB<365){return z.months(AB)
}else{if(AD<2){return z.year
}else{return z.years(AD)
}}}}}}}}}}},valueToTwoDigits:function(v){return((v<10)?"0":"")+v
},dateToUTCString:function(v){var w=this.valueToTwoDigits(v.getUTCHours())+":"+this.valueToTwoDigits(v.getUTCMinutes())+":"+this.valueToTwoDigits(v.getUTCSeconds());
return this.days[v.getUTCDay()]+", "+this.valueToTwoDigits(v.getUTCDate())+" "+this.months[v.getUTCMonth()]+" "+v.getUTCFullYear()+" "+w+" GMT"
}};
var k={create:function(x,y,z){var v="";
if(z){var w=new Date();
w.setTime(w.getTime()+(z*24*60*60*1000));
v="; expires="+w.toGMTString()
}document.cookie=x+"="+y+v+"; path=/"
},read:function(w){var y=w+"=";
var v=document.cookie.split(";");
for(var x=0;
x<v.length;
x+=1){var z=v[x];
while(z.charAt(0)===" "){z=z.substring(1,z.length)
}if(z.indexOf(y)===0){return z.substring(y.length,z.length)
}}return null
},erase:function(v){this.createCookie(v,"",-1)
}};
var R={xhr:null,init:function(){var v=this;
l.getScript(E+"/xdm/easyXDM.min.js",function(w,x){v.xhr=new easyXDM.Rpc({remote:E+"/xdm/index.html"},{remote:{request:{}},serializer:{stringify:function(y){var z={id:y.id,jsonrpc:y.jsonrpc,method:y.method,params:y.params[0]};
return v.stringify(z)
},parse:function(y){return l.parseJSON(y)
}}})
})
},send:function(x,y,z,w,v){this.xhr.request({url:x,method:"POST",data:y},function(AA){z(AA);
v()
},function(AA){w(AA);
v()
})
},stringify:function(AA){var z=typeof (AA);
if(z!="object"||AA===null){if(z=="string"){AA='"'+AA+'"'
}return String(AA)
}else{var AB,x,y=[],w=(AA&&AA.constructor==Array);
for(AB in AA){x=AA[AB];
z=typeof (x);
if(z=="string"){x='"'+x+'"'
}else{if(z=="object"&&x!==null){x=this.stringify(x)
}}y.push((w?"":'"'+AB+'":')+String(x))
}return(w?"[":"{")+String(y)+(w?"]":"}")
}}};
var S={bind:function(x){var w=this,v=l(x);
v.click(function(){var y=l(this).next(".mc-controls");
if(y.length>0){y.remove()
}else{w.show(this)
}return false
})
},show:function(AA){var z=this,y=l(AA).closest("li"),w=y.attr("id").replace("mc-",""),v=l('<ul class="mc-controls"></ul>');
if(!h.paidAccount){var x=l("<li>"+o.siteAdminNote+'<a href="'+E+'/purchase/start" target="_blank">'+o.siteAdminUpdate+"</a></li>");
v.append(x);
l(AA).after(v);
return false
}l.getJSON(E+"/comment/"+w+"/isBanned?callback=?",function(AC){var AB=AC.commentPrivateInfo;
z.commentControls(v,w,AB.commentStatus,AA);
if(!AB.anonymComment){v.append(z.userControl(w,AB,AA))
}v.append(z.ipControl(w,AB,AA));
l(AA).after(v)
});
return false
},userControl:function(v,AA,z){var w=l("<li></li>"),x=AA.author||o.guest;
if(AA.email){x+=" <"+AA.email+">"
}var y;
if(AA.userBanned){y=this.control(v,"unbanUser",o.unbanUser,z)
}else{y=this.control(v,"banUser",o.banUser,z)
}w.append(y);
return w
},ipControl:function(w,z,y){var v=l("<li></li>");
var x;
if(z.ipBanned){x=this.control(w,"unbanIp",o.unbanIp,y)
}else{x=this.control(w,"banIp",o.banIp,y)
}v.append(x);
return v
},commentControls:function(w,v,AA,z){var y=this,x=[];
if(AA==="approved"){x.push("reject")
}else{if(AA==="pending"){x.push("approve");
x.push("reject")
}else{x.push("recovery")
}}if(AA=="spam"){x.push("delete")
}else{if(AA!="deleted"){x.push("spam");
x.push("delete")
}}l.each(x,function(AD,AC){var AB=l("<li></li>");
AB.append(y.control(v,AC,o[AC],z));
w.append(AB)
})
},refresh:function(v,x){var w=this;
l.getJSON(v,function(z){var y=l(x).next(".mc-controls");
if(y.length>0){y.remove()
}w.show(x,z.commentSmallDto);
return false
});
return false
},control:function(y,v,x,AA){var w=E+"/comment/"+y+"/"+v+"?callback=?",z=l("<a></a>",{href:w});
z.text(x);
z.attr("style","color:black!important");
z.click(l.proxy(this.refresh,this,w,AA));
return z
}};
var Q={init:function(){l(".mc-attachmedia-control").click(this.showMediaTextarea);
l(".mc-addmedia-control").click({handler:this,container:".mc-postbox-container"},this.recognizeMedia)
},showMediaTextarea:function(y){var x=l(y.target),v=x.parents(".mc-editor-wrapper:first"),w=l(".mc-editor-media",v);
if(w.is(":visible")){w.slideUp("slow");
l(".mc-editor-controls",w).hide();
x.removeClass("mc-attachmedia-active")
}else{w.slideDown("slow",function(){l(".mc-editor-controls",w).show();
l("textarea",w).focus()
});
x.addClass("mc-attachmedia-active")
}return false
},recognizeMedia:function(y){var z=l(y.target),AE=y.data.handler,w=l(y.data.container),AB=z.parents(".mc-editor-media:first"),x=l("textarea",AB).val(),AD=AE.findLinks(x);
if(AD&&AD.length>0){var AA=AE.makePreview(AD,true);
var AC=l(".mc-comment-media ul",w);
if(AC.length>0){AC.append(l("li",AA))
}else{var v=l("<div/>").addClass("mc-comment-media");
v.append(AA);
l(".mc-editor",w).after(v)
}}return false
},makeContent:function(x){var v=this.findLinks(x);
if(v&&v.length>0){var w=this.makePreview(v);
var y=l("<div/>").addClass("mc-comment-media");
y.append(w);
return y
}},findLinks:function(v){return v.match(/(\b(https?:\/\/((www\.youtube\.com\/watch\?[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])|(vk\.com\/video_ext\.php\?oid=(\d)*&id=(\d)*&hash=(\d|\w)*)|(video\.rutube\.ru\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])|(vimeo\.com\/(\d)*)|([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|]\.(png|jpg|gif))|(docs\.google\.com\/present\/view?[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])|(www\.slideshare\.net\/slideshow\/embed_code\/(\d)+))))/ig)
},makePreview:function(v,y){var x=this,w=l("<ul></ul>");
l.each(v,function(){var z=l("<li></li>"),AA=l("<a/>",{href:this,target:"_blank"});
var AB=this.toString(),AC;
if(AB.indexOf("youtube.com")>-1){AC=x.youtubeThumbl(AB)
}else{if(AB.indexOf("vk.com")>-1){AC=x.vkThumbl(AB)
}else{if(AB.indexOf("video.rutube.ru")>-1){AC=x.rutubeThumbl(AB)
}else{if(AB.indexOf("vimeo.com")>-1){AC=x.vimeoThumbl(AB)
}else{if(AB.indexOf("docs.google.com")>-1){AC=x.presentThumbl(AB)
}else{if(AB.indexOf("slideshare.net")>-1){AC=x.presentThumbl(AB)
}else{AC=x.imgThumbl(AB)
}}}}}}AA.click(function(){window.open(E+"/widget/media?url="+encodeURIComponent(this),"media","width=850,height=500,location=1,status=1,resizable=yes");
return false
});
if(y){var AD=l("<span></span>");
z.append(AD);
l(AD).click(function(){z.remove()
})
}AA.append(AC);
z.append(AA);
w.append(z)
});
return w
},youtubeThumbl:function(w){var v=/[\?\&]v=([^\?\&]+)/.exec(w),x=v[1];
return l("<img></img>",{src:"http://i.ytimg.com/vi/"+x+"/0.jpg"})
},vimeoThumbl:function(x){var w=/vimeo\.com\/(\d+)/.exec(x),y=w[1],v=l("<img></img>");
l.getJSON("http://vimeo.com/api/v2/video/"+y+".json?callback=?",function(z){v.attr("src",z[0].thumbnail_large)
});
return v
},rutubeThumbl:function(v){return l("<img></img>",{src:E+"/static/img/rutube_thumbl.png"})
},vkThumbl:function(v){return l("<img></img>",{src:E+"/static/img/vk_thumbl.png"})
},presentThumbl:function(v){return l("<img></img>",{src:E+"/static/img/presen_thumbl.png"})
},imgThumbl:function(v){return l("<img></img>",{src:v})
}};
var U="&chan="+encodeURIComponent(r.getChannel());
l.getJSON(E+"/widget/"+mcSite+"/bootstrap?callback=?"+U+X,function(y){var x=y.widgetBootstrap,v=x.setting,w=v.setting;
h=x.user;
O=(typeof mcProviders!="undefined")?mcProviders:w.providers;
i=w.avatarSize||i;
T=w.urlRecogn;
b=w.crossposting;
u=v.gravatarEnable;
V=v.maxReplyLevel;
c=v.anonymAvatar||E+"/static/img/anonym.png",Y=v.customCss;
d=v.sitePageId;
j=v.withoutCopyright;
p=(typeof mcTheme1!="undefined")?mcTheme1:v.theme;
m=v.free;
J=v.editComment;
P=v.removeComment;
o=v.messages;
a=w.mcHeader||o.header;
o.from=w.fromLabel||o.from;
o.placeholder=w.placeholder||o.placeholder;
o.submit=w.submitLabel||o.submit;
o.commentCount=w.commentsLabel||o.commentCount;
o.answer=w.replyLabel||o.answer;
o.nextComments=w.nextLabel||o.nextComments;
g.yandex.name=o.yandex;
g.vkontakte.name=o.vkontakte;
g.mymailru.name=o.mymailru;
g.odnoklassniki.name=o.odnoklassniki;
g.mailru.label=o.mailruLabel;
g.rambler.name=o.rambler;
g.rambler.label=o.ramblerLabel;
g.myopenid.label=o.myopenidLabel;
g.livejournal.name=o.livejournal;
g.livejournal.label=o.livejournalLabel;
g.flickr.label=o.flickrLabel;
g.wordpress.label=o.wordpressLabel;
g.blogger.label=o.bloggerLabel;
g.verisign.label=o.verisignLabel;
t.init();
Z.init();
L.init();
r.init();
W.init();
R.init();
n.init();
M.init();
Q.init();
if(e){e(Cackle.mcJQ)
}});
Cackle.CommentBuilder=Z
}function B(){if(Cackle.mcXHR){Cackle.mcXHR.abort()
}Cackle.mcJQ(document).unbind(".cackle");
C(Cackle.mcJQ)
}function F(){var J={};
J.run=function(){if(Cackle.mcJQ("#mc-container").length>0&&typeof mcSite!="undefined"&&!Cackle.isLoaded){Cackle.isLoaded=true;
C(Cackle.mcJQ)
}else{setTimeout(J.run,50)
}};
J.run()
}var D=document.createElement("script");
D.type="text/javascript";
D.src=E+"/static/js/mc.jquery.js";
D.async=false;
if(typeof D.onload!="undefined"){D.onload=F
}else{if(typeof D.onreadystatechange!="undefined"){D.onreadystatechange=function(){if(this.readyState=="complete"||this.readyState=="loaded"){F()
}}
}else{D.onreadystatechange=D.onload=function(){var J=D.readyState;
if(!J||/loaded|complete/.test(J)){F()
}}
}}(document.getElementsByTagName("head")[0]||document.documentElement).appendChild(D);
Cackle.main=C;
Cackle.reinit=B;
Cackle.timeAgo=G
})();