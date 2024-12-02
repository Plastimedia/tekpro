<?php
// --------- ARRAY DE CONFIGURACION ---------
    $config = [
        // --> configuraciones
        'animaciones' => true, //animate.css y wow.js
        'carousel' => true, //splide.js 
        // añadir la de los parallax
        //--> boton de whatsapp
        'boton-whatsapp' => true,
        //--> widgets
        'widgets' => [
            [
                'name' => 'Slider Escritorio',
                'beforeWidget' => '<div class="contenedor-slide">',
                'afterWidget' => '</div>'
            ],
            [
                'name' => 'Slider Celular',
                'beforeWidget' => '<div class="contenedor-slide-mobil">',
                'afterWidget' => '</div>'
            ],
            [
                'name' => 'Tekpro titulo',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Tekpro info',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Buscador',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Mercado titulo',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Productos Destacados',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Productos Nuevos',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'blog',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Marcas',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Footer',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Firma footer',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Barra lateral de navegación',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Carrito',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
            [
                'name' => 'Categorias mercados',
                'beforeWidget' => '',
                'afterWidget' => ''
            ],
        ],
        'menus' => [
            [
                'slug' => 'main-menu',
                'name' => 'Menú principal'
            ],
            [
                'slug' => 'menu-redes',
                'name' => 'Redes'
            ],
            [
                'slug' => 'informacion-sitio',
                'name' => 'Información sitio'
            ],
            [
                'slug' => 'corporativo',
                'name' => 'Corporativo'
            ],
            [
                'slug' => 'contactanos',
                'name' => 'Contáctanos'
            ],
            [
                'slug' => 'categories-corporativo',
                'name' => 'Categorías Corporativo'
            ],
            [
                'slug' => 'mundos-corporativo',
                'name' => 'Mundos Corporativo'
            ],
            [
                'slug' => 'main-menu-corporativo',
                'name' => 'Menú Principal Corporativo'
            ],
            [
                'slug' => 'menu-tienda-coorporativo',
                'name' => 'Menú Tienda Corporativo'
            ],
            [
                'slug' => 'menu-tienda-comercial',
                'name' => 'Menú Tienda Comercial'
            ],
        ],

        // custon type servicios
        'custom-type-servicio' => true,    
        // edicion de post
        'editor-clasico' => false,
        'multiples-imagenes-destacadas' => true,
        'mensaje-cuando-no-hay-entradas' => 'No hay entradas disponibles',
        // paginacion
        'paginacion-entradas-en-el-home' => true,
        'paginacion-entradas-en-categoria' => true,
        // responsive php
        'break-point-responsive' => 768,
        'mensaje-404' => 'La página a la que has intentado acceder no existe en nuestro sitio web.',
    ];

    define('CONFPLAS', $config);
    define('BASE_URL', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);


##############################################

//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                    |
//                \   |   /
//                 \  |  /
//                  \ | /
//                   \|/
//                    ▼


// MENUS DE WORDPRESS
// ---------------------


// Theme supports
    function plastiCommerce_theme_support(){
        add_theme_support( 'nav-menus' );
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                )
            );
        add_theme_support( 'responsive-embeds' );
        add_theme_support('title-tag');
        add_theme_support('custom-logo',
            array(
                "width" => 347,
                "height" => 99,
                "flex-width" => true,
                "flex-height" => true,
            )
        );
        add_theme_support('woocommerce');
    }
    add_action("after_setup_theme","plastiCommerce_theme_support");
    
// Theme supports


// MENÚS
// -----------------------
    function plastiCommerce_register_my_menus() {
        if ( function_exists( 'register_nav_menus' ) ) {
            $menus = CONFPLAS['menus'];
            foreach ($menus as $menu) {
                register_nav_menus([$menu['slug'] => __($menu['name'])]);       
            }
        
        }
    }
    add_action( 'init', 'plastiCommerce_register_my_menus' );
// -----------------------


// WIDGETS
// ------------------------
    if ( function_exists('register_sidebar') ) {
        $widgets = CONFPLAS['widgets'];
        $count_widgets = 0;
        foreach ($widgets as $widget) {
            register_sidebar( array(
                'id' => "idwidget_$count_widgets" ,
                'name'=>$widget['name'],
                'before_widget' => $widget['beforeWidget'], 
                'after_widget' => $widget['afterWidget'],
            ));
            $count_widgets++;
        }
    }
