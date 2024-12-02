 $(document).ready(function() {

 	// function calculateTotal(cant) {
	// 	if($('.woocommerce-variation-add-to-cart').length > 0) {
	// 		let val = $('#plasti_price').val()
	// 		let total = val * cant
	// 		total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
	// 		console.log(total)
	// 		$('.single_variation_wrap .woocommerce-variation.single_variation .woocommerce-variation-price .price .woocommerce-Price-amount.amount').html(`
	// 			<bdi>
	// 				<span class="woocommerce-Price-currencySymbol">$</span>&nbsp;${total}
	// 			</bdi>
	// 		`)
	// 		console.log('Saque el precio de la ultima variacion')
	// 	}else {
	// 		let val = $('#plasti_price').val()
	// 		let total = val * cant
	// 		total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
	// 		$('#plasti_price').siblings('span').html(`
	// 			<bdi>
	// 				<span class="woocommerce-Price-currencySymbol">$</span>&nbsp;${total}
	// 			</bdi>
	// 		`)
	// 	}
 	// }

 	// if($('.qty[name="quantity"]').length > 0) {
 	// 	$('.qty[name="quantity"]').change(function () {
 	// 		let cant = $(this).val()
 	// 		calculateTotal(cant)
 	// 	})
 	// }

	// splash		
	$("#splash").css("opacity","0");
	window.setTimeout(function(){
		$("#splash").css("display","none");
	},500);	
	// splash
	/* Ir arriba */
	$('#ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
	$("#pa_talla option:first").text("")
	new WOW().init();
	$(".share-print a").click(function(e){
		e.preventDefault();
		window.print();
	})

	// menu
	if ($(window).width() < 768) {
		var itemMenu = $(".container-menu .container-menu-buscador nav.el-menu .menu-ppl ul > li.menu-item-has-children > a");
		itemMenu.click(function(event) {
			event.preventDefault();
		});
	}
	
	window.setTimeout(function(){
		var redes_blog = $(".single-post .sharedaddy").html();
		$(".single-post .redes_sociales").html(redes_blog);
		$(".single-post .redes_sociales").addClass('sharedaddy');
		$(".single-post .redes_sociales").addClass('sd-sharing-enabled');
	}, 100)

	$(".term-otros-productos .products").html("<h3 style='text-align: center;'>Esta sección está en construcción<br>Pronto tendremos más productos para ti.</h3>");

	
	// menú de opciones tienda
	$(".single-product .product_cat span").each(function(){
		let text = $(this).text()
		$("main.shopPage aside .wc-block-product-categories.is-list ul li a").each(function(){
			if(text == $(this).text()){
				$(this).parent().addClass('current-menu-item')
			}
		})
	})
	// vista de items
		$('.opcion_bloques').click(function(){
			$('.opcion_cajas').removeClass('active');
			$(this).addClass('active');

			$(this).parent().parent().children('.products').children('.product').children('.producto').addClass('expansivo');
			$(this).parent().parent().children('.products').children('.product').addClass('expansivos');
			sessionStorage.setItem('optionsList', 'bloques');
		});
		$('.opcion_cajas').click(function(){
			$(this).addClass('active');
			$('.opcion_bloques').removeClass('active')
			
			$(this).parent().parent().children('.products').children('.product').children('.producto').removeClass('expansivo');
			$(this).parent().parent().children('.products').children('.product').removeClass('expansivos');
			sessionStorage.setItem('optionsList', 'cajas');

			// 
			$('.producto>.content').height('auto');
			let altomax = 0;
			$('.producto>.content').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});
			console.log(`emm : ${altomax}`)
			$('.producto>.content').height(altomax);
		});


		if($(window).width() > 1024){
			$('.opciones_de_vista_productos').css('display','flex');
			let opcioneslista = sessionStorage.getItem('optionsList')
			if(opcioneslista == 'bloques'){
				$('.opcion_cajas').removeClass('active');
				$('.opcion_bloques').addClass('active');

				$('.opcion_bloques').parent().parent().children('.products').children('.product').children('.producto').addClass('expansivo');
				$('.opcion_bloques').parent().parent().children('.products').children('.product').addClass('expansivos');
				sessionStorage.setItem('optionsList', 'bloques');
			}
		}else{
			$('.opciones_de_vista_productos').css('display','none');
			$('.opcion_cajas').addClass('active');
			$('.opcion_bloques').removeClass('active')
			
			$('.opcion_bloques').parent().parent().children('.products').children('.product').children('.producto').removeClass('expansivo')
			$('.opcion_bloques').parent().parent().children('.products').children('.product').removeClass('expansivos');

		}
		$(window).resize(function(){
			if($(window).width() > 1024){
				$('.opciones_de_vista_productos').css('display','flex');
				let opcioneslista = sessionStorage.getItem('optionsList')
				if(opcioneslista == 'bloques'){
					$('.opcion_cajas').removeClass('active');
					$('.opcion_bloques').addClass('active');

					$('.opcion_bloques').parent().parent().children('.products').children('.product').children('.producto').addClass('expansivo');
					$('.opcion_bloques').parent().parent().children('.products').children('.product').addClass('expansivos');
					sessionStorage.setItem('optionsList', 'bloques');
				}
			}else{
				$('.opciones_de_vista_productos').css('display','none');
				$('.opcion_cajas').addClass('active');
				$('.opcion_bloques').removeClass('active')
				
				$('.opcion_bloques').parent().parent().children('.products').children('.product').children('.producto').removeClass('expansivo')
				$('.opcion_bloques').parent().parent().children('.products').children('.product').removeClass('expansivos');

			}
		});
		
	// vista de items

	// para que la caja no se pierda en la pantalla
	if ($(window).width() > 768) {
		$("header .ancho .options_shop>div.search").hover(
			function(){
				var widthScreen = $("body").width();
				var leftScreenContent = $(this).children('.content').offset().left;
				if( (leftScreenContent + 250)  > widthScreen ){
					// console.log("mayor")
					$(this).children('.content').css("transform","translateX(calc(-50% - " + ( ((leftScreenContent + 250)  - widthScreen) + 25  ) + "px))")
				}
				// console.log("pantalla: " + widthScreen+"\n elemento: " + leftScreenContent + "\n elemento pantalla: "+(leftScreenContent + 250))
				
			},
			function(){
				$(this).children('.content').css("transform","translateX(-50%)")
			}
		);
		$("header .ancho .options_shop>div.cart").hover(
			function(){
				// var widthScreen = screen.width;
				if($(this).children('.content').length > 0) {
				    var widthScreen = $("body").width();
    				var leftScreenContent = $(this).children('.content').offset().left;
    				console.log(widthScreen + "--" + leftScreenContent)
    				if( (leftScreenContent + 300)  > widthScreen ){
    					// console.log("mayor")
    					$(this).children('.content').css("transform","translateX(calc(-50% - " + ( ((leftScreenContent + 300)  - widthScreen) + 25  ) + "px))")
    				}
    				// console.log("pantalla: " + widthScreen+"\n elemento: " + leftScreenContent + "\n elemento pantalla: "+(leftScreenContent + 250))
    				console.log("pantalla: " + widthScreen+"\n elemento: " + leftScreenContent + "\n elemento pantalla: "+(leftScreenContent + 300) + "\n diferencia" + (((leftScreenContent + 300)  - widthScreen)))   
				}
			},
			function(){
			    if($(this).children('.content').length > 0) {
			        $(this).children('.content').css("transform","translateX(-50%)")   
			    }
			}
		);
	}
	if($(window).width() < 1024){
		let segunda = $("main .sedes .content li:nth-child(2)").html();
		let tercera = $("main .sedes .content li:nth-child(3)").html();
		$("main .sedes .content li:nth-child(2)").html(tercera);
		$("main .sedes .content li:nth-child(3)").html(segunda);
	}

	// no liinks
	$("header .ancho .options_shop>div.cart .icon a").click(function(e){
		e.preventDefault();
	})
	$("header .ancho .options_shop>div.search .icon a").click(function(e){
		e.preventDefault();
	})
	// menú de opciones tienda

	// megamenu categorias
		

		

	// megamenu categorias


	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('#ir-arriba').fadeIn(300);
		} else {
			$('#ir-arriba').fadeOut(300);
		}
	});


	// cuando sea móvil no coloque la clase fijo
		if ($(window).width() > 1024) {
			$(".header").sticky({ topSpacing: 0, className: 'fijo', zIndex: 100 });
		}


	// JS del menu
	jQuery("#menu_chk").change(function () {   //Funcion para mostrar u ocultar el menu de la versión de moviles
		if(jQuery("#menu_chk").is(':checked')){
			jQuery( ".menu-ppl" ).addClass( "verMenu" );  // checked
			jQuery( "#btn_menu" ).addClass( "btn_activo" );  // checked
		}
		else {
			jQuery( ".menu-ppl" ).removeClass( "verMenu" );  // unchecked
			jQuery( "#btn_menu" ).removeClass( "btn_activo" );  // unchecked
		}
	})



     // Funcion para permitir la animación completa
 	$('.menu-ppl > ul > li').hover(function() {
  		$(this).addClass('in-hover').delay(210).queue(function() {
  			$(this).removeClass('in-hover').clearQueue();
  		});
  	});

  	// Funcion para permitir la animación completa
 	$('li.menu-categorias > ul.sub-menu > li').hover(function() {
  		$(this).addClass('in-hover').delay(210).queue(function() {
  			$(this).removeClass('in-hover').clearQueue();
  		});
  	});

	// quitarle el autocomplete al formulario de contacto
	$('.hugeit_form').attr('autocomplete','off');
	$('#hugeit_preview_textbox_17').val('');

	/* Parallax scrolling */
	$(window).bind('scroll',function(e){
		parallaxScroll();
	});
	/* Scroll the background */
	function parallaxScroll(){
		if ($(window).width() > 768) {
			var scrolled = $(window).scrollTop();
			var ventana = $(window).height();
// 			if ($('.img-sec').offset()) {
// 				var div = $('.img-sec').offset();
// 				div = div.top;
// 			}
// 			$('.img-sec img').css('top',( (scrolled + ventana - div) * 0.2 )+'px');

			
			

		}
	}

	/* jQuery propio para tener la misma altura en diferentes div */
	function altura() {

		if ( $( window ).width() > 600 ) {
			var altomax = 0;
			$('.category-post-area').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});

			$('.category-post-area').height(altomax);
			var altomax = 0;
			$('.producto>.content').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});

			$('.producto>.content').height(altomax);
			var altomax = 0;
			$('main .sedes .content li .contenido').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});

			$('main .sedes .content li .contenido').height(altomax);
			
			var altomax = 0;
			$('.los-servicios .ancho .donLoop .splideServicios .splide__list .splide__slide .servicePost').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});

			$('.los-servicios .ancho .donLoop .splideServicios .splide__list .splide__slide .servicePost').height(altomax);
			
			var altomax = 0;

			$('.post-area').each(function(){
				if($(this).height() > altomax){
					altomax = $(this).height();
				}
			});

			$('.post-area').height(altomax);

			var alt = 0;

			$('.servicios .wg-servicio').each(function(){
				if($(this).height() > alt){
					alt = $(this).height();
				}
				$('.servicios .wg-servicio').height(alt);
			});


		}
	}

	altura();
	
	$( window ).resize(function() {
		altura();
	});


	// woocommerce
	// añadir los controles

	// $("main.shopPage section.contenido .productPage .summary .cart .groupquantity span.before").click(function(){
	// 	var number = $("main.shopPage section.contenido .productPage .summary .cart .quantity input").val();
	// 	if(number > 1){
	// 		$("main.shopPage section.contenido .productPage .summary .cart .quantity input").val(--number);
	// 		calculateTotal(number)
	// 	}
	// });
	// $("main.shopPage section.contenido .productPage .summary .cart .groupquantity span.after").click(function(){
	// 	var number = $("main.shopPage section.contenido .productPage .summary .cart .quantity input").val();
	// 	if(number < 9999){
	// 		$("main.shopPage section.contenido .productPage .summary .cart .quantity input").val(++number);
	// 		calculateTotal(number)
	// 	}
	// });
	// woocommerce

	// slider

	function sliderm(x) {
		if (x.matches) { //si ya esta en el mediaquery
			$(".contenedor-slide").css("display","none");
			$(".contenedor-slide-mobil").css("display","block");
		} else {
			$(".contenedor-slide").css("display","block");
			$(".contenedor-slide-mobil").css("display","none");
		}
	}

	var x = window.matchMedia("(max-width: 728px)")
	sliderm(x) // Call listener function at run time
	x.addListener(sliderm) // Attach listener function on state changes

	
	$(".woocommerce-checkout .tax-rate-co-iva-1 th").text("iva de los productos");
	
	
	$("#billing_city_field label").append(`  <abbr class="required" title="obligatorio">*</abbr>`);
	
	
	// solución de error de coordinadora, al llenar los datos de billing se llenan los de shoping
	$("#billing_address_1").change(function(){
		$("#shipping_address_1").val($(this).val())
	})
	$(document).on('change', '#billing_state', function() {
		var nuevoValor = $(this).val();
		$("#shipping_city").val(nuevoValor);
	});
	$(document).on('change', '#billing_city', function() {
		var nuevoValor = $(this).val();
		$("#shipping_city").val(nuevoValor);
	});
	
	//función botones incrementar y decrementar 
    	(function( $ ) {
    
        $('.button-qty').click(function(e){
            e.preventDefault();
            const inputQty = $(this).parent().find('input')[0];
    
            if ( $(this).data('quantity') === 'plus' ) {
                inputQty.stepUp();
            } else {
                inputQty.stepDown();
            }
    
            $(inputQty).trigger('change');
    
        });
    
    })( jQuery );
});
