$('#page_node_create_submit').live('click',function(){

  var title = $('#page_node_title').val();
  if (!title) { alert('输入标题'); return false; }

  var body = $('#page_node_body').val();
  if (!body) { alert('输入内容'); return false; }

  // 开始：Drupal Services 创建内容（警告：没有设置SSL请不要使用https)
  $.ajax({
      url: "http://yongbuzhixi.com/?q=dale_service/node.json",
      type: 'post',
      data: 'node[type]=page&node[title]=' + encodeURIComponent(title) + '&node[language]=und&node[body][und][0][value]=' + encodeURIComponent(body),
      dataType: 'json',
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert('不能添加内容！请您先登录。');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
       $.mobile.changePage("index.html", "slideup");
      }
  });
  // 结束：Drupal Services 创建内容

  return false;

});