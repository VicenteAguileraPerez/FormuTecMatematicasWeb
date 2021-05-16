$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    var motivo ;
    $("input[name=opcion]").change(function () {	 
        motivo=$(this).val();
        console.log(motivo);
        });
    $("#enviar").click(function () {
        var nombre = $("#nombre").val();
        var email = $("#email").val();
        var mensaje = $("#mensaje").val();
       if(motivo === undefined)
       {
           motivo="";
       }
        $.ajax({
            url: "http://localhost/FormuTecMatematicasWeb/public/v1/crearcomentario",
            type: "POST",
            data: { nombre: nombre, email: email, motivo: motivo, mensaje: mensaje },
            success: function (respuesta) {
                console.log(JSON.stringify(respuesta));
                var json = respuesta;
                var mensaje = $("#message");
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
                    else 
                    {
                        mensaje.empty();
                        alert(json["success"]);
                    }
                }
                else {
                    mensaje.empty();
                    mensaje.append(
                        '<p>' + "Error interno" + '</p>');
                }
            },
            error: function (respuesta) {
                console.log(JSON.stringify(respuesta));
            }
        });
    });
});
var json;
$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $.ajax({
        'url': "http://localhost/FormuTecMatematicasWeb/public/v1/vercomentarios",
        'method': "GET",
        'contentType': 'application/json',
        success: function (data) {

            var trHTML = '<tbody>';
            json = data;
            $.each(data['success'], function (i, item) 
            {
                var motivo = data['success'][i]['motivo']===1?"Queja":"Sugerencia";
                id=parseInt(data['success'][i]['id']);
                trHTML += '<tr scope="row"><td>'+data['success'][i]['id']+'</td><td>'+data['success'][i]['nombre']+'</td><td>'+data['success'][i]['email']+'</td><td>'+data['success'][i]['mensaje']+'</td><td>'+motivo+'</td><td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showData('+id+')">Ver</button></td></tr>';
            });
           
            
       
            $('#comments').append(trHTML+"</tbody>");
    
            },
    
        error: function (msg) {
    
                alert(msg.responseText);
            }
        });
   
    

});


$(document).ready(function () 
{   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#eliminar").click(function () 
    {
        
       $.ajax(
        {
            'url': "http://localhost/FormuTecMatematicasWeb/public/v1/eliminarcomentario/"+id,
            'method': "DELETE",
            'contentType': 'application/json',
            success: function (respuesta) 
            {
                var json = respuesta;
                var mensaje = $("#message");
                mensaje.css("color", "#DC3545");
                mensaje.css("padding-top", "0.5rem");
                if (!json['error']) {
                    if (json['message']) 
                    {
                        mensaje.empty();
                        mensaje.css("color", "#DC3545");
                        mensaje.append(json['message']);
                    }
                    else {
                        mensaje.empty();
                        setTimeout(() => location.href = "http://localhost/formutecmatematicasweb/paginas/comentarios.html", 500);
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
});

