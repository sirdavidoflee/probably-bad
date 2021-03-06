<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bad Theme
 */
	global $metaDesc;

	if(has_post_thumbnail($post->ID) && !is_front_page()) {
		$siteImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	} elseif(is_front_page()) {
		$siteImg = 'http://probablybad.com/wp-content/themes/bad-theme/img/share-logo-square.jpg';
	} else {
		$siteImg = 'http://probablybad.com/wp-content/themes/bad-theme/img/share-logo-square.jpg';
	}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php if(isset($metaDesc)): ?>
	<?php $metaDesc = str_replace('"', '', $metaDesc); ?>
	<meta name="description" content="<?php echo $metaDesc; ?>" />
<?php else: ?>
	<meta name="description" content="One way or another, every movie, tv show, or video game is probably bad. We will tell you why." />
<?php endif; ?>
<meta property="og:image" content="<?php echo $siteImg ?>" />

<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53838158-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body <?php body_class(); ?>>
	
	<header>
		<div class="inner">
			<h1><a href="/">Probably Bad</a></h1>
		</div>
		<form action="/" method="get">
			<input type="search" name="s" placeholder="Search" />
		</form>
	</header>
	
<div id="page" class="hfeed site">
	

	<section class="bad-content">