// ---------------------

// IMAGENES DESTACADAS
// -----------------------
    if (CONFPLAS['custom-type-servicio'] || CONFPLAS['multiples-imagenes-destacadas']) {
        require 'include/multi-post-thumbnails.php';
        if (CONFPLAS['multiples-imagenes-destacadas']) {
            // si hay multiples imagenes destacadas
            if (class_exists('MultiPostThumbnails')) {
            new MultiPostThumbnails(array('label' => 'Imagen destacada en categoria','id' => 'two-image','post_type' => 'post'));
            new MultiPostThumbnails(array('label' => 'Imagen destacada en vista completa','id' => 'three-image','post_type' => 'post'));
            }   
        }
    }

    function ImagenDestacadaPlas($view = 'home', $postType = 'entrada')
    {
        if ($postType == 'entrada') {
            switch ($view) {
                case 'home':
                    the_post_thumbnail();
                break;
                case 'category':
                    if (class_exists('MultiPostThumbnails')) {
                        MultiPostThumbnails::the_post_thumbnail(get_post_type(),'two-image');
                    }else {the_post_thumbnail();}
                break;
                case 'single':
                    if (class_exists('MultiPostThumbnails')) {
                        MultiPostThumbnails::the_post_thumbnail(get_post_type(),'three-image');
                    }else {the_post_thumbnail('large');}
                break;
                default:
                    the_post_thumbnail('large');
                break;
            }       
        }

        if ($postType == 'servicios') {
            switch ($view) {
                case 'home':
                    if (class_exists('MultiPostThumbnails')) {
                        MultiPostThumbnails::the_post_thumbnail('servicios','icon-serv');
                    }else {the_post_thumbnail( 'full' );}
                break;
                case 'category':
                    if (class_exists('MultiPostThumbnails')) {
                        MultiPostThumbnails::the_post_thumbnail('servicios','two-image-serv');
                    }else {the_post_thumbnail('full');}
                break;
                case 'single':
                    the_post_thumbnail('large');
                break;
                default:
                    the_post_thumbnail('large');
                break;
            }  
        }
    }
// ------------------------



// CUSTOM POST TYPE DE SERVICIO
// --------------------------------
    if(CONFPLAS['custom-type-servicio']) {
        function plastiCommerce_crear_custom_type_servicio() {
            $labels = array(
                'name'               => _x( 'Servicios', 'post type general name', 'text-domain' ),
                'singular_name'      => _x( 'Servicio', 'post type singular name', 'text-domain' ),
                'menu_name'          => _x( 'Servicios', 'admin menu', 'text-domain' ),
                'add_new'            => _x( 'Añadir nuevo', 'servicio', 'text-domain' ),
                'add_new_item'       => __( 'Añadir nuevo servicio', 'text-domain' ),
                'new_item'           => __( 'Nuevo servicio', 'text-domain' ),
                'edit_item'          => __( 'Editar servicio', 'text-domain' ),
                'view_item'          => __( 'Ver servicio', 'text-domain' ),
                'all_items'          => __( 'Todos los servicios', 'text-domain' ),
                'search_items'       => __( 'Buscar servicios', 'text-domain' ),
                'not_found'          => __( 'No hay servicios.', 'text-domain' ),
                'not_found_in_trash' => __( 'No hay servicios en la papelera.', 'text-domain' ),
            );
            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Descripción.', 'text-domain' ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'servicios' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => true,
                'menu_position'      => 4,
                'public'             => true,
                'menu_icon'          => 'dashicons-hammer',
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category'),
            );
            register_post_type( 'servicios', $args );
        }
        if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(array('label' => 'Icono del servicio','id' => 'icon-serv','post_type' => 'servicios'));
        new MultiPostThumbnails(array('label' => 'Imagen destacada en categoria','id' => 'two-image-serv','post_type' => 'servicios'));
        }
        add_action( 'init', 'plastiCommerce_crear_custom_type_servicio' );

        function ServiciosPlas($numero = 4)
        {
                $args = array(
                'post_type' => 'servicios',
                'post_status' => 'publish',
                'showposts'     => $numero
                );

                query_posts( $args );

                // html de la entrada de servicio
                ?>

    <?php if (have_posts()) : ?>
        
        <section class="servicios">
            
            <?php while (have_posts()) : the_post(); ?>
            <!-- loop -->
            <div class="wg-servicio">
                <?php if ( has_post_thumbnail() ): ?>
                    <div class="imagen-servicio"> 
                        <?php ImagenDestacadaPlas('home', 'servicios')?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="text-servicio">
                                    <h3><?php the_title(); ?></h3>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!-- fin loop -->
                            <?php endwhile; ?>
                            
                            <?php wp_reset_postdata(); ?>
                            
                            
                            
                        </section>
                        
                        <?php else: ?>
                            
                            <p class="nothing"><?php echo CONFPLAS['mensaje-cuando-no-hay-servicios']; ?></p>
                            
                            <?php endif; 
        }
    }
