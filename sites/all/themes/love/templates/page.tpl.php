<header id="navbar" role="banner" class="navbar navbar-fixed-top">

  <div class="container">
    
    <nav role="navigation" class="clearfix">
      <div class="logo">
        <?php if ($logo): ?>
            
            <a class="brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <span  class="site-name">永不止息<i class="icon-fire"></i></span>
            <!--img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
            <img src="http://simg.sinajs.cn/xblogstyle/images/common/logo_act.png" alt=""-->
          </a>
        <?php endif;?>
      </div>

      <?php if ($primary_nav): ?>
        <div class="pull-left">
          <?php print $primary_nav; ?>
        </div>
      <?php endif; ?>

     <!--   <?php if ($secondary_nav): ?>
        <div class="pull-right ml-24">
          <?php print $secondary_nav; ?>
        </div>
      <?php endif; ?> -->


      <?php if (!user_is_anonymous()): ?>
      <div class="pull-right">
<!--         <span class="menu-user btn-group">
          <a class="btn" href="#"  data-toggle="dropdown"  rel="tooltip" data-placement="bottom" data-original-title="<?php echo $user->name;?>"> <i class="icon-user"></i><?php print truncate_utf8($user->name, $max_length=7, $wordsafe = TRUE, $add_ellipsis = TRUE, $min_wordsafe_length = 1);?></a>
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="icon-caret-down"></span></a>
          <ul class="dropdown-menu">
              <li><a href="#"><i class="icon-pencil"></i> 编辑个人资料</a></li>
              <li><a href="#"><i class="icon-pencil"></i> 编辑信仰资料</a></li>
              <li><a href="#"><i class="icon-heart"></i> 编辑择偶标准</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="icon-group"></i> 我的关系</a></li>
          </ul>
         </span> -->
        <span class="menu-pic">
        <?php global $user;print l($menu_user_picture,'user/'.$user->uid,array('html'=>TRUE,'attributes'=>array('title'=>$user->name,'data-toggle'=>'dropdown'))); ?>
          <ul class="dropdown-menu">
              <li><a href="/user"><i class="icon-home"></i> 我的主页</a></li>
              <li><a href="/user/<?php echo $user->uid?>/edit/main"><i class="icon-cog"></i> 编辑个人资料</a></li>
              <li><a href="/user/<?php echo $user->uid?>/edit/believes"><i class="icon-pencil"></i> 编辑信仰资料</a></li>
              <li><a href="/user/<?php echo $user->uid?>/edit/requirements"><i class="icon-heart"></i> 编辑择偶标准</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="icon-group"></i> 我的关系</a></li>
          </ul>
        </span>
        <!--span class=" menu-group"><a href="/relationships/my" rel="tooltip" data-placement="bottom" title="我的关系"><i class="icon-group  icon-large"></i></a></span-->
        <span class="secondary-menu menu-invite"><a href="/invite/others" rel="tooltip" data-placement="bottom" title="邀请熟人"><i class="icon-gift  icon-large"></i></a></span>
        <span class="secondary-menu menu-message"><a href="/messages/recent" rel="tooltip" data-placement="bottom" title="消息"><i class="icon-envelope  icon-large"></i></a></span>
        <span class="secondary-menu menu-logout"><a href="/user/logout" rel="tooltip" data-placement="bottom" title="退出"><i class="icon-signout  icon-large"></i></a></span>
        
        </div>
      <?php endif; ?>
   </nav>
  </div></div>
</header>

<div class="container">

  <header role="banner" id="page-header">
    <?php if ( $site_slogan ): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#header -->
  <div class="container-fluid" id="pjax-container">
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
            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
        <?php endif; ?>
      </div>
    </div>
  </div><!-- /container-fluid -->
  <a href="#" class="scrollup">Scroll</a>
  <?php if (!user_is_anonymous()): ?>
  <div class="love-feedback" data-toggle="modal" data-target="#suggestion" >意<br>见<br>反<br>馈<br></div>

  <!-- Modal -->
<div id="suggestion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">［永不止息］需要有你！</h3>
   </div>
   <div class="modal-body">
    <?php print drupal_render($feedback);?>
  </div>
</div>
  <?php endif; ?>
 <?php 
//limit
 if (isset($invite_form)): ?>
<div id="invite_form" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">有爱分享，邀请熟人</h3>
   </div>
   <div class="form-item-relationship-invite-approve">
    <p class="help-block">提示：由于QQ限制，QQ邮箱请生成链接发给好友，其他邮箱可以直接发送邀请。</p>
   </div>
   <div class="modal-body">
    <?php print drupal_render($invite_form);?>
  </div>
</div>
<?php endif ?>
<div id="add-photo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 

     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">请选择[照片]或[文字]发布到朋友圈</h3>
   </div>
   <div class="modal-body">
     <?php print render($add_photo); ?>
  </div>
</div>
  <footer class="footer container">
    <?php print render($page['footer']); ?>
  </footer> 
</div>