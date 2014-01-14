<?php
/**
  * wechat php test
  */
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

//define your token
define("TOKEN", "ybzx");
$wechatObj = new wechatCallbackapiTest();
// $wechatObj->valid();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        watchdog('mp-postStr', print_r($postStr,true), array(), WATCHDOG_NOTICE, 'link');
      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                watchdog('mp-postObj', print_r($postObj,true), array(), WATCHDOG_NOTICE, 'link');
                $time = time();
                switch ($postObj->MsgType) {
                    case 'text':
                        $field_mp_type = 1;
                        break;
                    
                    default:
                        $field_mp_type = 2;
                        break;
                }
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = t('Thanks for your focus~,we will do our best for you!');
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	if(!mp_get_uid_by_FromUserName($fromUsername)) {
                        
                    }
                    //生成本站订单begin

                    $node = new stdClass();
                    $node->title = $postObj->MsgId;
                    $node->type = 'mp_receive';
                    node_object_prepare($node); // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
                    $node->language = LANGUAGE_NONE; // Or e.g. 'en' if locale is enabled
                    //todo:
                    //bind user
                    //mp_respone
                    //get_uid_by_FormUserName('oNAD2jlAk0ZGHkgezd_MnQbGrBPM');
                    $node->uid = 1;
                    $node->status = 1; //(1 or 0): published or not
                    $node->promote = 0; //(1 or 0): promoted to front page
                    $node->comment = 0; // 0 = comments disabled, 1 = read only, 2 = read/write
                    $node->path['pathauto'] = false;
                    $node->body[$node->language][0]['value']   = $postObj->Content . print_r($postObj,true);
                    $node->body[$node->language][0]['summary'] = text_summary($postObj->Content);
                    $node->body[$node->language][0]['format']  = 'filtered_html';

                    $node->field_mp_type['und'][0]['value'] = $field_mp_type;
                    $node->field_mp_fromusername['und'][0]['value'] = $postObj->FromUserName;
                    if($node = node_submit($node)) { // Prepare node for saving
                        node_save($node);
                        watchdog('mp-add mp-receive node', "Node with nid " . $node->nid . " saved!\n", array(), WATCHDOG_NOTICE, 'link');
                    }
                    echo $resultStr;

                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>