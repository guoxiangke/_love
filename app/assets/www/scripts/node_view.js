$('#page_node_view').live('pageshow',function(){
  try {
    $.ajax({
      url: "http://yongbuzhixi.com/?q=dale_service/node/" + encodeURIComponent(nid) + ".json",
      type: 'get',
      dataType: 'json',
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert('没法儿显示内容');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
        console.log(JSON.stringify(data));
        $('#page_node_view h1').html(data.title); // 设置 header title
        $('#page_node_view .content').html(data.body.und[0].safe_value); // 在content div 里显示body内容
      }
    });
  }
  catch (error) { alert("page_node_view - " + error); }
});


//删除按钮

$('#button_node_delete').live("click",function(){
  if (confirm("确认要删除这个内容吗？")) {
    try {
      $.ajax({
        url: "http://yongbuzhixi.com/?q=dale_service/node/" + encodeURIComponent(nid) + ".json",
        type: 'delete',
        dataType: 'json',
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert('page_node_view - 删除内容失败');
          console.log(JSON.stringify(XMLHttpRequest));
          console.log(JSON.stringify(textStatus));
          console.log(JSON.stringify(errorThrown));
        },
        success: function (data) {
          console.log(JSON.stringify(data));
          $.mobile.changePage("index.html", "slideup");
        }
      });
    }
    catch (error) { alert("button_node_delete - " + error); }
  }
  else {
    return false;
  }
});