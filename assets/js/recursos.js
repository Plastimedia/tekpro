function renderProductos(data, element){
    $(element).removeClass('loading')
    for (product of data.data){
        $(".resultadoBusqueda").append(`
            <div elid="${product.id}">
                <img src="${product.image}"/>
                <h3>${product.title}</h3>
                <button>Ver descargables</button>
            </div>
        `)
    }
}
function renderDownloables(data, element){
    $(element).removeClass('loading')
    
    if(data[0].cliente == null && data[0].b2b == null){
        $(element).append(`
            <div class="losdescargables">
                <h4>Este producto no tiene descargables...</h4>
            </div>
        `)

    }else{
        console.log(data)
        $(element).append(`
            <div class="losdescargables">
                <h4>Descargables</h4>
                <div class="listadoDescargables">
                </div>
            </div>
        `)
        if(data[0].cliente != null){
            for(file of data[0].cliente){
                $(element).children('.losdescargables').children('.listadoDescargables').append(`
                    <a href="${file.url}" target="_blank"><p>${file.title}</p> <button>Descargar</button></a>
                `)
            }
        }
        if(data[0].b2b != null){
            for(file of data[0].b2b){
                $(element).children('.losdescargables').children('.listadoDescargables').append(`
                    <a href="${file.url}" target="_blank"><p>${file.title}</p> <button>Descargar</button></a>
                `)
            }
        }
    }
}



$(document).ready(function(){

    //busqueda
    $("#botonBuscadorRecursos").on("click", function(){
        $(this).addClass('loading')
        $(".resultadoBusqueda").html('')
        fetch('https://muma.co/wp-json/recursos/v2/filtro_productos_busqueda/', {  
            method: 'POST',
            body: JSON.stringify({
                'search': $("#inputBuscadorRecursos").val(),
            }),
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => renderProductos(data, $(this)));
        
    })

    //documentos
    $(document).on("click",".resultadoBusqueda button",function(){
        let product_id =  $(this).parent().attr("elid")
        $(this).parent().addClass('loading')
        fetch(`https://muma.co/wp-json/recursos/v2/listado/${product_id}`)
        .then(response => response.json())
        .then(data => renderDownloables(data, $(this).parent()))
    })

})


