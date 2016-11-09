	<?php
	$projects_count = get_theme_mod( 'mellow_recent_projects_count', 9 );
	?>
	<?php if($projects_count > 0) { ?>
	<section id="projects">

	<?php
		/**
		* Set up the skills and projects
		*
		* @see inc/template-tags.php
		*/

		// FilterNav output
		mellow_filter_nav('home');

		// Get the projects WP_Query object
		$projects = mellow_posts_setup( array('sngrs_rgr_cpt', 'sngrs_school_cpt', 'sngrs_sngrs_cpt', 'sngrs_photo_cpt'), $projects_count );

		// Set masonry class
		$masonry_class  = '';

		if ( 'masonry' == get_theme_mod( 'mellow_isotope_mode' ) )
			$masonry_class = ' class="masonry"';
		?>

		<div id="projects"<?php echo $masonry_class; ?>>
			<div class="thumbs clearfix">
				<?php  while ( $projects->have_posts()) : $projects->the_post();

					// Get the skills for each project for the .js data attribute
					$skills = mellow_get_tax( $post, 'home' );

					get_template_part( 'content', 'project-thumb' ); ?>

				<?php endwhile; ?>
			</div><!-- .thumbs -->
		</div><!-- #projects -->
		
	</section><!-- #projects-home -->
	<?php } ?>