// --------------------------------

// FUNCIONES WORDPRESS
// --------------------------------
    // editor clásico
    if (CONFPLAS['editor-clasico']) {
        add_filter('use_block_editor_for_post', '__return_false', 10);
    }
    // editor clásico

    // paginacion
    function PginacionPlas()
    {
        global $wp_query;
        if ($wp_query->max_num_pages > 1) {
            echo '<div class="paginacion">';
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
                ) );
                echo "</div>";
            }
            ?>
        <div class="navigation">
            <div class="alignleft"><?php next_posts_link('Previous entries') ?></div>
            <div class="alignright"><?php previous_posts_link('Next entries') ?></div>
        </div>
        <?php 
    }
    // paginacion

    add_filter( 'show_admin_bar', '__return_false' );
    function galussothemes_remove_admin_bar(){
        remove_action('wp_head', '_admin_bar_bump_cb');
    }

    // enqueue 
    function plastiCommerce_assets(){
        // styles
            // wp_register_style("nombre","fuente","dependencias (si necesito uno antes)","version","resolucion o lados")
            wp_register_style("bootstrap","https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css");
            wp_register_style("animate",get_template_directory_uri()."/assets/css/animate.css");
            wp_register_style("splide",get_template_directory_uri()."/assets/css/splide.css");

            wp_enqueue_style("estilos",get_template_directory_uri()."/assets/css/estilos.css",array('animate','splide','bootstrap'));
        // styles
        // scripts
            // wp_register_script("nombre","url","dependencias","verion");
            wp_register_script("wow",get_template_directory_uri()."/assets/js/wow.min.js");
            wp_register_script("splide",get_template_directory_uri()."/assets/js/splide.js");
            // wp_register_script("multiSplide","https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-grid@0.2.0/dist/js/splide-extension-grid.min.js");
            wp_register_script("multiSplide", get_template_directory_uri()."/assets/js/splide-extension-grid.js");
            wp_deregister_script('jquery');
            wp_register_script("jquery",get_template_directory_uri()."/assets/js/jquery-3.6.0.min.js");
            wp_register_script("sticky",get_template_directory_uri()."/assets/js/jquery.sticky.js");
            wp_register_script("respond",get_template_directory_uri()."/assets/js/respond.js");
            wp_register_script("basicScroll","https://cdn.jsdelivr.net/npm/basicscroll@3.0.2/dist/basicScroll.min.js");
            wp_register_script("contactos",get_template_directory_uri()."/assets/js/contacto.js");
            wp_register_script("slideout",get_template_directory_uri()."/assets/js/slideout.js");
            // wp_register_script("denuncias",get_template_directory_uri()."/assets/js/denuncias.js");
            wp_register_script("recursos",get_template_directory_uri()."/assets/js/recursos.js");
            
            wp_enqueue_script("scripts",get_template_directory_uri()."/assets/js/plastimedia.js",array('jquery','wow','splide','multiSplide','sticky','respond','basicScroll','contactos','slideout','recursos'));
        // scripts
    }
    add_action("wp_enqueue_scripts","plastiCommerce_assets");
    // enqueue 


    // imagenes destacadas en categorías
        // añado el campo al formulario de registro 
        function PC__add_category_image ( $taxonomy ) { ?>
            <div class="form-field term-group">
            <label for="category-image-id">Imágen destacada (1920*1100)</label>
            <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
            <div id="category-image-wrapper"></div>
            <p>
                <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="Añadir imagen" />
                <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="Eliminar imágen" />
            </p>
            </div>
        <?php
        }
        add_action( 'category_add_form_fields','PC__add_category_image', 10, 2 );
        

        function pc__category_add_script()
        {
            ?>
            <script>
                jQuery(document).ready( function($) {
                    function ct_media_upload(button_class) {
                        var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                        $('body').on('click', button_class, function(e) {
                        var button_id = '#'+$(this).attr('id');
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(button_id);
                        _custom_media = true;
                        wp.media.editor.send.attachment = function(props, attachment){
                            if ( _custom_media ) {
                            $('#category-image-id').val(attachment.id);
                            $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                            $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                            } else {
                            return _orig_send_attachment.apply( button_id, [props, attachment] );
                            }
                            }
                        wp.media.editor.open(button);
                        return false;
                    });
                    }
                    ct_media_upload('.ct_tax_media_button.button'); 
                    $('body').on('click','.ct_tax_media_remove',function(){
                    $('#category-image-id').val('');
                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    });
                    $(document).ajaxComplete(function(event, xhr, settings) {
                    var queryStringArr = settings.data.split('&');
                    if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                        var xml = xhr.responseXML;
                        $response = $(xml).find('term_id').text();
                        if($response!=""){
                        // Clear the thumb image
                        $('#category-image-wrapper').html('');
                        }
                    }
                    });
                }); 
            </script>
            <?php
        }
        // añadir js
        add_action( 'admin_footer', 'pc__category_add_script');

        // guardar el metadata
            function PC__save_category_image( $term_id, $tt_id)
            {
                if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                    $image = $_POST['category-image-id'];
                    add_term_meta( $term_id, 'category-image-id', $image, true );
                }
            }
            add_action( 'created_category', 'PC__save_category_image', 10, 2 );

        // guardar el metadata


        // actualizar imagen
            // añado los campos
            function PC__update_category_image ( $term, $taxonomy ) { ?>
                <tr class="form-field term-group-wrap">
                  <th scope="row">
                    <label for="category-image-id">Imágen destacada  (1920*1100)</label>
                  </th>
                  <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
                    <div id="category-image-wrapper">
                      <?php if ( $image_id ) { ?>
                        <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
                      <?php } ?>
                    </div>
                    <p>
                      <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="Añadir imagen" />
                      <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="Eliminar imagen" />
                    </p>
                  </td>
                </tr>
              <?php
              
            }
            add_action( 'category_edit_form_fields','PC__update_category_image', 10, 2 );
            
            function PC__updated_category_image ( $term_id, $tt_id ) {
                if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                  $image = $_POST['category-image-id'];
                  update_term_meta ( $term_id, 'category-image-id', $image );
                } else {
                  update_term_meta ( $term_id, 'category-image-id', '' );
                }
            }
            add_action( 'edited_category', 'PC__updated_category_image', 10, 2 );
        // actualizar imagen



    // imagenes destacadas en categorías
    
    

