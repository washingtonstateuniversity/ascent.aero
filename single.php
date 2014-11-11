<?php

get_header();

// If a featured image is assigned to the post, display as a background image.
if ( spine_has_background_image() ) {
	$background_image_src = spine_get_background_image_src();
	?><style> html { background-image: url(<?php echo esc_url( $background_image_src ); ?>); }</style><?php
}

?>

	<main>

		<?php get_template_part('parts/headers'); ?>

		<?php if ( spine_has_featured_image() ) : ?>
			<?php $featured_image_src = spine_get_featured_image_src(); ?>
			<figure class="featured-image" style="background-image: url('<?php echo $featured_image_src ?>');">
				<?php spine_the_featured_image(); ?>
			</figure>
		<?php endif; ?>

		<section class="row single gutter pad-ends">

			<div class="column one">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'articles/post', get_post_type() ); ?>

				<?php endwhile; ?>

			</div><!--/column-->

		</section>

		<footer class="main-footer"></footer>

	</main><!--/#page-->

<?php get_footer(); ?>