$('#page_node_update').live('pageshow',function(){
  try {
    $.ajax({
      url: "http://dingtong.sinaapp.com/?q=dale_service/node/" + encodeURIComponent(nid) + ".json",
      type: 'get',
      dataType: 'json',
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert('page_node_update - 查看内容失败');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
       console.log(JSON.stringify(data));
       $('#page_node_update_title').val(data.title);
       $('#page_node_update_body').val(data.body.und[0].value);
      }
    });
  }
  catch (error) { alert("page_node_update - " + error); }
});

$('#page_node_update_submit').live('click',function(){
  
  var title = $('#page_node_update_title').val();
  if (!title) { alert('输入标题'); return false; }
  
  var body = $('#page_node_update_body').val();
  if (!body) { alert('输入内容'); return false; }

  $.ajax({
      url: "http://dingtong.sinaapp.com/?q=dale_service/node/" + encodeURIComponent(nid) + ".json",
      type: 'put',
      data: 'node[type]=page&node[title]=' + encodeURIComponent(title) + '&node[language]=und&node[body][und][0][value]=' + encodeURIComponent(body),
      dataType: 'json',
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert('page_node_update_submit - failed to update node');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
       $.mobile.changePage("#page_node_view", "slideup");
      }
  });
  return false;
});