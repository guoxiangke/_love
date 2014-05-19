<?php
function liangyou_audio_list(){
	$prefix['31'] = 'http://liangyou2.nissigz.com:15200/';
  $prefix['32'] = 'http://liangyou.nissigz.com:18100/';
  $radios_list = array(
    // 福音节目-适合所有人士
    // '31' => array(//15200
      'ir' => array('url'=>'http://stream.liangyou.net/program/1njchu-3b2ozo', 'name' =>'i-radio爱广播', 'prefix'=>$prefix['31'],'day'=>0),//0
      'eg' => array('url'=>'http://stream.liangyou.net/program/1njcjg-3b2p2w', 'name' =>'英语世界', 'prefix'=>$prefix['31'],'day'=>2),//2
      'gt' => array('url'=>'http://stream.liangyou.net/program/1njcj0-3b2p20', 'name' =>'恩典与真理', 'prefix'=>$prefix['31'],'day'=>0),//0
      'wa' => array('url'=>'http://stream.liangyou.net/program/1njcj3-3b2p26', 'name' =>'天路导向', 'prefix'=>$prefix['31'],'day'=>6),//6,7
      'cwa' => array('url'=>'http://stream.liangyou.net/program/1njcj2-3b2p24', 'name' =>'天路导向（粤）', 'prefix'=>$prefix['31'],'day'=>6),//6,7
      'bg' => array('url'=>'http://stream.liangyou.net/program/1njcjd-3b2p2q', 'name' =>'普世佳音', 'prefix'=>$prefix['31'],'day'=>1),//1
      'yu' => array('url'=>'http://stream.liangyou.net/program/1njchx-3b2ozu', 'name' =>'绝妙当家', 'prefix'=>$prefix['31'],'day'=>0),//0
      'gv' => array('url'=>'http://stream.liangyou.net/program/1njci3-3b2p06', 'name' =>'生活无国界', 'prefix'=>$prefix['31'],'day'=>0),//0
      'zz' => array('url'=>'http://stream.liangyou.net/program/1njciw-3b2p1s', 'name' =>'零点零距离', 'prefix'=>$prefix['31'],'day'=>5),//1-5
      'se' => array('url'=>'http://stream.liangyou.net/program/1njci0-3b2p00', 'name' =>'恋爱季节', 'prefix'=>$prefix['31'],'day'=>5),//1-5
      'up' => array('url'=>'http://stream.liangyou.net/program/1njcil-3b2p16', 'name' =>'亲情不断电', 'prefix'=>$prefix['31'],'day'=>5),//1-5
      'bc' => array('url'=>'http://stream.liangyou.net/program/1njci1-3b2p02', 'name' =>'书香园地', 'prefix'=>$prefix['31'],'day'=>5),//1-5
      'gn' => array('url'=>'http://stream.liangyou.net/program/1njcif-3b2p0u', 'name' =>'现代人的希望', 'prefix'=>$prefix['31'],'day'=>0),//0
      'hg' => array('url'=>'http://stream.liangyou.net/program/1njci4-3b2p08', 'name' =>'欢乐卡恰碰', 'prefix'=>$prefix['31'],'day'=>0),//0
      'yn' => array('url'=>'http://stream.liangyou.net/program/1njcj1-3b2p22', 'name' =>'爱在人间（云南）', 'prefix'=>$prefix['31'],'day'=>0),//0
      'im' => array('url'=>'http://stream.liangyou.net/program/1njchy-3b2ozw', 'name' =>'i关怀心磁场', 'prefix'=>$prefix['31'],'day'=>5),//1-5
      'ib' => array('url'=>'http://stream.liangyou.net/program/1njcjm-3b2p38', 'name' =>'无限飞行号', 'prefix'=>$prefix['31'],'day'=>0),//0
      'rt' => array('url'=>'http://stream.liangyou.net/program/1njcia-3b2p0k', 'name' =>'今夜心未眠', 'prefix'=>$prefix['31'],'day'=>6),//6,7
      'em' => array('url'=>'http://stream.liangyou.net/program/1njci7-3b2p0e', 'name' =>'听听90后', 'prefix'=>$prefix['31'],'day'=>6),//6,7
      'yr' => array('url'=>'http://stream.liangyou.net/program/1njciv-3b2p1q', 'name' =>'Yi-radio爱广播', 'prefix'=>$prefix['31'],'day'=>0),//0
      
    // '32' => array(//18100
      // 栽培节目-适合基督徒
      'bv' => array('url'=>'http://stream.liangyou.net/program/1njcht-3b2ozm', 'name' =>'灵命日粮', 'prefix'=>$prefix['32'],'day'=>0),//0
      'ee' => array('url'=>'http://stream.liangyou.net/program/1njchw-3b2ozs', 'name' =>'拥抱每一天', 'prefix'=>$prefix['32'],'day'=>0),//0
      'bf' => array('url'=>'http://stream.liangyou.net/program/1njci6-3b2p0c', 'name' =>'幸福满家园', 'prefix'=>$prefix['32'],'day'=>6),//6 7
      'ws' => array('url'=>'http://stream.liangyou.net/program/1njci9-3b2p0i', 'name' =>'长夜的牵引', 'prefix'=>$prefix['32'],'day'=>0),//0
      'be' => array('url'=>'http://stream.liangyou.net/program/1njcik-3b2p14', 'name' =>'真道分解', 'prefix'=>$prefix['32'],'day'=>0),//0
      'tr' => array('url'=>'http://stream.liangyou.net/program/1njchv-3b2ozq', 'name' =>'彩虹桥', 'prefix'=>$prefix['32'],'day'=>0),//0
      'ns' => array('url'=>'http://stream.liangyou.net/program/1njciu-3b2p1o', 'name' =>'生命的四季', 'prefix'=>$prefix['32'],'day'=>5),
      'cw' => array('url'=>'http://stream.liangyou.net/program/1njchz-3b2ozy', 'name' =>'齐来颂扬', 'prefix'=>$prefix['32'],'day'=>5),
      'wpb' => array('url'=>'http://stream.liangyou.net/program/1njcim-3b2p18', 'name' =>'圣乐天地', 'prefix'=>$prefix['32'],'day'=>6),
      // 'bv' => '空中辅导',
      // 'bv' => '无愧的工人',
      // 'bv' => '有问必答',
      // 'bv' => '生命指南针',
      // 'bv' => '蓝天绿洲',
      // 'bv' => '圣乐天地 ',
      // 'bv' => '好牧人',
      // 'bv' => '善牧良言',
      // 'bv' => '经动人心',
      // 'bv' => '信仰百宝箱',
      // 'bv' => '生命的福音',
      // 'bv' => '听听女人心',
      // 'bv' => '生根建造',
      // 'bv' => '聆听主道',
      // 'bv' => '圣言盛宴',
      // 'bv' => '真理之光',
      // 'wpb' => '圣乐天地 - 古典圣诗',http://liangyou.nissigz.com:18100/wpb/wpb140301.mp3
      // 'bv' => '空中崇拜',
      // 'bv' => '给力人生',
      // 'bv' => '空中门训',
      // 'bv' => '生活之光',

      // 'nissigz3' = array(
      //  // 训练节目-适合事奉人员
      //  // 接棒人
      //  // 晨曦讲座
      //  // 申命记
      //  // 教牧辅导
      //  // 事奉装备
      //  // 基督教教义
      //  // 基督教伦理学
      //  // 圣诞节特辑
      //  // 新约神学
      //  ),
    );
	return $radios_list;
}

