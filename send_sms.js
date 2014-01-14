$('#page_send_sms_submit').live('click',function(){

  var title = $('#sms_mobile').val();
  if (!title) { alert('输入题'); return false; }

  var body = $('#sms_msg').val();
  if (!body) { alert('输入容'); return false; }

  // 开始：Drupal Services 创建内容（警告：没有设置SSL请不要使用https

  $.ajax({
      url: "send_sms.php",
      type: 'post',
      data: 'mobile=' + encodeURIComponent(title) + '&msg=' + encodeURIComponent(body) + ,
      //+ '&md5=' + encodeURIComponent($.md5("13716587629"))
      //data: 'node[type]=page&node[title]=' + encodeURIComponent(title) + '&node[language]=und&node[body][und][0][value]=' + encodeURIComponent(body),
      //dataType: 'json',
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
        $('#sms_mobile').val('');
        $('#sms_msg').val('');
         alert('发送成功！');
         // $.mobile.changePage("send_sms.php", "slideup");
      }
  });
  // 结束：Drupal Services 创建内容

  return false;

});