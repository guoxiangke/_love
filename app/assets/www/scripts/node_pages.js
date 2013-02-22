$('#page_node_pages').live('pageshow',function(){
  try {
    $.ajax({
      url: "http://yongbuzhixi.com/?q=dale_app",
      type: 'get',
      dataType: 'json',
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert('没法儿显示内容！');
        console.log(JSON.stringify(XMLHttpRequest));
        console.log(JSON.stringify(textStatus));
        console.log(JSON.stringify(errorThrown));
      },
      success: function (data) {
        $("#page_node_pages_list").html("");
        $.each(data.nodes,function (node_index,node_value) {
          console.log(JSON.stringify(node_value));
          $("#page_node_pages_list").append($("<li></li>",{"html":"<a href='#page_node_view' id='" + node_value.node.Nid + "' class='page_node_pages_list_title'>" + node_value.node.title + "</a>"}));
        });
        $("#page_node_pages_list").listview("destroy").listview();
      }
    });
  }
  catch (error) { alert("page_node_pages - " + error); }
});

$('a.page_node_pages_list_title').live("click",function(){
  nid = $(this).attr('id'); // 设置 global nid 为刚才点击过的内容
});