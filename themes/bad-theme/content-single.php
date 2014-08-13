<?php
/**
 * @package _s
 */

$pageUrl = urlencode(get_the_permalink());

?>
<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<div class="entry-meta">
	<?php bad_theme_posted_on(); ?>
</div><!-- .entry-meta -->

<?php
	if(has_post_thumbnail()):
?>
<div class="entry-media">
	<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" alt="<?php echo get_the_title() ?>" itemprop="image" />
</div>
<?php
	endif;
?>

<ul class="social-share">
	<li class="title">Share</li>
	<li class="twitter">
		<a href="https://twitter.com/home?status=<?php echo $pageUrl ?>%3Futm_source%3Dpageshare%26utm_medium%3Dsocialshare%26utm_content%3Dtweet%26utm_campaign%3Dabb" class="bad-icon-twitter" target="_blank">
			<span>Twitter</span>
		</a>
	</li>
	<li class="facebook">
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pageUrl ?>%3Futm_source%3Dpageshare%26utm_medium%3Dsocialshare%26utm_content%3Dfbpost%26utm_campaign%3Dabb" class="bad-icon-facebook" target="_blank">
			<span>Facebook</span>
		</a>
	</li>
</ul>

<div class="entry-content">
	<?php the_content(); ?>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after'  => '</div>',
		) );
	?>
</div><!-- .entry-content -->