<div class="head-image">

  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Slider Escritorio')): ?>

  <?php endif; ?>

  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Slider Celular')): ?>

  <?php endif; ?>

</div>


<!-- categorias -->

<section class="categorias" id="categorias">
  <div class="grid-categorias">
    <?php
    $categories = get_categories(
      array(
        'taxonomy' => 'product_cat',
        'parent' => 0,
        'hide_empty' => false,
        'number' => 6
      )
    );
    foreach ($categories as $category) {
      // echo '<img src="' .woocommerce_subcategory_thumbnail($category)  . '"><div class="col-md-4"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';   
      ?>
      <div class="category">
        <a href="<?php echo get_category_link($category->term_id) ?>">
          <div class="content">
            <img src="<?php
            $cid = get_term_meta($category->term_id, 'thumbnail_id', true);
            $laim = wp_get_attachment_image_src($cid, 'full');
            echo $laim[0];
            ?>" alt="<?php echo $category->name ?>" width="200" height="125">
            <p><?php echo $category->name ?></p>
          </div>
        </a>
      </div>
      <?php
    }
    ?>
  </div>
</section>

<!-- categorias -->

<!--info tekpro-->
<div class="info-tekpro">
  <div class="ancho">
    <div class="titulo-tekpro">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Tekpro titulo')): ?>
      <?php endif; ?>
    </div>
    <div class="info">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Tekpro info')): ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<!--info tekpro-->

<!--sección mercados-->
<div class="mercados-list">
  <div class="ancho">
    <div class="mercado-titulo">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Mercado titulo')): ?>
      <?php endif; ?>
    </div>
    <div class="info-mercados">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Categorias mercados')): ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<!--sección mercados-->

<!-- productos destacados -->

<section class="productos_destacados" id="productos_destacados">

  <div class="productos-destacados">

    <div class="ancho">

      <div class="info">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Productos Destacados')): ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="listado-destacados">



      <div class="ancho">

        <div class="splide_destacados">

          <div class="splide__track">

            <ul class="splide__list products">



              <?php
              $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'featured',
                'operator' => 'IN',

              );
              $ofertas = new WP_Query(
                array(

                  'post_type' => array('product'),
                  'post_status' => 'publish',

                  'posts_per_page' => 30,
                  'terms' => 'featured',
                  'order' => 'ASC',
                  'orderby' => 'menu_order',
                  'tax_query' => $tax_query
                )
              );

              if ($ofertas->have_posts()):

                while ($ofertas->have_posts()):

                  $ofertas->the_post();

                  global $product;

                  ?>

                  <li <?php wc_product_class('splide__slide', $product); ?>>

                    <div class="producto Coorporativo">
                      <div class="content">
                        <a class="thumbnail" href="<?php echo the_permalink(); ?>">
                          <?php
                          $product_image_id = $product->get_image_id();
                          $product_image_url = wp_get_attachment_url($product_image_id);
                          echo '<img src="' . esc_url($product_image_url) . '" alt="Imagen del Producto">';
                          ?>
                        </a>
                      </div>
                      <div class="content-text">
                        <h3><a href="<?php echo the_permalink(); ?>"><?php echo $product->get_name() ?></a></h3>
                      </div>
                      <div class="precios">
                        <?php
                        $product_price = $product->get_price();
                        $sale_price = $product->get_sale_price();
                        if (!$product->has_child()) {
                          if ($sale_price != $product_price && $sale_price != '') {
                            echo "<p><del style='text-decoration:line-through;'>$" . number_format($product_price, 0, ',', '.') . "</del></p>";
                            echo "<p><strong>$" . number_format($sale_price, 0, ',', '.') . "</strong></p>";
                          } else {
                            echo "<p>$" . number_format($product_price, 0, ',', '.') . "</p>";
                          }
                        } else {
                          echo "<p>Desde: $" . number_format($product_price, 0, ',', '.') . "</p>";
                        }
                        ?>
                      </div>

                    </div>

                  </li>

                  <?php

                endwhile;

                wp_reset_postdata();

              endif;

              ?>

            </ul>

          </div>

        </div>

      </div>

    </div>

    <!-- listado destacados -->

  </div>



</section>

<!-- productos destacados -->

<!--seccion nuevos productos-->
<div class="nuevos-productos">
  <div class="ancho">
    <!-- listado -->
    <div class="info2">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Productos Nuevos')): ?>
      <?php endif; ?>
    </div>
    <div class="splide_productos">

      <div class="splide__track">

        <ul class="splide__list products">



          <?php
          $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'name',
            'terms' => 'featured',
            'operator' => 'IN',

          );
          $ofertas = new WP_Query(
            array(

              'post_type' => array('product'),
              'post_status' => 'publish',
              'posts_per_page' => 30,
              'order' => 'ASC',
              'orderby' => 'menu_order'
            )
          );

          if ($ofertas->have_posts()):

            while ($ofertas->have_posts()):

              $ofertas->the_post();

              global $product;

              ?>

              <li <?php wc_product_class('splide__slide', $product); ?>>

                <div class="producto Coorporativo">
                  <div class="content">
                    <a class="thumbnail" href="<?php echo the_permalink(); ?>">
                      <?php
                      $product_image_id = $product->get_image_id();
                      $product_image_url = wp_get_attachment_url($product_image_id);
                      echo '<img src="' . esc_url($product_image_url) . '" alt="Imagen del Producto">';
                      ?>
                    </a>
                  </div>
                  <div class="content-text">
                    <h3><a href="<?php echo the_permalink(); ?>"><?php echo $product->get_name() ?></a></h3>
                    
                  </div>
                  <div class="precios">
                    <?php
                    $product_price = $product->get_price();
                    $sale_price = $product->get_sale_price();
                    if(! $product->has_child() ){
                        if($sale_price != $product_price && $sale_price != '') {
                            echo "<p><del style='text-decoration:line-through;'>$".number_format($product_price, 0,',','.')."</del></p>";
                            echo "<p><strong>$".number_format($sale_price, 0,',','.')."</strong></p>";
                        } else {
                            echo "<p>$".number_format($product_price, 0,',','.')."</p>";
                        }
                    }else{
                        echo "<p>Desde: $".number_format($product_price, 0,',','.')."</p>";
                    }
                    ?>
                  </div>

                </div>

              </li>

              <?php

            endwhile;

            wp_reset_postdata();

          endif;

          ?>

        </ul>

      </div>

    </div>

  </div>
