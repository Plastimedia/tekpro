$(document).ready(function(){
    $(".boton_reporte_denuncias").click(function(e){
        console.log('boton denuncia')
        e.preventDefault();
        var validador =  0;
        var anonimato = '';
        var tipo_denuncia = '';
        var aporta_documentos = '';
        // anonimato
            $("input[name='anonima']").each(function(){
                if($(this).prop('checked')){
                    anonimato = $(this).val()
                }
            });
            if(anonimato != ''){
                $(".groupanonimo").children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }else{
                // vacio
                validador++;
                $(".groupanonimo").children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                $(".groupanonimo").children('.respuesta').text("Selecciona una opción");                
            }
        // anonimato

        // info denunciante
            if(!(anonimato == 'No')){
                $(".PS_catalogo__frm_name").removeClass("error");
                $(".PS_catalogo__frm_name").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
                $(".PS_catalogo__frm_cel").removeClass("error");
                $(".PS_catalogo__frm_cel").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
                $(".PS_catalogo__frm_identificacion").removeClass("error");
                $(".PS_catalogo__frm_identificacion").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
                $(".PS_catalogo__frm_email").removeClass("error");
                $(".PS_catalogo__frm_email").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }else{
                // nombre
                if( $('.PS_catalogo__frm_name').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_name").addClass("error");
                    $(".PS_catalogo__frm_name").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_name").parent().children('.respuesta').text("Diligencie el campo");
                }
                // telefono
                if( $('.PS_catalogo__frm_cel').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_cel").addClass("error");
                    $(".PS_catalogo__frm_cel").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_cel").parent().children('.respuesta').text("Diligencie el campo");
                }
                // id
                if( $('.PS_catalogo__frm_identificacion').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_identificacion").addClass("error");
                    $(".PS_catalogo__frm_identificacion").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_identificacion").parent().children('.respuesta').text("Diligencie el campo");
                }
                // email
                if( $('.PS_catalogo__frm_email').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_email").addClass("error");
                    $(".PS_catalogo__frm_email").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_email").parent().children('.respuesta').text("Diligencie el campo");
                }

            }
        // info denunciante

        // tipo denuncia
            $("input[name='motivo']").each(function(){
                if($(this).prop('checked')){
                    tipo_denuncia = $(this).val()
                }
            });
            if(tipo_denuncia != ''){
                $(".group.motivo").children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }else{
                // vacio
                validador++;
                $(".group.motivo").children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                $(".group.motivo").children('.respuesta').text("Selecciona una opción");                
            }
        // tipo denuncia
        
        // detalle
            if( $('.PS_catalogo__detalles').val().length == 0 ){
                validador++;
                $(".PS_catalogo__detalles").addClass("error");
                $(".PS_catalogo__detalles").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                $(".PS_catalogo__detalles").parent().children('.respuesta').text("Diligencie el campo");
            }else{
                $(".PS_catalogo__detalles").removeClass("error");
                $(".PS_catalogo__detalles").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }
        // detalle

        // aporta documentos
            $("input[name='documentos']").each(function(){
                if($(this).prop('checked')){
                    aporta_documentos = $(this).val()
                }
            });
            if(aporta_documentos != ''){
                $(".group.documentos").children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }else{
                // vacio
                validador++;
                $(".group.documentos").children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                $(".group.documentos").children('.respuesta').text("Selecciona una opción");                
            }

            if(aporta_documentos == 'No'){
                $(".PS_catalogo__frm_documentos_descripcion").removeClass("error");
                $(".PS_catalogo__frm_documentos_descripcion").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
                $(".PS_catalogo__frm_documentos_adjuntados").removeClass("error");
                $(".PS_catalogo__frm_documentos_adjuntados").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");
            }else{
                // descripcion docuemntos aportados
                if( $('.PS_catalogo__frm_documentos_descripcion').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_documentos_descripcion").addClass("error");
                    $(".PS_catalogo__frm_documentos_descripcion").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_documentos_descripcion").parent().children('.respuesta').text("Diligencie el campo");
                }
                // adjuntos
                if( $('.PS_catalogo__frm_documentos_adjuntados').val().length == 0 ){
                    validador++;
                    $(".PS_catalogo__frm_documentos_adjuntados").addClass("error");
                    $(".PS_catalogo__frm_documentos_adjuntados").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
                    $(".PS_catalogo__frm_documentos_adjuntados").parent().children('.respuesta').text("Diligencie el campo");
                }
            }
        // aporta documentos

        // terminos y condiciones
        if( !$("input[name='terminos']").prop('checked') ){
            $("input[name='terminos']").addClass("error");
            $("input[name='terminos']").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $("input[name='terminos']").parent().children('.respuesta').text("Acepta los términos y condiciones");                
            validador++;
        }else{
            $("input[name='terminos']").parent().children('.respuesta').removeClass("PS_catalogo__respuesta_activa");

        }
        // terminos y condiciones

        // si a todo
        console.log(validador)
        if(validador == 0){
            console.log('si');
            let form = new FormData( document.getElementById("PS_catalogo__formulario_contacto") )
            let url_rest = $("#PS_catalogo__formulario_contacto").attr('action')
            console.log(url_rest)
            fetch(url_rest,{
                method: 'POST',
                body: form
            }).then(json => json.json()).then(json=>{
                console.log(json)
                if(json.status == 200){
                    console.log('ok')
                    console.log('enviando...')
                    var html = '';
                    html += '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
                    html += '<html xmlns="http://www.w3.org/1999/xhtml">'
                    html += '<head>'
                        html += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
                        html += '<titleReporte denuncia</title>'
                        html += '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>'
                    html += '</head>'
                    html += '<body style="margin: 0; padding: 0;">'
                        html += '<table align="center" border="0"  cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #eaeaea; margin-bottom: 15px;">'
                            html += '<tr>'
                                html += '<td bgcolor="#0C2442" style="padding: 30px 30px 30px 30px; border-bottom: 15px solid #2282B5; font-family: Arial, sans-serif; font-size: 24px; color: #fff;">'
                                    html += '<strong>Reporte denuncia GRUPO AL</strong>'
                                html += '</td>'
                            html += '</tr>'
                            html += '<tr>'
                                html += '<td bgcolor="#ffffff" style="padding: 15px 30px;">		'
                                    html += '<table border="0" cellpadding="0" cellspacing="0" width="100%">'
                                        html += '<tr>'
                                            html += '<td style="color: #111; font-family: Arial, sans-serif; font-size: 24px; padding: 15px 0">'
                                                html += '<b></b>'
                                            html += '</td>'
                                        html += '</tr>'
                                        html += '<tr>'
                                            html += '<td style="padding: 20px 0 30px 0; color: #111; font-family: Arial, sans-serif; font-size: 15px;">'
                                                if(!(anonimato == 'No')){
                                                    html += 'La denuncia es anónima <br/>'                                                    
                                                }else{
                                                    html += 'Nombre: '+$('.PS_catalogo__frm_name').val()+' <br/>'
                                                    html += 'Identificación: '+$('.PS_catalogo__frm_identificacion').val()+' <br/>'
                                                    html += 'Teléfono: '+$('.PS_catalogo__frm_cel').val()+' <br/>'
                                                    html += 'Correo: '+$('.PS_catalogo__frm_email').val()+' <br/>'
                                                }
                                                html += 'Tipo de denuncia: <br/>'
                                                html += tipo_denuncia+' <br/>'
                                            html += '</td>'
                                        html += '</tr> '

                                        html += '<tr>'
                                            html += '<td style="padding: 20px 15px; color: #111; font-family: Arial, sans-serif; font-size: 15px; border-radius: 5px;">'
                                                html += '<strong style="font-weight: 600; font-size: 17px">Detalle:</strong><br>'
                                                html += '<p>'+$('.PS_catalogo__detalles').val()+'</p>'
                                                html += ' <br/>'
                                                if(aporta_documentos == 'No'){
                                                    html += 'Aporta documentos: No <br/>'
                                                }else{
                                                    html += 'Aporta documentos: SI <br/>'
                                                    html += '<a href="http://grupoal.com.co/wp-content/themes/plastimedia/documentos/' + json.name + '">Ver documentos</a> <br/>'

                                                }
                                            html += '</td>'
                                        html += '</tr> '
                                    html += '</table>'
                                html += '</td>'
                            html += '</tr>'
                            html += '<tr>'
                                html += '<td bgcolor="#eaeaea" style="padding: 30px 30px 30px 30px;">'
                                    html += '<table border="0" cellpadding="0" cellspacing="0" width="100%">'
                                        html += '<tr>'
                                            html += '<td width="75%" style="color: #111; font-family: Arial, sans-serif; font-size: 14px;">'
                                            html += '&copy; <a style="color: #111" href="https://grupoal.com.co/">GRUPO AL</a>, 2022<br/>'
                                            
                                            html += '</td>'
                                            
                                        html += '</tr>'
                                    html += '</table>'
                                html += '</td>'
                            html += '</tr>'
                        html += '</table> '
                    html += '</body>'
                    html += '</html>'
                    $.post('http://api.plastimedia.com/api/mail/v2/send', {
                        api_key: 'apikey_b62468ba7fdtt78f8h4t2f15s54at5hb1fr',
                        email_from: 'soporte@plastimedia.com',
                        name_from: 'Reporte Denuncia - sitio web',
                        email_to: 'transparenciayetica@grupoal.com.co',
                        name_to: 'Grupo Al',
                        type: 'html',
                        subject: 'Reporte Denuncia - sitio web',
                        message: html
                    }, function (data) {
                        // vaciar
                        // ready
                        console.log('enviado');
                        $("input[type='text']").val('')
                        $("input[type='number']").val('')
                        $("input[type='email']").val('')
                        $("input[type='checkbox']").prop('checked',false)
                        $("input[type='radio']").prop('checked',false)

                        $(".group.botones span.respuesta").text('Tu denuncia ha sido enviada');
                        $(".group.botones span.respuesta").addClass('PS_catalogo__respuesta_activa');
                        $(".group.botones span.respuesta").css('color','green');
                    });
                }
            })
        }

    });
});