<?php
/**
 * Template Name: SNGRS Home
 * @package sngrs
 */

get_header(); ?>

	<!-- Static Content -->
	<?php while( have_posts() ) : the_post(); ?>
		<?php if( $post->post_content ):?>
			<section id="main-content" class="content-area">

					<?php the_content(); ?>

			</section><!-- #main-content -->
		<?php endif; ?>
	<?php endwhile; ?>

	<!-- Portfolio Home -->
	<?php get_template_part( 'content-projects-home' ); ?>

	<!-- Blog Home -->
	<?php get_template_part( 'content-posts-home' ); ?>

	<!-- Widgets Home -->
	<?php get_template_part( 'content-widgets-home' ); ?>

<?php get_footer(); ?>