// --------------------------------


// FUNCIONES WOOCOMMERCE
// ----------------------------------
    // add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
    // function woo_reorder_tabs( $tabs ) {

    // 	$tabs['reviews']['priority'] = 5;			// Reviews first
    // 	$tabs['description']['priority'] = 10;			// Description second
    // 	$tabs['additional_information']['priority'] = 15;	// Additional information third

    // 	return $tabs;
    // }

    // add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
    function funCantidadProductos(){
        return 12;
    }
    add_filter( 'loop_shop_per_page', 'funCantidadProductos', 20 );
    
    // renonbro los tabs
    add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
    function woo_rename_tabs( $tabs ) {
        
        $tabs['description']['title'] = __( 'Descripción' );		// Rename the description tab
        $tabs['additional_information']['title'] = __( 'Especificaciones' );	// Rename the additional information tab
        // $tabs['reviews']['title'] = __( 'Calificaciones y comentarios' );	// Rename the additional information tab
        // $tabs['additional_information']['priority'] = 1;	// Rename the additional information tab
         unset($tabs['additional_information']);
        return $tabs;
    }
    

    // add_filter('woocommerce_share','textoinformativo');
    // function textoinformativo(){
    //     echo "<p>Al enviar los productos de este carrito, serás contactado por un vendedor de Grupo Al, para ampliar información. <strong>No es un comercio electrónico</strong>.</p>";
    // }

    
    /* Cambiar el número máximo de productos relacionados en la ficha de producto */
    // function PC__woo_limite_relacionados ($args) {
        
    //     $args['posts_per_page'] = 9;  // se muestran 4 productos
    //     array_push(
    //         $args, array('relation' =>  'OR')
    //     );
        
    //     // $args['columns'] = 2; // se muestran en columnas de dos en dos
    //     return $args;
    // }
    // add_filter ('woocommerce_output_related_products_args', 'PC__woo_limite_relacionados');

    // 
    // 

    // lista de ordenamiento
    
    // agregar modos de ordenamiento
    // modo A - Z
        add_filter('woocommerce_get_catalog_ordering_args','PC__add_order_a_z');
        function PC__add_order_a_z($args){
            $orderby_value =  isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
            
            if ('orden_alfabetico' == $orderby_value){            
                $args['orderby'] = 'name';
                $args['order'] = 'ASC';
                // $args['meta_key'] = 'title';
            }
            if ('orden_alfabetico_desc' == $orderby_value){            
                $args['orderby'] = 'name';
                $args['order'] = 'DESC';
                // $args['meta_key'] = 'title';
            }
            return $args;
        }
        // modo A - Z


        // elimino lo que no necesito
        add_filter('woocommerce_default_catalog_orderby_options','PC__custom_order_list_woocommerce');
        add_filter('woocommerce_catalog_orderby','PC__custom_order_list_woocommerce');
        function PC__custom_order_list_woocommerce($sortby){
            unset($sortby['popularity']);
            unset($sortby['rating']);
            unset($sortby['price']);
            unset($sortby['price-desc']);

            $sortby['orden_alfabetico'] = 'A - Z';
            $sortby['orden_alfabetico_desc'] = 'Z - A';

            return $sortby;
        }
    // lista de ordenamiento


    // opciones de vista de productos en tienda
    
        

    // productos destacados
        // remuevo el normalito
        // remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);

        function PC__related_productss(){
            global $product;
            // var_dump($product->get_category_ids());
            $terms_ids = $product->get_category_ids();
            $product_id_actual = $product->get_id();
            $total_productos_a_mostrar = 9;
            $cantidad_productos_mostrados = 0;
            ?>
                <section class="pc__productos_relacionados">
                <div class="ancho">
                <div class="info">
                    <h2>Productos relacionados</h2>
                </div>
                </div>
                    <div class="listado-destacados">
                    <div class="ancho">
                        <div class="splide_relacionados">
                            <div class="splide__track">
                            <ul class="splide__list products">
                                
                                <?php 
                                $ofertas = new WP_Query(array(
                                    'post_type' => array('product'),
                                    'post_status' => 'publish',
                                    // 'numberposts' => 9,
                                    // 'terms' => 'featured'
                                    // 'ignore_sticky_posts'   => 1,
                                    // 'tax_query' => array(
                                    //     'taxonomy' => 'product_cat',
                                    //     'field'    => 'term_id',
                                    //     'terms'     =>  20,
                                    //     'operator'  => 'IN'
                                    // )
                                    'tax_query'             => array(
                                        
                                        array(
                                            'taxonomy'      => 'product_cat',
                                            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                            'terms'         => $terms_ids,
                                            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                        )
                                    )
                                ));
                                if($ofertas->have_posts()):
                                    while($ofertas->have_posts()):
                                    $ofertas->the_post();
                                    global $product;
                                    if($product->get_id() != $product_id_actual){
                                        $cantidad_productos_mostrados++;
                                    ?>
                                        <li  <?php wc_product_class( 'splide__slide', $product ); ?>>
                                        <div class="producto" >
                                            <div class="content">

                                                <?php
                                                if( wp_get_attachment_url(get_post_meta($product->get_id(), '_imagen_secundaria_id', true)) != ''){
                                                    ?>
                                                    <a  href="<?php echo get_the_permalink();?>">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_meta($product->get_id(), '_imagen_secundaria_id', true));  ?>" class="secundaria" alt="">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                    <a class="thumbnail" href="<?php echo get_the_permalink();  ?>">
                                                        <?php echo $product->get_image(); ?>
                                                    </a>
                                                    <div class="botones">		
                                                        <?php // do_action('PC__wishlist_bucle'); ?>
                                                        <a class="read" href="<?php echo get_the_permalink();  ?>">Ver producto</a>
                                                    </div>
                                            </div>
                                            <h3><a href="<?php echo the_permalink();  ?>"><?php echo $product->get_name() ?></a></h3>
                                            <div class="desripcion">
                                                <?php echo "$". number_format($product->get_price()) ?>
                                            </div>
                                        </div>
                                        </li>
                                    <?php
                                    }
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                                <!-- aleatorio -->
                                <?php
                                if($cantidad_productos_mostrados < $total_productos_a_mostrar):
                                    $ofertas = new WP_Query(array(
                                        'post_type' => array('product'),
                                        'post_status' => 'publish',
                                        'orderby' => 'rand',
                                        'numberposts' => 9,
                                        // 'order' => 'rand',
                                    ));
                                    if($ofertas->have_posts()):
                                        while($ofertas->have_posts()):
                                        $ofertas->the_post();
                                        global $product;
                                        if($product->get_id() != $product_id_actual && $product->get_category_ids() != $terms_ids){
                                            $cantidad_productos_mostrados++;
                                        ?>
                                            <li  <?php wc_product_class( 'splide__slide', $product ); ?>>
                                            <div class="producto" >
                                                <div class="content">
    
                                                <div class="thumbnail">
                                                    <?php echo $product->get_image() ?>
                                                </div>
                                                <h3><?php echo $product->get_name() ?></h2>
                                                <div class="botones">
                                                    <?php do_action('PC__wishlist_bucle'); ?>
                                                    <!-- <a class="cart" href="<?php echo $product->add_to_cart_url() ?>">Añadir al carrito</a> -->
                                                    <?php do_action('PS_catalogo_add_to_cart_loop'); ?>
                                                    <a class="read" href="<?php echo the_permalink();  ?>">Leer más</a>
                                                </div>
                                                </div>
                                            </div>
                                            </li>
                                        <?php
                                            if($cantidad_productos_mostrados == 9){
                                                break;
                                            }
                                        }
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                endif;
                                ?>
                                
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div> 
                </section>
                <script>
                    $(document).ready(function(){
                        new Splide( '.splide_relacionados', {
                            type   : 'loop',
                            perPage: 3,
                            perMove: 1,
                            breakpoints:{
                                1024: {
                                    perPage: 2,
                                },
                                768: {
                                    perPage: 1,
                                },
                            },
                        } ).mount();
                       
                       
                    })
                </script>
            <?php
        }

        // add_action('woocommerce_after_single_product_summary','PC__related_productss',20);
    // productos destacados
    add_filter( 'woocommerce_display_product_attributes', 'custom_product_additional_information', 10, 2 );
    function custom_product_additional_information( $product_attributes, $product ) {
        // First row
        // $product_attributes[ 'attribute_' . 'custom-one' ] = array(
        //     'label' => '',
        //     'value' => '',
        // );

        return $product_attributes;
    }
