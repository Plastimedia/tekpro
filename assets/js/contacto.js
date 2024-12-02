$(document).ready(function(){

    function enviarCorreo(correo, html){
        return new Promise((resolve,reject)=>{
            $.post('https://api.plastimedia.com/api/mail/v2/send', {
                api_key: 'apikey_b62468ba7fdtt78f8h4t2f15s54at5hb1fr',
                email_from: 'soporte@plastimedia.com',
                name_from: 'Sitio Web Muma',
                email_to: correo,
                name_to: 'Sitio Web Muma',
                type: 'html',
                subject: 'Contacto sitio web',
                message: html
            }, function (data) {
                resolve()
            });
        });
    }



    $(".PS_conatcto_muma_btn").click(function(e){
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
        
        if($(".PS_catalogo__frm_ciudad").val().length == 0){
            $(".PS_catalogo__frm_ciudad").addClass("error");
            $(".PS_catalogo__frm_ciudad").parent().children('.respuesta').addClass("PS_catalogo__respuesta_activa");
            $(".PS_catalogo__frm_ciudad").parent().children('.respuesta').text("Selecciona una ciudad");
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
            $("select.error").removeClass('error');
            $(".PS_catalogo__respuesta_activa").removeClass('PS_catalogo__respuesta_activa');
            $(".PS_conatcto_muma_btn").attr("disabled","disabled");
            $(".PS_conatcto_muma_btn").css("cursor","not-allowed");
            $(".PS_conatcto_muma_btn").text("Enviando");

            async function registrarContactoCRM(){
                let $form = document.querySelector("#PS__CONTACTO_MUMA");
                let datos = new FormData($form);
                let datosParse = new URLSearchParams(datos);

                // construyo los datos
                let cName = datos.get('name')
                
                

               

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
                                html += '<td bgcolor="#0099AB" style="padding: 30px 30px 30px 30px; border-bottom: 15px solid #A5DBD6; font-family: Arial, sans-serif; font-size: 24px; color: #fff;">'
                                    html += '<strong>Contacto Sitio Web Muma</strong>'
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
                                                html += 'Cédula: '+datos.get('cc')+' <br/>'
                                                html += 'Empresa: '+datos.get('empresa')+' <br/>'
                                                html += 'NIT: '+datos.get('nit')+' <br/>'
                                                html += 'Celular: '+datos.get('cel')+' <br/>'
                                                html += 'Teléfono: '+datos.get('phone')+' <br/>'
                                                html += 'Correo: '+datos.get('email')+' <br/>'
                                                html += 'Departamento: '+datos.get('ciudad')+'<br/>'
                                                html += ' <br/>'
                                            html += '</td>'
                                        html += '</tr> '

                                        html += '<tr>'
                                            html += '<td style="padding: 20px 15px; color: #111; font-family: Arial, sans-serif; font-size: 15px; border-radius: 5px;">'
                                                html += '<strong style="font-weight: 600; font-size: 17px">Observaciones:</strong><br>'
                                                html += '<p>'+datos.get('observaciones')+'</p>'
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
                                            html += '&copy; <a style="color: #111" href="https://muma.co/">MUMA</a>, 2023<br/>'
                                            
                                            html += '</td>'
                                            
                                        html += '</tr>'
                                    html += '</table>'
                                html += '</td>'
                            html += '</tr>'
                        html += '</table> '
                    html += '</body>'
                    html += '</html>'

                    switch (datos.get('ciudad')) {
                        case 'Amazonas':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Antioquia':
                            await enviarCorreo('lmunera@muma.co',html)
                            break;
                        case 'Arauca':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Atlántico':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Bogotá':
                            await enviarCorreo('maleman@muma.co',html)
                            break;
                        case 'Bolívar':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Boyacá':
                            await enviarCorreo('maleman@muma.co',html)
                            break;
                        case 'Caldas':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Caquetá':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Casanare':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Cauca':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Cesar':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Chocó':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Córdoba':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Cundinamarca':
                            await enviarCorreo('maleman@muma.co',html)
                            break;
                        case 'Guainía':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Guaviare':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Huila':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'La Guajira':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Magdalena':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Meta':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Nariño':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Norte de Santander':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Putumayo':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Quindío':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Risaralda':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'San Andrés y Providencia':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Santander':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Sucre':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Tolima':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Valle del Cauca':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Vaupés':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                        case 'Vichada':
                            await enviarCorreo('jflorez@muma.co',html)
                            break;
                    
                        default:
                            break;
                    }
                    await enviarCorreo('desarrolloweb@plastimedia.com',html)

                // temporal

                $("input[type='text']").val('')
                $("input[type='number']").val('')
                $("select").val('')
                $("input[type='email']").val('')
                $("textarea").text('')
                $("input[type='checkbox']").prop('checked',false)
                $("input[type='radio']").prop('checked',false)
                $(".group.botones span.respuesta").text('Tu solicitud ha sido enviada');
                $(".group.botones span.respuesta").addClass('PS_catalogo__respuesta_activa');
                $(".group.botones span.respuesta").css('color','green');
                $(".PS_conatcto_muma_btn").removeAttr("disabled","disabled");
                $(".PS_conatcto_muma_btn").css("cursor","pointer");
                $(".PS_conatcto_muma_btn").text("Enviar");
            }
            registrarContactoCRM()
        }
    })
});