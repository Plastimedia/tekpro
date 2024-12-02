<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- Definir viewport para dispositivos web móviles -->
	<meta name="viewport" content="width=device-width, minimum-scale=1">
	


	<!-- estilos globales del tema -->
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" id="epa"/>

	<!-- estilos globales del tema -->
	<script src="https://plastibucket.s3.us-east-2.amazonaws.com/btn-wpp/btn-wpp.min.js"></script>
	

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


	<?php get_template_part('template-parts/content','partials-header'); ?>

	<!-- mundos -->
	
	
	<!-- mundos -->

	<div class="wrapper">
		<!-- ir arriba -->
		<span id="ir-arriba"></span>

		<?php get_template_part('template-parts/content','header'); ?>