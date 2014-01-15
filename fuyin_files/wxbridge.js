

function htmlDecode(str){
    return str
		  .replace(/&#39;/g, '\'')
		  .replace(/<br\s*(\/)?\s*>/g, '\n')
		  .replace(/&nbsp;/g, ' ')
		  .replace(/&lt;/g, '<')
		  .replace(/&gt;/g, '>')
		  .replace(/&quot;/g, '"')
		  .replace(/&amp;/g, '&');
};


// 转发给朋友的次数
var share2Friends = 0;
var share2Desc;
var share2Title;
var share2ImgUrl;
var share2Link;

// 定义分享按钮事件处理函数
var onBridgeReady =  function () {
	WeixinJSBridge.call('showOptionMenu');		// 显示右上角的分享菜单按钮，也可以用invoke函数名;
	// WeixinJSBridge.call('hideOptionMenu');	// 隐藏右上角的分享菜单按钮;
	//WeixinJSBridge.invoke("hideToolbar");		// 隐藏底部工具条;

	appId  = '';
	imgUrl = ''; 
	link   = location.href;
	desc   = htmlDecode("主要内容描述");
	desc   = desc || link;
	
	share2Desc   = share2Desc || location.href;
	share2Title  = share2Title || document.title;
	share2ImgUrl = share2ImgUrl || imgUrl;
	share2Link   = share2Link || link;

	// 【发送给好友】事件处理函数
	WeixinJSBridge.on('menu:share:appmessage', function(argv){
		share2Desc   = share2Desc || location.href;
		share2Title  = share2Title || document.title;
		share2ImgUrl = share2ImgUrl || imgUrl;
		share2Link   = share2Link || link;

		WeixinJSBridge.invoke
		(
			'sendAppMessage',
			{
				"appid"      : appId,
				"img_url"    : share2ImgUrl,
				"img_width"  : "640",
				"img_height" : "640",
				"link"       : share2Link,
				"desc"       : share2Desc,
				"title"      : share2Title
			}, 
			function(e) 
			{
				// 发送成功 e.err_msg==send_app_msg:ok
				if (e.err_msg=='send_app_msg:ok') share2Friends++;
				
				// 发送取消 e.err_msg==send_app_msg:cancel
				if (e.err_msg=='send_app_msg:cancel') { }				
			}
		)		
		
	});

	// 【分享到朋友圈】事件处理函数
	WeixinJSBridge.on('menu:share:timeline', function(argv){			
		share2Desc   = share2Desc || location.href;
		share2ImgUrl = share2ImgUrl || imgUrl;
		share2Title  = share2Title || document.title;
		share2Link   = share2Link || link;
	
		WeixinJSBridge.invoke
		(
			'shareTimeline', 
			{
				"img_url"    : share2ImgUrl,
				"img_width"  : "640",
				"img_height" : "640",
				"link"       : link,
				"desc"       : share2Desc,		// 似乎无用？
				"title"      : share2Title
			}, 
			function(res) {
				/* 返回res.err_msg,取值
					share_timeline:cancel 用户取消
					share_timeline:fail　发送失败
					share_timeline:confirm 发送成功
					WeixinJSBridge.log(res.err_msg);
				*/
			}
		);
		
	});

	// 【分享到微博】事件处理函数
	WeixinJSBridge.on('menu:share:weibo', function(argv){
		share2Title  = share2Title || document.title;
		share2Link   = share2Link || link;
	
		WeixinJSBridge.invoke
		(
			'shareWeibo',
			{
				"content" : share2Title + share2Link,
				"url"     : share2Link
			}, 
			function(res) {}
		);
	});
		
	// 发送邮件
	WeixinJSBridge.on("menu:share:email", function() {
		WeixinJSBridge.invoke("sendEmail", {
			content: share2Link,
			title: share2Title
		});
	})

};

// 主动添加微信好友，暂被腾讯封锁
function weixinAddContact(wxname)
{
	WeixinJSBridge.invoke
	(
		'addContact', {'webtype':"1", 'username': wxname}, 
		function(e)
		{
			// WeixinJSBridge.log(e.err_msg);
			// 失败：add_contact:cancel
			if (e.err_msg=='add_contact:added' || e.err_msg=='add_contact:ok') {
				// 关注成功，或者已经关注过了
			}
		}
	);
}


// 侦听 WeixinJSBridge 就绪事件（微信浏览器内置JS对象）
if (document.addEventListener) document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
else if(document.attachEvent)
{
	document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
	document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
}
