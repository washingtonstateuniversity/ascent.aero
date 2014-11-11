<?php

get_header();

$main_class = '';
?>

	<main class="<?php echo $main_class; ?>">

		<?php get_template_part('parts/headers'); ?>

		<section class="row side-right gutter pad-ends">

			<div class="column one">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'articles/post', get_post_type() ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!--/column-->

			<div class="column two">

				<?php get_sidebar(); ?>

			</div><!--/column two-->

		</section>

	</main>
<?php

get_footer();