</div>

<!--Sección de blogs-->
<div class="blog">
  <div class="ancho">
    <div class="info">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog')): ?>
      <?php endif; ?>
    </div>
    <div class="content-blog">
      <?php
      $args = array(
        'post_type' => 'post', // Tipo de contenido
        'posts_per_page' => 5, // Número de entradas a mostrar
        'orderby' => 'date', // Ordenar por fecha
        'order' => 'DESC' // Orden descendente
      );

      $query = new WP_Query($args);

      if ($query->have_posts()):
        while ($query->have_posts()):
          $query->the_post();
          ?>
          <div class="contenedor-blog">
            <article>
              <!-- Imagen destacada -->
              <?php if (has_post_thumbnail()): ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium'); // Tamaño de la imagen ?>
                </a>
              <?php endif; ?>
              <div class="content-extracto">
                <!-- Título -->
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <!-- Extracto -->
                <p><?php the_excerpt(); ?></p>
                <!-- Fecha -->
                <p><?php echo get_the_date(); ?></p>
              </div>
            </article>
          </div>
          <hr>
          <?php
        endwhile;
      else:
        echo '<p>No se encontraron entradas.</p>';
      endif;

      // Restablecer la consulta después de usar WP_Query
      wp_reset_postdata();
      ?>
    </div>
  </div>
</div>
<!--Sección de blogs-->

<!--sección marcas aliadas-->
<div class="seccion-marcas">
  <div class="ancho">
    <div class="info-marcas splide_marcas">
      <div class="splide__track">
        <div class="splide__list marcas">
          <div class="splide__slide marca">
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Marcas')): ?>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--seccion marcas aliadas-->
<script>

  $(document).ready(function () {



    function splide_destacados() {

      if (window.matchMedia("(max-width: 500px)").matches) {

        new Splide('.splide_destacados', {

          //type   : 'loop',

          perPage: 1,

          perMove: 1,
          rewind: true,

        }).mount();

      } else {

        if (window.matchMedia("(max-width: 900px)").matches) {

          new Splide('.splide_destacados', {

            //type   : 'loop',

            perPage: 2,

            perMove: 1,
            rewind: true,

          }).mount();

        } else {

          if (window.matchMedia("(max-width: 1150px)").matches) {

            new Splide('.splide_destacados', {

              // type   : 'loop',

              perPage: 3,

              perMove: 1,
              rewind: true,

              // autoWidth: true,

            }).mount();

          } else {

            new Splide('.splide_destacados', {

              //type   : 'loop',

              perPage: 4,

              perMove: 1,
              rewind: true,

            }).mount();

          }

        }

      }

    }



    var C1 = window.matchMedia("(max-width: 500px)")

    var C2 = window.matchMedia("(max-width: 900px)")

    var C3 = window.matchMedia("(max-width: 1150px)")

    splide_destacados();

    C1.addListener(splide_destacados)

    C2.addListener(splide_destacados)

    C3.addListener(splide_destacados)



    function splide_productos() {

      if (window.matchMedia("(max-width: 500px)").matches) {

        new Splide('.splide_productos', {

          //type   : 'loop',

          perPage: 1,

          perMove: 1,
          rewind: true,

        }).mount();

      } else {

        if (window.matchMedia("(max-width: 900px)").matches) {

          new Splide('.splide_productos', {

            //type   : 'loop',

            perPage: 2,

            perMove: 1,
            rewind: true,

          }).mount();

        } else {

          if (window.matchMedia("(max-width: 1150px)").matches) {

            new Splide('.splide_productos', {

              // type   : 'loop',

              perPage: 3,

              perMove: 1,
              rewind: true,

              // autoWidth: true,

            }).mount();

          } else {

            new Splide('.splide_productos', {

              //type   : 'loop',

              perPage: 4,

              perMove: 1,
              rewind: true,

            }).mount();

          }

        }

      }

    }



    var C1 = window.matchMedia("(max-width: 500px)")

    var C2 = window.matchMedia("(max-width: 900px)")

    var C3 = window.matchMedia("(max-width: 1150px)")

    splide_productos();

    C1.addListener(splide_productos)

    C2.addListener(splide_productos)

    C3.addListener(splide_productos)



    new Splide('.splide_carrusel-descuentos', {
      //type   : 'loop',
      perPage: 3,
      perMove: 1,
      rewind: true,
      breakpoints: {
        1024: {
          perPage: 2
        },
        768: {
          perPage: 1
        }
      },
    }).mount();

    new Splide( '.splide_marcas', {
      type   : 'loop',
      perPage: 1,
      perMove: 1,
      rewind : true,
      breakpoints: {
        1024: {
          perPage: 2
        },
        768: {
          perPage: 1
        }
      },
    } ).mount();


  });

</script>