<?php

/**
 * 廖师兄修改
 *http://www.liaoshixiong.cn
 */

require "config.php";
require "include/WeiXin.php";

$weiXin = new WeiXin($G_CONFIG['weiXin']);

$testFakeId = "3773415";
// $testFakeId2 = "1044407220";

// 发送消息
// print_r($weiXin->send($testFakeId, "test"));

// 发送图片, 图片必须要先在公共平台中上传, 得到图片Id
// print_r($weiXin->sendImage($testFakeId, "10000001"));

// // 批量发送
// print_r($weiXin->batSend(array($testFakeId, $testFakeId2), "test batSend"));

// // 得到用户信息
// print_r($weiXin->getUserInfo($testFakeId));

// // 得到最新消息
print_r($weiXin->getLatestMsgs());

