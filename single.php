<?php get_header(); ?>
<?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <!-- <div class="head-image">
			<div class="img-sec">
				<?php if (has_post_thumbnail()) {
                    ImagenDestacadaPlas('single', 'entrada');
                } else { ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fondo-full.jpg" alt="portada">
				<?php } ?>
			</div>
			<div class="page-heading">
				<h1>
					<?php the_title(); ?>
				</h1>
			</div>
		</div> -->
   
    <main class="mainSingle">
        <div class="ancho">
            <h1 class="titulo_category_no_banner title_blog_ppl" style="text-align: center"><?php the_title(); ?></h1>
            <div class="redes_sociales "></div>
            <div class="contenido">
                <div class="two-columns">
                    <div class="uno">
                    <?php the_content();
                endwhile ?>
                    </div>

                    <div class="dos">
                        <h3>Publicaciones recientes</h3>
                        <ul class="">
                            <?php
                            $args = array(
                                'category_name' => 'blog',
                                'showposts'     => '3'
                            );
                            $wp_query = new WP_Query($args);

                            if (have_posts()) :
                                while (have_posts()) : the_post();
                            ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <li>
                                            <div class="content_novedades">
                                                <div class="thumbnail">
                                                    <?php ImagenDestacadaPlas('home', 'entrada') ?>
                                                </div>
                                                <div class="info_novedades">
                                                    <h3><?php the_title(); ?></h3>
                                                    <small><?php echo get_the_date('d/m/Y'); ?></small>
                                                    <!-- <p><?php the_excerpt(); ?></p> -->
                                                    <!-- <p class="botones">
										<a href="<?php the_permalink(); ?>">Leer más</a>
									</p> -->
                                                </div>
                                            </div>
                                            <div class="separator"></div>
                                        </li>
                                    </a>
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
    </main>
    <div class="contenedor_entradas">


        <script>
            $(document).ready(function() {
                $(document).on('click', ".share-print a", function(e) {
                    e.preventDefault();
                    window.print();
                })
            })
        </script>
        <!-- datos estructurados -->
        
        <!-- datos estructurados -->
        <?php get_footer(); ?>
