<header id="navbar" role="banner" class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container">
    <div class="logo">
      <?php if ($logo): ?>
        <a class="brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          <!--img src="http://simg.sinajs.cn/xblogstyle/images/common/logo_act.png" alt=""-->
        </a>
      <?php endif;?>
    </div>
    <nav role="navigation" class="clearfix">
      <?php if ($primary_nav): ?>
      	<div class="pull-left">
          <?php print $primary_nav; ?>
        </div>
      <?php endif; ?>
     	<?php if ($secondary_nav): ?>
     		<div class="pull-right">
          <?php print $secondary_nav; ?>
        </div>
      <?php endif; ?>

   </nav>
  </div></div>
</header>

<div class="container" >

  <header role="banner" id="page-header">
    <?php if ( $site_slogan ): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#header -->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="row" id="page-wrapper">
        
        <?php if ($page['sidebar_first']): ?>
          <aside class="span3" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside>  <!-- /#sidebar-first -->
        <?php endif; ?>  
        
        <section class="<?php print _twitter_bootstrap_content_span($columns); ?>" id="page-section">  
          <?php if ($page['highlighted']): ?>
            <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>
          <?php if ($breadcrumb): print $breadcrumb; endif;?>
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <h1 class="page-header"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php print $messages; ?>
          <?php if ($tabs): ?>
            <?php print render($tabs); ?>
          <?php endif; ?>
          <?php if ($page['help']): ?> 
            <div class="well"><?php print render($page['help']); ?></div>
          <?php endif; ?>
          <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
          <?php endif; ?>
          <?php print render($page['content']); ?>
        </section>

        <?php if ($page['sidebar_second']): ?>
          <aside class="span3" role="complementary well">
            <div class="aside">
              <div class="info-box">
                  <!-- 头像 -->
                 
                  <div class="avatar">
                     <?php print love_user_picture($user); ?>
                  </div>
                  <!--img alt="xiangfei" src="http://m3.img.libdd.com/farm2/199/3BC902E9F4C46C50E55066F20B6ED4C7_100_100.JPEG" class="avatar"-->
                  <!-- 博客描述 -->
                  <div class="description description-with-follow">
                    <?php if($user->uid)print($user->signature?$user->signature:"这家伙很懒，还没写签名....这家伙很懒，还没写签名....这家伙很懒，还没写签名....")?>

                  </div>
                  <!-- 常用链接入口 -->
                  <div class="links links-with-follow">
                      <a href="http://feesx.diandian.com/submit">投稿</a> / 
                      <a href="http://feesx.diandian.com/inbox">私信</a> / 
                      <a href="http://feesx.diandian.com/archive">存档</a> /
                      <a href="http://feesx.diandian.com/rss">RSS</a>
                  </div>
                  
                  <div class="follow">
                      <a class="follow-btn" href="http://www.diandian.com/follow/feesx">交友申请</a>
                  </div>
                  
              </div>
              <!-- 自定义页面 -->
              
              <div class="search-box">
                  <form method="get" action="/search/node?">
                      <input type="text" placeholder="搜索" name="search" class="text">
                      <input type="submit" value="搜索" class="submit">
                  </form>
              </div>

              <div id="aside">
                <ul class="sidemenu sidebox">
                  
                  <li id="asideFollowing" class="first  aside-follow-content">
                   <a href="http://www.diandian.com/following">
                    <span class="aside-icon"></span>
                    谁看过我（谁正在看我）
                    </a>
                  </li>
                  <li id="asideFollowing" class="first  aside-follow-content">
                   <a href="http://www.diandian.com/following">
                    <span class="aside-icon"></span>
                    我看过谁
                    </a>
                  </li>
                  <li id="asideFollowing" class="first  aside-follow-content">
                   <a href="relationships">
                    <span class="aside-icon"></span>
                    好友
                    </a>
                  </li>
                  <li id="asideFollowing" class="first  aside-follow-content">
                   <a href="http://www.diandian.com/following">
                    <span class="aside-icon"></span>
                    Ta想认识你
                    </a>
                  </li>
                  <li id="asideFollowing" class="first  aside-follow-content">
                   <a href="http://www.diandian.com/following">
                    <span class="aside-icon"></span>
                    我想认识的
                    </a>
                  </li>
                  <li id="asideIlike" class="aside-i-like ">
                  <a href="http://www.diandian.com/fav">
                  <span class="aside-icon"></span>我喜欢了<span id="side-fav-count">1</span>张相片
                  </a>
                  </li><li id="asideExplore" class="sub aside-explore-blog">
                  <a href="http://www.diandian.com/category/%E5%BB%BA%E7%AD%91">
                  <span class="aside-icon"></span>
                  发现更多
                  </a>
                  </li>
                </ul>
              </div>

              <div class="copyright">
                  Powered by <a target="_blank" href="http://drupal.org">Drupal</a>.
              </div>
          </div>


            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
        <?php endif; ?>
      </div>
    </div>
  </div><!-- /container-fluid -->
  <footer class="footer container">
    <?php print render($page['footer']); ?>
  </footer>
</div>
