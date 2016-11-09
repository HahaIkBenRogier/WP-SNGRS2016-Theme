<?php
/**
 * The template used for displaying project thumbs
 *
 * @package sngrs
 * @since 1.0
 */

$skills_class = mellow_thumb_setup(); /** @see inc/template-tags.php */
?>

<figure class="brick project <?php echo $skills_class; ?>" id="<?php echo $post->ID; ?>">
	<?php if( has_post_thumbnail() && 1 == get_post_meta( $post->ID, 'large_thumb', true ) ) { // Large thumbnail
		the_post_thumbnail( 'sngrs_home_image_l', array( 'class' => 'large', 'alt' => '' . the_title_attribute( 'echo=0' ) . '', 'title' => '' . the_title_attribute( 'echo=0' ) . '' ) );
	} elseif( has_post_thumbnail() ){ // Small thumbnail
		the_post_thumbnail( 'sngrs_home_image', array( 'class' => '', 'alt' => '' . the_title_attribute( 'echo=0' ) . '', 'title' => '' . the_title_attribute( 'echo=0' ) . '' ) );
	} else {  // Empty project placeholder ?>
		<span class="empty-project"></span>
	<?php } ?>

	<figcaption>
		<div class="inner"><h3><?php the_title(); ?></h3></div>
	</figcaption>

	<a class="item-link" href="<?php the_permalink(); ?>" alt="<?php echo the_title_attribute( 'echo=0' ); ?>"></a>

</figure><!-- <?php echo $post->ID; ?> -->
