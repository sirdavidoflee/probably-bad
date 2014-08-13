<?php
/**
 * The template for displaying search results pages.
 *
 * @package Bad Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			 
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'bad-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			

			<?php /* Start the Loop */ ?>
<?php 
				while ( have_posts() ) : the_post(); 
				$title = $post->post_title;
				$excerpt = wp_trim_words(get_the_excerpt(), '10');
				$category = get_the_category($post->ID)[0];
?>

				<li>
<?php
				if(has_post_thumbnail()):
?>
					<a href="<? echo get_permalink() ?>">
						<?php the_post_thumbnail('large'); ?>
					</a>
<?php
				endif;
?>
					<h4><a href="<? echo get_permalink() ?>"><? echo $title ?></a></h4>
					<p><? echo $excerpt ?></p>
				</li>

			<?php endwhile; ?>

			<?php bad_theme_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
