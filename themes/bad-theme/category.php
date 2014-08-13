<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */




$cat = get_the_category()[0];
$category_query = new WP_Query('posts_per_page=2&offset=1&cat=' . $cat->cat_ID);
$category_query->query_vars[ 'paged' ] > 1 ? $current = $category_query->query_vars[ 'paged' ] : $current = 1;

$featured_query = new WP_Query('posts_per_page=1&cat=' . $cat->cat_ID);

$categoryMeta = get_field('categories', 'option');
get_header(); ?>


<section class="page-hero">
<?php
	foreach($categoryMeta as $catMeta){
		if($catMeta['title'] == $cat->name):
?>
	<div class="inner">
		<h1><?php echo $catMeta['section_title']?></h1>
		<p><?php echo $catMeta['description']?></p>
	</div>
	<div class="featured-img">
		<img src="<?php echo $catMeta['hero_image']['url'] ?>" alt="<?php echo $catMeta['hero_image']['alt'] ?>" />
	</div>
<?php
		endif;
	}
?>
</section>

<section class="main">
	
	<h2>Featured Content</h2>
	<div class="featured-post">
<?php
	while ($featured_query->have_posts()) : $featured_query->the_post();

		$title = $post->post_title;
		$excerpt = wp_trim_words(get_the_excerpt(), '20');
		$excerptMobile = wp_trim_words(get_the_excerpt(), '5');
		$category = get_the_category($post->ID)[0];
		$date = mysql2date('F j', $post->post_date);
		$dateYear = mysql2date('Y', $post->post_date);
		//$time = mysql2date('g:iA', $post->post_date);
?>
<?php
		if(has_post_thumbnail()):
?>
		<div class="featured-img">
			<a href="<? echo get_permalink() ?>">
				<?php the_post_thumbnail('large'); ?>
			</a>
			<h5 class="<? echo $category->slug ?>"><? echo $category->name ?></h5>
		</div>
<?php
		endif;
?>
		<div class="summary">
			<h4><a href="<? echo get_permalink() ?>"><? echo $title ?></a></h4>
			<p><? echo $excerpt ?></p>
			<a href="<? echo get_permalink() ?>" class="btn">Read the story</a>
<?php
			if($category->slug != 'inline-ad'):
?>
			<ul class="meta-list">
				<li><h5><? echo $category->name ?></h5></li>
				<!--<li><? echo $time ?></li>-->
				<li><? echo $date ?>, <? echo $dateYear ?></li>
			</ul>
<?php
			endif;
?>
		</div>


<?php
	endwhile;
?>
	</div>
	
	<h2>More Content</h2>
	<section class="main-content">
		<ul class="post-list">
			
<?php		
		while ($wp_query->have_posts()) : $wp_query->the_post();

			$start = ($wp_query->query_vars['paged'] == 0) ? 1 : (($wp_query->query_vars['paged'] - 1) * $wp_query->query_vars['posts_per_page']) + 1;
			$end = $start + ($wp_query->query_vars['posts_per_page'] - 1);
			$end = ($end > $wp_query->found_posts)? $wp_query->found_posts : $end;
			$total = $wp_query->found_posts;

			$title = $post->post_title;
			$excerpt = wp_trim_words(get_the_excerpt(), '15');
			$excerptMobile = wp_trim_words(get_the_excerpt(), '5');
			$category = get_the_category($post->ID)[0];
			$date = mysql2date('F j', $post->post_date);
			$dateYear = mysql2date('Y', $post->post_date);
			//$time = mysql2date('g:iA', $post->post_date);
?>


			<li class="<? echo $category->slug ?>">
				<div class="featured-img">
<?php
				if(has_post_thumbnail()):
?>
				<a href="<? echo get_permalink() ?>">
					<?php the_post_thumbnail('large'); ?>
				</a>
<?php
				endif;
?>
			
			
<?php
					if($category->slug != 'inline-ad'):
?>
					<h5><? echo $category->name ?></h5>
<?php
					endif;
?>
				</div>
				<div class="summary">
					<h4><a href="<? echo get_permalink() ?>"><? echo $title ?></a></h4>
					<p><? echo $excerpt ?></p>
					<p class="intro-mobile"><? echo $excerptMobile ?></p>
<?php
					if($category->slug != 'inline-ad'):
?>
					<ul class="meta-list">
						<li><h5><? echo $category->name ?></h5></li>
						<!--<li><? echo $time ?></li>-->
						<li><? echo $date ?>, <? echo $dateYear ?></li>
					</ul>
<?php
					endif;
?>
				</div>
			</li>

<?php
		endwhile; // end of the loop. 
?>

		</ul>
		<div class="pagination">
			<ul class="prev-next">
				<li class="prev"><?php previous_posts_link('&laquo; Prev', $wp_query->max_num_pages) ?></li>
				<li class="next"><?php next_posts_link('Next &raquo;', $wp_query->max_num_pages) ?></li>
			</ul>
			<h4><span>Showing</span> results <?php echo $start . '-' . $end . ' of ' . $total ?></h4>
		</div>
	</section>
	<aside>
		<ul>
			<?php get_template_part( 'partials/sidebar', 'banners' ); ?>
			<?php get_template_part( 'partials/sidebar', 'stats' ); ?>
		</ul>
	</aside>
	
	<?php get_template_part( 'partials/newsletter' ); ?>
	<?php get_template_part( 'partials/learnmore' ); ?>
</section>
<?php get_footer(); ?>
