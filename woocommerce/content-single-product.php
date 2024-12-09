<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}


?>
<div id=" product-<?php the_ID(); ?>" <?php wc_product_class('productPage', $product); ?>>
	<div class="cont-ancho">

	</div>
	<div class="lasimagenes">
		<?php

		$galeria = $product->get_gallery_image_ids();
		$variations = [];
		if ($product->is_type('variable')) {
			$variations = $product->get_available_variations();
		}
		// echo wp_get_attachment_url($galeria[0]);
		if (count($galeria) > 0) {
			// si hay galería
		?>

			<div id="ppl-slider" class="splide" style="position: relative">
				<div class="splide__track">
					<ul class="splide__list">
						<li class="splide__slide">
							<img id="normal" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" data-zoom-image="<?php echo wp_get_attachment_url($product->get_image_id()); ?>">
						</li>
						<?php
						foreach ($galeria as $imagen) {
						?>
							<li class="splide__slide">
								<img id="normal" src="<?php echo wp_get_attachment_url($imagen); ?>" data-zoom-image="<?php echo wp_get_attachment_url($imagen); ?>">

							</li>
						<?php
						}
						?>
						<?php foreach ($variations as $variation) {
							$image_id = $variation['image_id'];
							if ($image_id) { ?>
								<li class="splide__slide">
									<img src="<?php echo wp_get_attachment_url($image_id); ?>" data-zoom-image="<?php echo wp_get_attachment_url($image_id); ?>">
								</li>
						<?php }
						} ?>

					</ul>
				</div>
			</div>
			<div id="thumbnail-slider" class="splide">
				<div class="splide__track">
					<ul class="splide__list">
						<li class="splide__slide">
							<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>">
						</li>
						<?php
						foreach ($galeria as $imagen) {
						?>
							<li class="splide__slide">
								<img src="<?php echo wp_get_attachment_url($imagen); ?>">
							</li>
						<?php
						}
						?>
						<?php foreach ($variations as $variation) {
							$image_id = $variation['image_id'];
							if ($image_id) { ?>
								<li class="splide__slide">
									<img src="<?php echo wp_get_attachment_url($image_id); ?>">
								</li>
						<?php }
						} ?>

					</ul>
				</div>
			</div>
			<script src="<?php echo get_template_directory_uri() . "/assets/js/jquery.elevatezoom.js" ?>"></script>
			<script>
				$(document).ready(function() {
					window.main = new Splide('#ppl-slider', {
						type: 'fade',
						rewind: false,
						pagination: false,
						arrows: false,
					});
				// 	if (window.innerWidth >= 758) {
						window.thumbnail = new Splide('#thumbnail-slider', {
							// direction: 'ttb',
							fixedWidth: 100,
							height: 100,
							fixedHeight: 100,
							gap: 10,
							rewind: false,
							pagination: false,
							isNavigation: true,
							arrows: true,
							perPage: 3,
							perMove: 1,
							type: 'loop',
							breakpoints: {
								1024: {
									grid: 10,
									fixedWidth: 50,
									height: 50,
									fixedHeight: 50,
								}
							},
						});

						main.sync(thumbnail).mount();
						thumbnail.mount();
						// https://www.elevateweb.co.uk/image-zoom/examples/#zoom-constrain
						$('#normal').elevateZoom({
							zoomType: "inner",
							cursor: "crosshair",
							scrollZoom: true,
						})


						main.on('moved', function() {
							let data_zoom_image = $("#ppl-slider ul li.is-active img").attr("src");
							$("#ppl-slider ul li img").attr("data-zoom-image", data_zoom_image);
							$(".zoomWindow").css('background-image', 'url(' + data_zoom_image + ')')
						})
				// 	} else {
				// 		main.mount();
				// 	}

				})
			</script>
		<?php
			// si hay galería
		} else {
			// si no tiene galería
		?>
			<figure>
				<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" data-zoom-image="<?php echo wp_get_attachment_url($product->get_image_id()); ?>">
			</figure>
			<script src="<?php echo get_template_directory_uri() . "/assets/js/jquery.elevatezoom.js" ?>"></script>
			<script>
				$(document).ready(function() {
					$('main.shopPage section.contenido .productPage .lasimagenes figure img').elevateZoom({
						zoomType: "inner",
						cursor: "crosshair",
						scrollZoom: true,
					})
				})
			</script>
		<?php
			// si no tiene galería


		}

		?>

	</div>

	<div class="summary entry-summary">
		<!-- <h1><?php echo $product->get_name() ?></h1> -->
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 200
		 * @hooked woocommerce_template_single_excerpt - 10
		 * @hooked woocommerce_template_single_price - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		// Eliminar la acción existente

		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
		add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 22);
		do_action('woocommerce_single_product_summary');

		?>



	</div>
	<div class="contenidogeneral">


		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action('woocommerce_after_single_product_summary');
		?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('form.variations_form').on('found_variation', function(event, variation) {
			console.log("variacion")
			if (variation && variation.image && variation.image.src) {
				console.log("todo", variation)
				console.log("tiene todo", variation.image.src)
				var imageUrl = variation.image.full_src;

				// Buscar la imagen en el slider de miniaturas
				$('#ppl-slider img').each(function(index, element) {
					console.log("buscando")
					console.log($(element).attr('src'))
					if ($(element).attr('src') == imageUrl) {
						// Navegar hacia la imagen encontrada
						console.log("dentro")
						console.log("index", index)
				// 		index += 2
						main.go(index);
                        
                        return false;

					}
				});
			}
		});
	});
</script>