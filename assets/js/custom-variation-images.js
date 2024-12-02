jQuery( document ).ready( function( $ ) {
    // Detectar cuando se selecciona una variación
    $( '.variations_form' ).on( 'woocommerce_variation_has_changed', function() {
        var $form = $( this );
        var variation = $form.find( '.single_variation_wrap' ).find( '.variation_id' ).val();
        
        // Verificar si la variación seleccionada tiene una imagen asociada
        if ( variation ) {
            var $imageContainer = $( '.woocommerce-product-gallery__image' );
            var $gallery = $imageContainer.closest( '.woocommerce-product-gallery' );

            // Obtener la URL de la nueva imagen de la variación seleccionada
            var newImageSrc = $form.find( '.variations' ).find( 'option:selected' ).data( 'thumb' );
            
            // Cambiar la imagen en la galería del producto
            if ( newImageSrc ) {
                $imageContainer.find( 'img' ).attr( 'src', newImageSrc );
            }
        }
    });
});