add_filter('woocommerce_available_variation', 'custom_variation_images', 10, 3);

function custom_variation_images($args, $product, $variation) {
    $args['image']['src'] = wp_get_attachment_image_url($variation->get_image_id(), 'full');
    return $args;
}


function my_load_scripts() {
    wp_enqueue_script( 'my_js', get_theme_file_uri( 'assets/js/get-product.js'), array('jquery') );
    wp_localize_script( 'my_js', 'ajax_var', array(
        'url'    => admin_url( 'admin-ajax.php' ),
        'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
        'action' => 'get_product_by_category'
    ) );
}
add_action( 'wp_enqueue_scripts', 'my_load_scripts' );
function product_by_category() {
    $nonce = sanitize_text_field( $_POST['nonce'] );
    if ( ! wp_verify_nonce( $nonce, 'my-ajax-nonce' ) ) {
        die ( 'Busted!');
    }

    $cat = $_POST['cat']; 
    $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $cat))))), '-'));    
    $product_term_slugs = array($slug);
    $product_args = array(
        'post_status' => 'publish',
        'limit' => -1,
        'category' => $product_term_slugs,
    );
    $products = wc_get_products($product_args);

    if(count($products) > 0){
        $product = $products[0];
        $html = '';
        $html .= '<div class="dinamyc-product">';
            $html .= '<a href="'.$product->get_permalink().'">';
                $html .= '<strong>Producto destacado</strong>';
                $html .= $product->get_image();
                $html .= '<p>'.$product->get_title().'</p>';
            $html .= '</a>';
        $html .= '</div>';
        echo $html;
    }else {
        echo '';
    }
    wp_die();
}
add_action( 'wp_ajax_nopriv_get_product_by_category', 'product_by_category' );
add_action( 'wp_ajax_get_product_by_category', 'product_by_category' );

