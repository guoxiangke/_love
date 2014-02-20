document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideOptionMenu');
	(function ($){
		$('body').append('<a href="weixin://contacts/profile/love_yongbuzhixi" title="关注微信" style="position: fixed;bottom: 0px;right: 0px;"><img src="http://wx.dev.camplus.hk/sites/default/files/styles/user_profile_sc_100/public/pictures/picture-172-1356487827.jpg" style="width:40px;"/></a>');
	}(jQuery));
});