<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bad Theme
 */
	if(has_post_thumbnail($post->ID) && !is_front_page()) {
		$siteImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	} elseif(is_front_page()) {
		$siteImg = '/wp-content/themes/bad-theme/img/share-logo.jpg';
	} else {
		$siteImg = '/wp-content/themes/bad-theme/img/share-logo.jpg';
	}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<meta name="description" content="One way or another, every movie, tv show, or video game is probably bad. We will tell you why." />
<meta property="og:image" content="<?php echo $siteImg ?>" />

<?php wp_head(); ?>
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
