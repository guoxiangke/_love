var nid; // global node id variable

$('#page_dashboard').live('pageshow',function(){
  try {
    $.ajax({
      url: "http://yongbuzhixi.com/?q=dale_service/system/connect.json",
      type: 'post',
      dataType: 'json',
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert('连接失败');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
        var drupal_user = data.user;
        if (drupal_user.uid == 0) { // 对没有登录的用户显示“登录”按钮，隐藏“注销”按钮
          $('#button_login').show();
          $('#button_logout').hide();
        }
        else { // 用户已登录，隐藏“登录”按钮，显示“注销”按钮
          $('#button_login').hide();
          $('#button_logout').show();
        }
      }
    });
  }
  catch (error) { alert("page_dashboard - " + error); }
});



//登出
$('#button_logout').live("click",function(){
try {
 $.ajax({
     url: "http://yongbuzhixi.com/?q=dale_service/user/logout.json",
     type: 'post',
     dataType: 'json',
     error: function (XMLHttpRequest, textStatus, errorThrown) {
       alert('button_logout - 注销失败');
       console.log(JSON.stringify(XMLHttpRequest));
       console.log(JSON.stringify(textStatus));
       console.log(JSON.stringify(errorThrown));
     },
     success: function (data) {
       alert("您已经安全退出。");
       $.mobile.changePage("index.html",{reloadPage:true},{allowSamePageTranstion:true},{transition:'none'});
     }
 });
}
catch (error) { alert("button_logout - " + error); }
return false;
});


// 如果用户没登录...
$('#button_page_create').hide(); // 隐藏“添加内容”按钮

// 如果用户已登录...
$('#button_page_create').show(); // 显示“添加内容”按钮


// 如果用户没登录...
$('#button_view_pages').hide(); // 隐藏“查看内容”按钮

// 如果用户已登录...
$('#button_view_pages').show(); // 显示“查看内容”按钮