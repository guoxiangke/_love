$('#page_login_submit').live('click',function(){
  var name = $('#page_login_name').val();
  if (!name) { alert('请输入用户名'); return false; }
  var pass = $('#page_login_pass').val();
  if (!pass) { alert('请输入密码'); return false; }
  
  // 开始：Drupal Services 用户登录（警告：没有设置SSL请不要使用https)
  $.ajax({
      url: "http://yongbuzhixi.com/?q=dale_service/user/login.json",
      type: 'post',
      data: 'username=' + encodeURIComponent(name) + '&password=' + encodeURIComponent(pass),
      dataType: 'json',
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert('登录失败');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
       $.mobile.changePage("index.html", "slideup");
      }
  });
  // 结束：Drupal Services 用户登录
  return false;
});