function title_mini_cart() {echo 'Mi carrito';};
remove_action( 'woocommerce_before_mini_cart', 'woocommerce_before_mini_cart', 10 );
add_action( 'woocommerce_before_mini_cart', 'title_mini_cart', 11 );

function custom_remove_account_menu_items($items) {
    // Eliminar el elemento "Escritorio"
    unset($items['dashboard']);
    
    // Eliminar el elemento "Descargas"
    unset($items['downloads']);
    $items['customer-logout'] = __('Cerrar sesión', 'woocommerce');
    $items['edit-address'] = __('Mis Direcciones', 'woocommerce');
    return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_remove_account_menu_items');


// Eliminar opciones de orden por defecto y ordenar por las últimas
function custom_remove_default_sorting_options($options) {
    unset($options['menu_order']);
    unset($options['popularity']);
    unset($options['date']);
    return $options;
}
add_filter('woocommerce_catalog_orderby', 'custom_remove_default_sorting_options', 10, 1);


// Añadir opciones de orden por menor precio y mayor precio
function custom_add_price_sorting_options($options) {
    $options['price_asc'] = __('Por menor precio', 'text-domain');
    $options['price_desc'] = __('Por mayor precio', 'text-domain');
    return $options;
}
add_filter('woocommerce_catalog_orderby', 'custom_add_price_sorting_options', 11, 1);

// Personalizar la consulta para ordenar por menor precio y mayor precio
function custom_price_sorting_args($args) {
    if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) {
            case 'price_asc':
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'asc';
                $args['meta_key'] = '_price';
                break;
            case 'price_desc':
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'desc';
                $args['meta_key'] = '_price';
                break;
            default:
                break;
        }
    }
    return $args;
}
add_filter('woocommerce_get_catalog_ordering_args', 'custom_price_sorting_args');


