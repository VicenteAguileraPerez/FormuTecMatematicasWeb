$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if(getCookie().length>0)
    {
        $("#agregar").click(function () {
            var nombre = $("#nombre").val();
            var descripcion = $("#descripcion").val();
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);

            var mensaje = $("#message");
            if(nombre)
            {
                if(files)
                {
                    $.ajax({
                        url: "http://localhost/FormuTecMatematicasWeb/public/v1/tema/"+nombre+"/"+descripcion,
                        type: "POST",
                        headers: {'Authorization':getCookie()},
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {
                            console.log(JSON.stringify(respuesta));
                            var json = respuesta;
                        
                            mensaje.css("color", "#DC3545");
                            mensaje.css("padding-top", "0.5rem");
                            if (!json['error']) 
                            {
                                if (json['message']) 
                                {
                                    mensaje.empty();
                                    mensaje.css("color", "#DC3545");
                                    mensaje.append(json['message']);
                                }
                                else if (json['image_format']) 
                                {
                                    mensaje.empty();
                                    mensaje.css("color", "#DC3545");
                                    mensaje.append(json['image_format']);
                                }
                                else if (json['big_image']) 
                                {
                                    mensaje.empty();
                                    mensaje.css("color", "#DC3545");
                                    mensaje.append(json['big_image']);
                                }
                                else if(json['no_authorized'])
                                {
                                    mensaje.empty();
                                    mensaje.css("color", "#DC3545");
                                    mensaje.append(json['no_authorized']);
                                    clearCookie();
                                    setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html", 500);
                                }
                                else 
                                {
                                    mensaje.empty();
                                    mensaje.css("color", "#090979");
                                    mensaje.append( json["success"]);
                                    setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerTema.html", 500);
                                }
                            }
                            else {
                                mensaje.empty();
                                mensaje.append(
                                    '<p>' + "Error interno" + '</p>');
                            }
                        },
                        error: function (respuesta) {
                            console.log("error");
                        }
                    });
                }
                else 
                {
                    mensaje.empty();
                    mensaje.css("color", "#DC3545");
                    mensaje.append("Seleccione un archivo");
                }
            }
            else 
            {
                mensaje.empty();
                mensaje.css("color", "#DC3545");
                mensaje.append("Introduce el nombre del tema");
            }               
        });
    }
    else
    {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
    
});

var json;
$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    
    if(getCookie().length>0)
    {
        $.ajax({
            'url': "http://localhost/FormuTecMatematicasWeb/public/v1/temas",
            'method': "GET",
             headers: {'Authorization':getCookie()},
            'contentType': 'application/json',
            success: function (data) 
            {
                if(data['no_authorized'])
                {
                    alert(data['no_authorized']);
                    clearCookie();
                    setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/login.html", 500);
                }
                else
                {
                    var trHTML = '<tbody>';
                    json = data;
                    $.each(data['success'], function (i, item) 
                    {
                        
                        id=parseInt(data['success'][i]['id']);
                        trHTML += '<tr scope="row"><td>'+data['success'][i]['id']+'</td><td>'+data['success'][i]['nombre']+'</td><td><img width="100px" height="100px" src="'+data['success'][i]['imagen']+'" ></td><td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" onclick="showTema('+id+')">Eliminar</button></td><td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal" onclick="showTemaEditar('+id+')" >Editar</button></td></tr>';//
                    });
                    $('#temas').append(trHTML+"</tbody>");
                }       

               
        
                },
        
            error: function (msg) {
        
                    alert(msg.responseText);
                }
            });
    }
    else
    {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
    

});

$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if(getCookie().length>0)
    {
        $("#eliminar").click(function () 
        {
            
        $.ajax(
            {
                'url': "http://localhost/FormuTecMatematicasWeb/public/v1/tema/"+id,
                'method': "DELETE",
                 headers: {'Authorization':getCookie()},
                 data:JSON.stringify({url:url}),
                'contentType': 'application/json',
                success: function (respuesta) 
                {
                    var json = respuesta;
                    var mensaje = $("#messageeli");
                    mensaje.css("color", "#DC3545");
                    mensaje.css("padding-top", "0.5rem");
                    if (!json['error']) {
                        if (json['message']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['message']);
                        }
                        else if (json['image_format']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['image_format']);
                        }
                        else if (json['big_image']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['big_image']);
                        }
                        else if(json['no_authorized'])
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['no_authorized']);
                            clearCookie();
                            setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/login.html", 500);
                        }
                        else {
                            mensaje.empty();
                            console.log(respuesta);
                            setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerTema.html", 500);
                        }
                    }
                    else {
                        mensaje.empty();
                        mensaje.append(
                            '<p>' + "Error interno" + '</p>');
                    }
                },    
                error: function (resultado)
                {
            
                }    
            });
        });
    }
    else
    {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
});

$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
   
    if(getCookie().length>0)
    {
        $("#editar").click(function () 
        {
            var nombre = $("#nombreedit").val();
            var descripcion = $("#descripcionedit").val();
            var fd = new FormData();
            var files = $('#fileedit')[0].files[0];
            fd.append('file',files);
        
            var mensaje = $("#messageedit");
            
           
        $.ajax(
            {
                'url': "http://localhost/FormuTecMatematicasWeb/public/v1/tema/"+id+"/"+nombre+"/"+nombreAnt+"/"+descripcion,
                'method': "POST",
                headers: {'Authorization':getCookie()},
                data: fd,
                contentType: false,
                processData: false,
                success: function (respuesta) 
                {
                    var json = respuesta;
                    
                    mensaje.css("color", "#DC3545");
                    mensaje.css("padding-top", "0.5rem");
                    if (!json['error']) {
                        if (json['message']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['message']);
                        }
                        else if (json['image_format']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['image_format']);
                        }
                        else if (json['big_image']) 
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['big_image']);
                        }
                        else if(json['no_authorized'])
                        {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['no_authorized']);
                            clearCookie();
                            setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html", 500);
                        }    
                        else {
                            mensaje.empty();
                            console.log(JSON.stringify(respuesta));
                            setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerTema.html", 500);
                        }
                    }
                    else {
                        mensaje.empty();
                        mensaje.append(
                            '<p>' + "Error interno" + '</p>');
                    }
                },    
                error: function (resultado)
                {
                    console.log(resultado);
                }    
            });
        
        });
    }
    else
    {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
});