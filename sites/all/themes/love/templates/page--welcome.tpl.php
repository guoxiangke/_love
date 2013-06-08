<?php
?>
<div id="wrapper" class="container-fluid">
  <div class="row-fluid clearfix">

    <div id="falmily" class="span8">

     <!--  <div class="main-title">
       <p class="bibles-say">“因此，人要离开父母与妻子联合，二人成为一体。” --创世纪 2:24</p>
      </div>
      <img src="<?php //print 'http://'.$_SERVER['HTTP_HOST'].'/'.path_to_theme(); ?>/family_2.png" /> -->
      <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
          <div class="item active"><div class="main-title">
       <p class="bibles-say">“因此，人要离开父母与妻子联合，二人成为一体。” --创世纪 2:24</p>
      </div>
            <img src="<?php print 'http://'.$_SERVER['HTTP_HOST'].'/'.path_to_theme(); ?>/family_3.png" />
            <div class="carousel-caption">
              <h4>异象：</h4>
              <p>爱是互相激励、共同成长，并且需要公众见证、公开交往，接受监督的，让更多的肢体在婚恋交友，及组建家庭上彰显神的荣耀。</p>
            </div>
          </div>
          <div class="item">
            <img src="<?php print 'http://'.$_SERVER['HTTP_HOST'].'/'.path_to_theme(); ?>/family_2.png" />
            <div class="carousel-caption">
              <h4>创世纪 2:18</h4>
              <p>耶和华神说，那人独居不好，我要为他造一个配偶帮助他。</p>
            </div>
          </div>
          <div class="item">
            <img src="<?php print 'http://'.$_SERVER['HTTP_HOST'].'/'.path_to_theme(); ?>/family_1.png" />
            <div class="carousel-caption">
              <h4>以弗所书5:33</h4>
              <p>然而你们各人都当爱妻子，如同爱自己一样。妻子也当敬重她的丈夫。</p>
           </div>
          </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
      </div>

    </div>

    <div class="main-content span4">
        <center>
           <h1 class="sitename">永不止息</h1>
          <?php if ( $messages ): ?>
            <div id="love-messages"><?php print $messages; ?></div>
          <?php endif; ?>
          <p class="site-slogan">幸福家庭，从婚恋迈出第一步,</p>
          <p class="site-slogan">响应呼召，组建家庭，让爱永不止息！</p>
        </center>

        <div id="love-login-form">
          <?php $login_form = drupal_get_form('user_login');print drupal_render($login_form); ?>
        </div>
        <div class="site-des">
          <p>&nbsp;&nbsp;</p>
          <ul>
            <li>【永不止息】只接受熟人间邮箱邀请注册，请为您邀请的肢体祷告，您在熟人之间互相介绍时，应慎重，严谨，并为之代祷。</li>
            
            <li>为<a href="javascript:void(0)" rel="tooltip" title="请为本站营造良好的社交环境。<br/>为教会单身守望。">本站代祷</a> ，<a href="https://me.alipay.com/guoxiangke" target="_blank" rel="tooltip" title="如果您觉得打开速度慢，那么您可以在网站服务器升级上有分">支持奉献</a>，<a href="mailto:admin@yongbuzhixi.com" rel="tooltip" title="admin@yongbuzhixi.com">意见建议</a>，<a href="javascript:void(0)" rel="tooltip" data-placement="top" title="【永不止息】是@bluesky_still透过对当前教会单身肢体需求的看见，业余时间开发的针对主内肢体婚恋社交网站，通过简洁的关系建立渠道，熟人的推荐，舆论监督与指导，为肢体提供一个便捷互相了解、信实互动的社交平台。">成长历程</a></li>
            <!--li><a href="http://blog.liangyou.net/lianai/"  rel="tooltip" title="如果您还未收到邀请，听听这个节目，预备自己成为理想的另一半吧！"><img src="<?php print path_to_theme(); ?>/lianai.jpg" alt=""></a><a href="#" rel="tooltip" title="打开速度慢，这个建议就不用提了^_^"></a></li-->
            <li><a  href="http://blog.liangyou.net/lianai/"  rel="tooltip"  title="未收到邀请？听听这个节目，预备自己成为理想的另一半吧！">今日广播</a><embed type="application/x-shockwave-flash" width="240" height="24" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.drupal_get_path('module','love')?>/player.swf?soundFile=http://liangyou.nissigz.com/media/se/se<?php echo date("ymd");?>.mp3&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0x357DCE&amp;rightbghover=0x4499EE&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;slider=0x357DCE&amp;track=0xFFFFFF&amp;border=0xFFFFFF&amp;loader=0x8EC2F4&amp;autostart=no&amp;loop=no" wmode="transparent" quality="high">
</li>          </ul>
        </div>
      </div>
   </div>
</div>
<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('8506-544-10-4211');/*]]>*/</script><noscript><a href="https://www.olark.com/site/8506-544-10-4211/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->