/**
 * Hacer obligatorio el campo de la ciudad en el formulario de checkout.
 */
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields', 99999, 1 );
function custom_override_default_address_fields( $address_fields ) {

    $address_fields['city']['label']        = __( 'Ciudad', 'woocommerce' );
    $address_fields['city']['placeholder']  = __( 'Ciudad');
    $address_fields['city']['required']     = true;

    return $address_fields;
} 




function enable_dwg_upload_support( $mimes ) {
    $mimes['dwg'] = 'application/acad';
    $mimes['dwg'] = 'application/octet-stream';
    $mimes['dwg'] = 'application/x-dwg';
    $mimes['dwg'] = 'application/x-acad';
    $mimes['dwg'] = 'image/vnd.dwg';
    $mimes['dwg'] = 'image/x-dwg';
    $mimes['dwg'] = 'application/dwg';
    $mimes['dwg'] = 'application/x-dwg';
    $mimes['dwg'] = 'application/x-autocad';
    return $mimes;
}
add_action('woocommerce_before_quantity_input_field', 'btn_before_input_qty_field');
function btn_before_input_qty_field(){
    echo '<button type="button" class="button button-qty" data-quantity="minus">-</button>';
}

add_action('woocommerce_after_quantity_input_field', 'btn_after_input_qty_field');
function btn_after_input_qty_field(){
    echo '<button type="button" class="button button-qty" data-quantity="plus">+</button>';
}

