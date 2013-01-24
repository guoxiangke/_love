<?php
// $currentdir=getcwd();
// echo $currentdir;
// chdir('D:\www\Sites\love');
// //define(‘DRUPAL_ROOT’, “home2/crawgirl/public_html/feedme/”);
// require_once './includes/bootstrap.inc';
// drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


define('DRUPAL_ROOT', '../');
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

global $user;

/*
$nodesql=" SELECT node.nid AS nid, node.changed AS node_changed FROM drup_node node ORDER BY node_changed DESC ";
$noderesult=db_query_range($nodesql,1,100);//查询符合上述SQL的100条数据,从第10条开始,数字你随便改吧
while($rows = db_fetch_object($noderesult)){
print_r($rows->nid);
}
$noderesult=NULL;//习惯及时清空不用的对象*/
$name = user_load(1);
$name = $name->name;
echo $name;

?>
