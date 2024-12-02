// obtener producto destacado de la categoria
jQuery(document).ready(function ($) {
    var timer = null
    $('li.menu-categorias > ul.sub-menu > li > ul.sub-menu > li').hover(function() {
        if(timer != null) {
            clearInterval(timer)
        }
        if($(this).children('.dinamyc-product').length == 0) {
            timer = setTimeout(() => {
                let cat = $(this).children('a').text()
                let elem = $(this)
                jQuery.ajax({
                    type: "post",
                    url: ajax_var.url,
                    data: "action=" + ajax_var.action + "&nonce=" + ajax_var.nonce+"&cat="+cat,
                    success: function(result){
                        if(result != '') {
                            elem.append(result)
                        }else {
                            elem.append('<div class="dinamyc-product"><a href="#"><p>Sin producto destacado.</p></a></div>')
                        }
                    }
                });
            }, 300)
        }
    });
});