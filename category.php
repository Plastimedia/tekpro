<?php get_header(); ?>

<?php
// Get the current category ID, e.g. if we're on a category archive page
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
// Get the image ID for the category
$image_id = get_term_meta ( $cat_id, 'category-image-id', true );
?>
<div class="head-image">
	<div class="img-sec">
	    <?php echo wp_get_attachment_image ( $image_id, 'full' ); ?>
	</div>
	<div class="page-heading">
		<h1><?php single_cat_title(); ?></h1>
	</div>
</div>
<div class="en_desarrollo">
<?php the_custom_logo(); ?>
<p>En desarrollo...</p>
</div>  
<main>
	<div class="ancho">
		<?php if ( have_posts() ) : ?>
			<div class="contenedor">
				<?php while ( have_posts() ) :
				    the_post();
				?>
					<article class="category-post">
						<div class="category-post-area">
							
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php ImagenDestacadaPlas('category','entrada') ?>
								</a>
							</div>
							<h2 class="post_title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="post_body">
								<p><?php the_excerpt(); ?></p>
								<p class="readmore">
									<a href="<?php the_permalink(); ?>">Leer más</a>
								</p>
							</div>

						</div>
					</article>
				<?php endwhile; ?>
			</div>

				<?php 
				if(CONFPLAS['paginacion-entradas-en-categoria']) : 
					PginacionPlas();
				endif;
				?>

		<?php else : ?>
				<p class="nothing"><?php echo CONFPLAS['mensaje-cuando-no-hay-entradas']; ?></p>
		<?php
			endif;
			wp_reset_postdata();
		?>

	</div>
</main>
<?php get_footer(); ?>



