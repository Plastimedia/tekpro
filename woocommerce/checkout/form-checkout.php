<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form 
	name="checkout" 
	method="post" 
	class="checkout woocommerce-checkout" 
	action="<?php echo esc_url( wc_get_checkout_url() ); ?>" 
	enctype="multipart/form-data"
>
	<div class="col2-set" id="customer_details">
		<div class="col-1">
			<h1 style="text-align: left;"><?php the_title(); ?></h1>
			<div class="steps-checkout">
				<span class="active">1</span>
				<span id="idicator-2">2</span>
				<span id="idicator-3">3</span>
				<span id="idicator-4">4</span>
			</div>
			<div class="notices-erros"></div>
			<?php if ( $checkout->get_checkout_fields() ) : ?>
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<?php
					$fields = $checkout->get_checkout_fields( 'billing' );
					$custom_fields = [
						'step1' => array(),
						'step2' => array(),
						'step3' => array(),
					];
					foreach ( $fields as $key => $field ) {
						if(
							$key == 'billing_first_name' || 
							$key == 'billing_last_name' || 
							$key == 'billing_company' || 
							$key == 'cedula' ||
							$key == 'nit'
						){
							$custom_fields['step1'][$key] = $field;
						}
						if(
							$key == 'billing_address_1' ||
							$key == 'billing_address_2' ||
							$key == 'billing_city' ||
							$key == 'billing_postcode' ||
							$key == 'billing_country' ||
							$key == 'billing_state'
						) {
							$custom_fields['step2'][$key] = $field;
						}
						if($key == 'billing_email' || $key == 'billing_phone'){
							$custom_fields['step3'][$key] = $field;
						}
					}
				?>
				<div class="screens-steps">
					<div class="step-1" id="step-1">
						<h2>Mis datos personales</h2>
						<?php 
							foreach($custom_fields['step1'] as $key => $field){
								woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
							}
						?>
					</div>
					<div class="step-2" id="step-2">
						<h2>Dirección de facturación</h2>
						<?php 
							foreach($custom_fields['step2'] as $key => $field){
								woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
							}
						?>
						<input type="checkbox" id="ship-to-different-address-checkbox" name="ship_to_different_address" style="display: none">
						<details id="los_datos_de_envio_diferente">
							<summary>Deseas enviar el pedido a otra dirección?</summary>
							<h2>Dirección de envío</h2>
							<?php 
								$fields_Shipping = $checkout->get_checkout_fields( 'shipping' );
								foreach($fields_Shipping as $key => $field){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
							?>
						</details>
						
					</div>
					<div class="step-3" id="step-3">
						<h2>Datos de contacto</h2>
						<?php 
							foreach($custom_fields['step3'] as $key => $field){
								woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
							}
						?>
					</div>
					<div class="step-4" id="step-4">
						<h2>Muy bien</h2>
						<p>Tus datos personales se utilizarán para procesar tu pedido y mejorar tu experiencia en esta web, ahora puedes proceder al pago</p>
						<a href="#" id="pagar" class="btn-big">Ir a pagar</a>
					</div>
				</div>
				<div class="btns-screen">
					<a href="#" class="prev" id="prev_step">Atrás</a>
					<a href="#" class="next" step="1" id="next_step">Siguiente</a>
				</div>
				<?php // do_action( 'woocommerce_checkout_billing' ); ?>
				<?php //do_action( 'woocommerce_checkout_shipping' ); ?>
				<?php //do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			<?php endif; ?>
		</div>
		<div class="col-2">
			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
			<div class="resumen-compra">
				<h3>Resumen de compra</h3>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
			</div>
			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
	$(document).ready(function () {
		$("#billing_state").change()
		function navNext(current, next) {
			$('#step-'+current).fadeOut(250)
			setTimeout(() => {
				$('#step-'+next).fadeIn(450)
			}, 300)
		}

		function navPrev(current, prev) {
			$('#step-'+current).fadeOut(250)
			setTimeout(() => {
				$('#step-'+prev).fadeIn(450)
			}, 300)
		}


		// prev_step
		$('#next_step').click(function (e) {
			e.preventDefault();
			let step = $(this).attr('step')
			if(step == '1') {
				if($('input[name="billing_first_name"]').val() != '' && $('input[name="billing_last_name"]').val() != '' && $('input[name="cedula"]').val() != '') {
					$('.notices-erros').html('');
					$('#idicator-2').addClass('active')
					$('.steps-checkout').addClass('one')
					$('#prev_step').attr('step', step)
					$('#prev_step').attr('current', (Number(step)+1))
					$(this).attr('step', (Number(step)+1))
					navNext(step, (Number(step)+1));
				}else {
					$('.steps-checkout').removeClass('two')
					$('.notices-erros').html('<div class="woocommerce-error">Ingresa la información requerida (campos con *)</div>')
				}
			}
			if(step == '2') {
				if($('select[name="billing_country"]').val() != '' &&
				   $('input[name="billing_address_1"]').val() != '' &&
				   $('input[name="billing_city"]').val() != '' &&
				   $('select[name="billing_state"]').val() != ''
				) {
					$('.notices-erros').html('');
					$('#idicator-3').addClass('active')
					$('.steps-checkout').removeClass('one')
					$('.steps-checkout').addClass('two')
					$('#prev_step').attr('step', step)
					$('#prev_step').attr('current', (Number(step)+1))
					$(this).attr('step', (Number(step)+1))
					navNext(step, (Number(step)+1));
				}else {
					$('.steps-checkout').removeClass('three')
					$('.notices-erros').html('<div class="woocommerce-error">Ingresa la información requerida (campos con *)</div>')
				}
			}
			if(step == '3') {
				if($('input[name="billing_phone"]').val() != '' &&
				   $('input[name="billing_email"]').val() != ''
				) {
					$('.notices-erros').html('');
					$('#idicator-4').addClass('active')
					$('.steps-checkout').removeClass('two')
					$('.steps-checkout').addClass('three')
					$('#prev_step').attr('step', step)
					$('#prev_step').attr('current', (Number(step)+1))
					$(this).attr('step', (Number(step)+1))
					navNext(step, (Number(step)+1));
				}else {
					$('.notices-erros').html('<div class="woocommerce-error">Ingresa la información requerida (campos con *)</div>')
				}
			}
		})

		$('#prev_step').click(function (e) {
			e.preventDefault();
			console.log
			let step = $(this).attr('step')
			if(step != null && step != '' && step != undefined) {
				if(Number(step) > 0) {
					$('.notices-erros').html('');
					let current = $(this).attr('current')
					navPrev(current, step)
					$('#next_step').attr('step', step)
					$(this).attr('current', step)
					$(this).attr('step', (Number(step) - 1))
				}
			}
		})

		$('#pagar').click(function (e) {
			e.preventDefault();
			$('form.woocommerce-checkout').submit();
		})

		$("#los_datos_de_envio_diferente").on('toggle',function(){
			if ($(this).attr('open')) {
				$("#ship-to-different-address-checkbox").prop("checked",true)
			} else {
				$("#ship-to-different-address-checkbox").prop("checked",false)				
			}
		})
	})
</script>
