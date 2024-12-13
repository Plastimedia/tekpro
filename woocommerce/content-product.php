<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if (empty($product) || ! $product->is_visible()) {
	return;
}


?>
<li <?php wc_product_class('', $product); ?>>
	<div class="producto ">

		<div class="content">

			<?php
			$percent = null;

			if ($product->get_price() != null && $product->get_sale_price() != null) {
				$regular = (float) $product->get_regular_price();
				$discount = (float) $product->get_sale_price();
				$percent = $discount * 100 / $regular;
				$percent = '-' . round(100 - $percent) . '%';
			} else {
				if ($product->is_on_sale()) {
					$percent = 'Oferta';
				}
			}

			?>
			<?php if ($percent != null): ?>
				<span class="discount-tag"><?php echo $percent; ?></span>
			<?php endif; ?>


			<a class="thumbnail" href="<?php echo get_the_permalink();  ?>">
				<?php
				$product_image_id = $product->get_image_id();
				$product_image_url = wp_get_attachment_url($product_image_id);
				echo '<img src="' . esc_url($product_image_url) . '" alt="Imagen del Producto">';
				?>
			</a>
		</div>

		<h3><a href="<?php echo the_permalink();  ?>"><?php echo $product->get_name() ?></a></h3>

		<div class="precios">
			<?php
			$current_user = wp_get_current_user();
			$user_role = (array) $current_user->roles;
// 			$user_role = $user_role[0];
// echo "<script>console.log('metas',".json_encode($product->get_meta_data()).")</script>";
			

			// Si no hay un usuario logueado, mostramos el precio normal
			if (empty($user_role)) {
				// Mostrar el precio regular
				echo "<p>$" . number_format($product->price, 0, ',', '.') . "</p>";
			} else {
				$user_role = $user_role[0]; // Asumimos que el usuario tiene un rol
			}
// 			echo $user_role; 


			$role_based_pricing = null;

			// Recorremos los meta_data para encontrar el precio basado en el rol de usuario
			if (!empty($user_role)) {
			    $pm = $product->get_meta_data();
			foreach ($pm as $meta) {
			 //   echo "<script>console.log($meta)</script>";
				if ($meta->key === '_role_based_pricing_rules') {
					if (isset($meta->value[$user_role])) {
						$role_based_pricing = $meta->value[$user_role];
					}
				}
			}
// 			echo "role_based_pricing";
// echo "<script>console.log('metas',".json_encode($role_based_pricing).")</script>";
// 			echo $role_based_pricing;

			// Si no encontramos un precio específico para el rol de usuario, mostramos el precio normal
			if ($role_based_pricing === null) {
				echo "<p>$" . number_format($product->price, 0, ',', '.') . "</p>";
			} else {
				// Mostrar precios según el rol de usuario
				$regular_price = $role_based_pricing['regular_price'];
				$sale_price = $role_based_pricing['sale_price'];

				if ($sale_price !== null && $sale_price != $regular_price) {
					echo "<p><del style='text-decoration:line-through;'>$" . number_format($regular_price, 0, ',', '.') . "</del></p>";
					echo "<p><strong>$" . number_format($sale_price, 0, ',', '.') . "</strong></p>";
				} else {
					echo "<p>$" . number_format($regular_price, 0, ',', '.') . "</p>";
				}
			}
			}
			




			// $product_price = $product->price;
			// $sale_price = $product->get_sale_price();

			// if ($product_price != '' and $product_price != null) {
			// 	if (! $product->has_child()) {
			// 		if ($sale_price != $product_price && $sale_price != '') {
			// 			echo "<p><del style='text-decoration:line-through;'>$" . number_format($product_price, 0, ',', '.') . "</del></p>";
			// 			echo "<p><strong>$" . number_format($sale_price, 0, ',', '.') . "</strong></p>";
			// 		} else {
			// 			echo "<p>$" . number_format($product_price, 0, ',', '.') . "</p>";
			// 		}
			// 	} else {
			// 		echo "<p> $" . number_format($product_price, 0, ',', '.') . "</p>";
			// 	}
			// }

			?>
		</div>

		<div class="botones botones2">
			<?php // do_action('PC__wishlist_bucle'); 
			?>
                    <?php
						 // URL para agregar el producto al carrito y redirigir a la página de pago
						$quick_buy_url = wc_get_checkout_url() . '?add-to-cart=' . $product->get_id();

						// Botón de "Compra rápida"
						//echo '<a href="?add-to-cart=' . $product->get_id() .  '" class="button quick-buy-button">Añadir al carrito</a>';
					?>
					<!-- <a class="read" href="<?php echo get_the_permalink();  ?>">Ver producto</a> -->
		</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	// do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
<?php


?>