function liangyou_audio_respond($wechatObj,$keyword,$radios_list)
{
	
      // bv-1;
      // || in_array(substr($keyword, 0,2), array_keys($radios_list)) 
      if(in_array($keyword, array_keys($radios_list))) {
        $offset = 0;
        // if(strlen($keyword)>2){
        //   $offset = substr($keyword, 3,1);
        //   $keyword = substr($keyword, 0,2);
        //   watchdog('offset', $offset, array(), WATCHDOG_NOTICE, 'link');
        // }
        $url = $radios_list[$keyword]['url'];
        $html = file_get_html($url);
        $pattern = '/download_mp3:"http:\/\/stream.liangyou.net\/get_download\/\w+-\w+/';
        preg_match_all ($pattern, $html, $matches);
        // $Title = trim($html->find('#div_playlist li div [tabindex=1]', 0)->plaintext);
        $audio_url = str_replace('download_mp3:"', '', $matches[0][0]);
        $live_radio = get_headers($audio_url,true);
        $true_url = $live_radio['location'];


        $title = $radios_list[$keyword]['name'];//'英语世界';
        $week_day = date('N', time());
        $title = "【".$keyword."】".$title;
        $string = date('ymd',time()-$offset*24*60*60);
        // $musicurl = // http://liangyou2.nissigz.com:15200/gv/gv131218.mp3
        $musicurl = $true_url;
        $desc = "公众号:永不止息 ".date("n月d日-周").$week_day;
        $hgmusicurl = $musicurl;
        $wechatObj->music($title, $desc, $musicurl, $hgmusicurl)->reply();
        return;
      }
}