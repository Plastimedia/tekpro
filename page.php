
<?php get_header(); ?>
	<?php while ( have_posts() ) : ?>		
		<?php  the_post(); ?>
		<!-- <div class="head-image">
			<div class="img-sec">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'large' );
				}else{ ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fondo-full.jpg" alt="portada">
				<?php } ?>
			</div>
			<div class="page-heading">
				
			</div>
		</div> -->
		<main class="">
		<div class="migas">
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php if(function_exists('bcn_display'))
						{
							bcn_display();
						}?>
					</div> 
				</div>
			<?php if(!is_checkout()): ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
		</main>
	<?php endwhile; ?>
<?php get_footer(); ?>

