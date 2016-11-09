<?php
/**
 * @package sngrs
 * @version 1.0
 */
	$footer_left    = get_theme_mod( 'mellow_footer_left' );
	$footer_right   = get_theme_mod( 'mellow_footer_right' );
?>
	</div><!-- .site-content -->
	<footer class="site-footer clearfix" role="contentinfo">
		<div class="inner">
			<div class="primary row">

				<?php if( is_active_sidebar( 'footer' ) ) { dynamic_sidebar( 'footer' ); } ?>

			</div><!-- .primary-->

			<div class="secondary row">

				<div class="six columns">
					<p><?php if( $footer_left ){ echo( $footer_left ); } else{ ?>&copy; <?php echo date( 'Y' );?> <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>. All Rights Reserved.<?php }; ?></p>
				</div>
				<div class="six columns tt-pull-right">
					<?php if( $footer_right ) { ?>
						<p><?php if( $footer_right ){ echo( $footer_right ); } ?></p>
					<?php } ?>
				</div>
			</div><!-- .row-->
		</div><!-- inner -->
	</footer>
</div><!-- #page -->
<!--<div class="grid-overlay" data-baseline="34"></div>-->
	<?php wp_footer(); ?>

</body>
</html>