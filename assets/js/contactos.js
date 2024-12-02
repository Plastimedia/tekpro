$(document).ready(function(){

    function enviarCorreo(correo, html){
        return new Promise((resolve,reject)=>{
            $.post('https://api.plastimedia.com/api/mail/v2/send', {
                api_key: 'apikey_b62468ba7fdtt78f8h4t2f15s54at5hb1fr',
                email_from: 'soporte@plastimedia.com',
                name_from: 'Grupo Al',
                email_to: correo,
                name_to: 'Grupo Al',
                type: 'html',
                subject: 'PQRS',
                message: html
            }, function (data) {
                resolve()
            });
        });
    }



    $(".PS_catalogo__formulario_contacto_boton").click(function(e){
        e.preventDefault();
        $("input.error").removeClass('error');
            $("textarea.error").removeClass('error');
            $(".PS_catalogo__respuesta_activa").removeClass('PS_catalogo__respuesta_activa');
        // validaciones
        var validador = 0;
        if($(".PS_catalogo__frm_name").val().length == 0){
            $(".PS_catalogo__frm_name").addClass("error");
            $(".PS_catalogo__frm_name").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__frm_name").parent().children('.respuesta').text("Diligencie el campo");
            validador++;
        }
        
        if($(".PS_catalogo__observaciones").val().length == 0){
            $(".PS_catalogo__observaciones").addClass("error");
            $(".PS_catalogo__observaciones").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__observaciones").parent().children('.respuesta').text("Diligencie el campo");
            validador++;
        }
        if($(".PS_catalogo__observaciones").val().length > 599){
            $(".PS_catalogo__observaciones").addClass("error");
            $(".PS_catalogo__observaciones").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__observaciones").parent().children('.respuesta').text("Tus observaciones deben de tener menos de 600 carácteres");
            validador++;
        }


        if(
            ($(".PS_catalogo__frm_email").val().length == 0) &&
            ($(".PS_catalogo__frm_cel").val().length == 0) &&
            ($(".PS_catalogo__frm_phone").val().length == 0) 
        ){
            validador++;
            $(".PS_catalogo__frm_cel").addClass("error");
            $(".PS_catalogo__frm_cel").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__frm_phone").addClass("error");
            $(".PS_catalogo__frm_phone").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__frm_email").addClass("error");
            $(".PS_catalogo__frm_email").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__frm_email").parent().children('.respuesta').text("Indícanos una forma de contácto");
        }
        if( !$("input[name='terminos']").prop('checked') ){
            $("input[name='terminos']").addClass("error");
            $("input[name='terminos']").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $("input[name='terminos']").parent().children('.respuesta').text("Acepta los términos y condiciones");                
            validador++;
        }
        if(validador == 0){
            $("input.error").removeClass('error');
            $("textarea.error").removeClass('error');
            $(".PS_catalogo__respuesta_activa").removeClass('PS_catalogo__respuesta_activa');
            $(".PS_catalogo__formulario_contacto_boton").attr("disabled","disabled");
            $(".PS_catalogo__formulario_contacto_boton").css("cursor","not-allowed");
            $(".PS_catalogo__formulario_contacto_boton").text("Enviando");

            async function registrarContactoCRM(){
                let $form = document.querySelector("#PS_catalogo__formulario_contacto");
                let datos = new FormData($form);
                let datosParse = new URLSearchParams(datos);

                // construyo los datos
                let cName = datos.get('name')
                let cType = datos.get('contacto__tipo')
                // pregunta
                // queja
                // reclamo
                // sugerencia
                // Felicitacion
                switch (cType) {
                    case 'Preguntas':
                        cType = 'pregunta'     
                        break;
                    case 'Queja':
                        cType = 'queja'     
                        break;
                    case 'Reclamo':
                        cType = 'reclamo'     
                        break;
                    case 'Sugerencias':
                        cType = 'sugerencia'     
                        break;
                    case 'Felicitaciones':
                        cType = 'Felicitacion'     
                        break;
                
                    default:
                        break;
                }
                // let cReason = datos.get('motivo')
                let cReason = 'Otros'
                let cDescription = datos.get('observaciones')
                let cNoContactCRM = [];
                (datos.get('cel').length > 0) ? cNoContactCRM.push(datos.get('cel')) : '';
                (datos.get('phone').length > 0) ? cNoContactCRM.push(datos.get('phone')) : '';
                (datos.get('email').length > 0) ? cNoContactCRM.push(datos.get('email')) : '';
                cNoContactCRM = cNoContactCRM.join('-')
                console.table({
                    'name' : cName,
                    'type' : cType,
                    'reason' : cReason,
                    'description' : cDescription,
                    'priority' : 'alta',
                    'no_contact_crm': cNoContactCRM
                })
                let token = await fetch('https://siesacrm5.siesacloud.com:9536/webservices/auth/token/?grant_type=password&username=leidy.moreno&password=leidy2021&client_id=6Vl342XzAb2MGzgF1UPOnFrAPmOzP2xBiubUEWkA&client_secret=QzkHKULQ7aCM1HUfNioZX0W81fmxLLXCnsWANaZx0zZBWh2EORUg5OCbE9okhfBAueOGqcUwNIzWu9RftPLYSxwxHALkbqpoDD2XOm57tc6lcGJAeq4TdHcbWkGEA47P',
                    {method: 'POST'}
                );
                token = await token.json()
                token = `${token.token_type} ${token.access_token}`
                // console.log(token)

                
                var form = new FormData();
                form.append("name", cName);
                form.append("type", cType);
                form.append("reason", cReason);
                form.append("description", cDescription);
                form.append("priority", "Alta");
                form.append('no_contact_crm', cNoContactCRM);
                
                var settings = {
                "url": "https://siesacrm5.siesacloud.com:9536/webservices/cases/create/",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Authorization": token,
                    "Company": "1",
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
                };

                $.ajax(settings).done(function (response) {
                console.log("response site");
                console.log(response);
                });

                // temporal
                    // enviar correo
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
                                    html += '<strong>PQRS GRUPO AL</strong>'
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
                                                html += 'Nombre: '+cName+' <br/>'
                                                html += 'Celular: '+datos.get('cel')+' <br/>'
                                                html += 'Teléfono: '+datos.get('phone')+' <br/>'
                                                html += 'Correo: '+datos.get('email')+' <br/>'
                                                html += 'Tipo de solicitud: <br/>'
                                                html += cType+' <br/>'
                                            html += '</td>'
                                        html += '</tr> '

                                        html += '<tr>'
                                            html += '<td style="padding: 20px 15px; color: #111; font-family: Arial, sans-serif; font-size: 15px; border-radius: 5px;">'
                                                html += '<strong style="font-weight: 600; font-size: 17px">Observaciones:</strong><br>'
                                                html += '<p>'+cDescription+'</p>'
                                                html += ' <br/>'
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
                    await enviarCorreo('orlandojh57@gmail.com',html)
                    await enviarCorreo('leidy.moreno@grupoal.com.co',html)
                    await enviarCorreo('ricardo.jaramillo@grupoal.com.co',html)

                // temporal

                $("input[type='text']").val('')
                $("input[type='number']").val('')
                $("input[type='email']").val('')
                $("textarea").text('')
                $("input[type='checkbox']").prop('checked',false)
                $("input[type='radio']").prop('checked',false)
                $(".group.botones span.respuesta").text('Tu solicitud ha sido enviada');
                $(".group.botones span.respuesta").addClass('PS_catalogo__respuesta_activa');
                $(".group.botones span.respuesta").css('color','green');
                $(".PS_catalogo__formulario_contacto_boton").removeAttr("disabled","disabled");
                $(".PS_catalogo__formulario_contacto_boton").css("cursor","pointer");
                $(".PS_catalogo__formulario_contacto_boton").text("Enviar");
            }
            registrarContactoCRM()
        }
    })
});