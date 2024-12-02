
<?php get_header(); ?>
		
		<main class="shopPage" id="no">
			<section class="encabezado">
				<img src="/wp-content/uploads/2024/04/FONDOTIENDA.png" alt="">
			</section>
			<div class="migas">
				<div class="ancho">
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php if (function_exists('bcn_display')) {
							bcn_display();
						} ?>
					</div> 
				</div>
			</div>
			<div class="tienda">

				<aside class="navegacion">
					<div class="content">
						
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Filtros')): ?>
						<?php endif; ?>
						
						
						<h2 class="wp-block-heading">Categorías</h2>
							<?php
							wp_nav_menu(array('theme_location' => 'menu-tienda-comercial', 'container_class' => 'wp-block-woocommerce-product-categories wc-block-product-categories is-list '));
							?>
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Barra lateral de navegación')): ?>
						<?php endif; ?>
					</div>
				</aside>
				<section class="contenido">
					
					<div class="ancho">
						<?php woocommerce_content(); ?>
					</div>
				</section>			
			</div>
		</main>
		<script>
			$(document).ready(function(){
				var titulo = $("h1").text();
				$(".wc-block-product-categories-list-item").each(function(){
					if($(this).children("a").text() == titulo){
						$(this).addClass('current-menu-item')
					}
				});

			})
		</script>

<?php get_footer(); ?>