// sku busquedq
function custom_search_by_sku( $where, $wp_query ) {
    global $wpdb;
    
    if ( is_search() && ! is_admin() ) {
        $search_term = $wp_query->query_vars['s'];
        
        if ( ! empty( $search_term ) ) {
            $where = preg_replace(
                "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "({$wpdb->posts}.post_title LIKE $1) OR ( {$wpdb->posts}.ID IN (SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_sku' AND meta_value LIKE $1) )",
                $where
            );
        }
    }
    
    return $where;
}
add_filter( 'posts_search', 'custom_search_by_sku', 10, 2 );





// Añadir un botón de "Compra rápida" en la página de producto
add_action('woocommerce_after_add_to_cart_button', 'quick_buy_button');


function quick_buy_button() {
    global $product;
    
    // URL para agregar el producto al carrito y redirigir a la página de pago
    $quick_buy_url = wc_get_checkout_url() . '?add-to-cart=' . $product->get_id();
    
    // Botón de "Compra rápida"
    echo '<button class="single_add_to_cart_button button alt"><a href="' . esc_url($quick_buy_url) . '" class="">Comprar ahora</a></button>';
}




add_action( 'wp', 'remove_woocommerce_structured_data' );

function remove_woocommerce_structured_data() {
    // Remover datos estructurados en páginas de productos individuales
    remove_action( 'woocommerce_single_product_summary', array( WC()->structured_data, 'generate_product_data' ), 60 );

    // Remover datos estructurados en la tienda (product loop)
    remove_action( 'woocommerce_shop_loop_item_title', array( WC()->structured_data, 'generate_product_data' ), 40 );

    // Remover datos estructurados en páginas de categorías de productos
    remove_action( 'woocommerce_after_shop_loop_item', array( WC()->structured_data, 'generate_product_data' ), 40 );
}
//TRAER LA IMAGEN CORRECTA DE  LA VARIABLE
 add_action( 'wp_enqueue_scripts', 'custom_variation_images_script' );
function custom_variation_images_script() {
    if ( is_product() ) {
        wp_enqueue_script( 'custom-variation-images', get_template_directory_uri() . '/js/custom-variation-images.js', array( 'jquery' ), '1.0', true );
    }
}
add_filter( 'woocommerce_available_variation', 'custom_variation_image_data' );
function custom_variation_image_data( $variation ) {
    $variation['image_thumb'] = wp_get_attachment_image_src( $variation['image_id'], 'woocommerce_thumbnail' )[0];
    return $variation;
}

add_action('admin_post_nopriv_mi_formulario', 'procesar_formulario');
add_action('admin_post_mi_formulario', 'procesar_formulario');

function procesar_formulario_contacto() {
    // Recoger los datos enviados desde el formulario
    $nombre = sanitize_text_field($_POST['name']);
    $cedula = sanitize_text_field($_POST['cedula']);
    $empresa = sanitize_text_field($_POST['empresa']);
    $nit = sanitize_text_field($_POST['nit']);
    $celular = sanitize_text_field($_POST['celular']);
    $telefono = sanitize_text_field($_POST['telefono']);
    $email = sanitize_email($_POST['email']);
    $ciudad = sanitize_text_field($_POST['ciudad']);
    $asunto = sanitize_textarea_field($_POST['asunto']);
    $terminos = isset($_POST['terminos']) ? 'Aceptó términos' : 'No aceptó términos';

    // Si hay campos vacíos
    if ( empty($nombre) || empty($email) ) {
        wp_die('Todos los campos son obligatorios');
    }

    // Construir el mensaje del correo
    $message = "Nombre: $nombre\n";
    $message .= "Cédula: $cedula\n";
    $message .= "Empresa: $empresa\n";
    $message .= "NIT: $nit\n";
    $message .= "Celular: $celular\n";
    $message .= "Teléfono: $telefono\n";
    $message .= "Correo: $email\n";
    $message .= "Ciudad: $ciudad\n";
    $message .= "Asunto: $asunto\n";
    $message .= "Términos: $terminos\n";

    // Asunto del correo
    $subject = 'Nuevo formulario de contacto';

    // Dirección de correo a la que se enviará el mensaje (cambia este email por el tuyo)
    $to = 'auxiliarciuniversal@gmail.com';

    // Enviar el correo usando wp_mail()
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($to, $subject, $message, $headers);

    // Redirigir al usuario a una página de éxito (cambia la URL por la tuya)
    wp_redirect(home_url('/contactenos/'));
    exit;
}

// Acciones para procesar el formulario, tanto para usuarios registrados como no registrados
add_action('admin_post_procesar_formulario_contacto', 'procesar_formulario_contacto');
add_action('admin_post_nopriv_procesar_formulario_contacto', 'procesar_formulario_contacto');
