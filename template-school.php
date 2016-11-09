<?php
/**
 * Template Name: SNGRS School
 * @package sngrs
 */

global $ttrust_config;

get_header(); ?>

	<!-- Static Content -->
	<?php while( have_posts() ) : the_post(); ?>
		<?php if( $post->post_content ):?>
			<section id="main-content" class="content-area">

				<h1 class="entry-title"><?php the_title(); ?></h1>

					<?php the_content(); ?>


			</section><!-- #main-content -->

			<?php $ttrust_config['page_skills'] = get_post_meta( $post->ID, "mellow_page_skills", true ); //See if there are any associated skills listed ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<!-- Portfolio Home -->
	<?php get_template_part( 'content-school' ); ?>

<?php get_footer(); ?>
