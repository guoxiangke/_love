<?php
define('DRUPAL_ROOT', '../');
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>书香园地</title>
		<meta name="description" content="Fullscreen Pageflip Layout with BookBlock" />
		<meta name="keywords" content="fullscreen pageflip, booklet, layout, bookblock, jquery plugin, flipboard layout, sidebar menu" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.custom.css" />
		<link rel="stylesheet" type="text/css" href="css/bookblock.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<script src="js/modernizr.custom.79639.js"></script>
	</head>
	<body>
		<div id="container" class="container">	<pre>
<?php 
	$book_index_nid = 102;
  $book_node = node_load($book_index_nid);
  $tree = book_menu_subtree_data($book_node->book);
  $tree = array_shift($tree); // Do not include the book item itself.

//print_r($node_build)
    ?></pre>
			<div class="menu-panel">
				<h3><?php echo $book_node->title;?></h3>
				<ul id="menu-toc" class="menu-toc">
				<?php 
				$items = array();
				//echo '<li><a href="#book-'.$book_node->nid.'">'.$book_node->title.'</a></li>';
				foreach ($tree['below'] as $key => $value) {
					$nid = $value['link']['nid'];
					echo '<li><a href="#book-'.$nid.'">'.$value['link']['link_title'].'</a></li>';
					$node = node_load($nid);
					$build = node_view($node);
					$items[$nid]['body'] = $build['body'];
					$items[$nid]['title'] = $node->title;
				}?>
				</ul>
				<div>
					<a href="../">&larr; 返回</a>
				</div>
			</div>

			<div class="bb-custom-wrapper">
				<div id="bb-bookblock" class="bb-bookblock">
					<div class="bb-item" id="book-<?php echo  $book_node->nid; ?>">
						<div class="content">
							<div class="scroller">
								<h2><?php echo $book_node->title;?></h2>
								<p><?php $build = node_view($book_node);
								print drupal_render($build['body']);?></p>
							</div>
						</div>
					</div>

					<?php
						foreach ($items as $nid => $body) {
							?>
					<div class="bb-item" id="book-<?php echo  $nid; ?>">
						<div class="content">
							<div class="scroller">
								<h2><?php echo $items[$nid]['title'];?></h2>
								<p><?php print drupal_render($items[$nid]['body']);?></p>
							</div>
						</div>
					</div>
							<?php
						}
					?>

				</div>
				
				<nav>
					<span id="bb-nav-prev">&larr;</span>
					<span id="bb-nav-next">&rarr;</span>
				</nav>

				<span id="tblcontents" class="menu-button">Table of Contents</span>

			</div>
				
		</div><!-- /container -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/jquery.mousewheel.js"></script>
		<script src="js/jquery.jscrollpane.min.js"></script>
		<script src="js/jquerypp.custom.js"></script>
		<script src="js/jquery.bookblock.js"></script>
		<script src="js/page.js"></script>
		<script>
			$(function() {

				Page.init();

			});
		</script>
	</body>
</html>
