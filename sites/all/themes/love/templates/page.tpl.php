<?php if(user_is_anonymous() && arg(0)!=='user'): ?>

<div id="wrapper" class="container-fluid">
  <div class="row-fluid">
      <div class="main-content" class="span12">
        <center><img src="<?php print path_to_theme(); ?>/Logo.png" class="logo" /></center>
        <?php print drupal_render(drupal_get_form('user_login')); ?>
      </div>
  </div>
</div>

<?php else:?>

<header id="navbar" role="banner" class="navbar navbar-fixed-top">

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
<?php endif ?>
