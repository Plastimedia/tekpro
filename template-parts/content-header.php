<header class="header">
    <div class="ancho container-menu">
        <div class="logo">
            <?php the_custom_logo(); ?>
        </div>
        <div class="container-menu-buscador">
            <div class="buscador" style="text-align: center">
                <div class="logo">
                    <!-- los botones -->
                </div>
                <?php
                        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Buscador') ) :
                        endif;
                    
                ?> 
                <a href="#" class="menu-btn-hiden" onclick="event.preventDefault(); this.classList.toggle('active'); document.getElementById('menu').classList.toggle('active')">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
            <nav class="el-menu" id="menu">
                <input type="checkbox" id="menu_chk" />
                <label for="menu_chk" class="label_menu">
                    <?php
                        
                            wp_nav_menu( array('theme_location' => 'main-menu', 'container_class' => 'menu-ppl'));
                        
                    ?> 
                    <div id="btn_menu" class="">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </label>                
            </nav>
        </div>
        <div class="options_shop">
            
            <?php
            if (!is_user_logged_in()):
                ?>
                <a href="#login" class="account">Ingresar</a>
                <?php
            else:
                ?>
                <a href="https://sitios.plastimedia.com/rapeluches/mi-cuenta/orders/" class="account">Mi cuenta</a>
                <?php
            endif;
            ?>
            
            <a class="busquedas" data-toggle="modal" data-target="#ModalSearch" href="#"></a>

            

            <div class="cart">
                <span class="btn-cart">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Carrito') ) : ?>
                    <?php endif; ?>
                </span>
            </div>
            <?php

            ?>
        </div>
    </div>
</header>

<!-- modal busquedas -->
<div class="modal fade modalsearch" id="ModalSearch" tabindex="-1" role="dialog" aria-labelledby="Modal Buúsquedas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar productos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Buscador') ) : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" defer></script>

<!-- contador -->
<div class="seccion_contador">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Contador') ) : ?>
    <?php endif; ?>
</div>