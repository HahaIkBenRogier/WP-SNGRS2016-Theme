	<section id="projects">

		<?php
			/**
			* Set up the skills and projects
			*
			* @see inc/template-tags.php
			*/

			global $ttrust_config;

			// FilterNav output
			mellow_filter_nav( 'sngrs_school_tax', $ttrust_config['page_skills'] );

			// Get the projects WP_Query object
			$projects = mellow_posts_setup( 'sngrs_school_cpt', 200, $ttrust_config['page_skills'] );

			// Set masonry class
			$masonry_class  = '';

			if ( 'masonry' == get_theme_mod( 'mellow_isotope_mode' ) )
				$masonry_class = ' class="masonry"';
			?>

			<div id="projects"<?php echo $masonry_class; ?>>
				<div class="thumbs clearfix">
					<?php  while ( $projects->have_posts() ) : $projects->the_post();

						// Get the skills for each project for the .js data attribute
						$skills = mellow_get_tax( $post, 'sngrs_school_tax' );

						get_template_part( 'content', 'project-thumb' ); ?>

					<?php endwhile; ?>
				</div><!-- .thumbs -->

			</div><!-- #projects -->

	</section><!-- #projects -->
