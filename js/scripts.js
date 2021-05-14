

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#registrar").click(function () {
        var nombre = $("#nombre").val();
        var email = $("#correo").val();
        var password1 = $("#contrasena1").val();
        var password2 = $("#contrasena2").val();
       
        $.ajax({ 
            url: "http://localhost/FormuTecMatematicasWeb/public/v1/registrarse",
            type: "POST",
            data: { nombre: nombre, email: email, password: password1 },
            success: function(respuesta) 
            {
                console.log(JSON.stringify(respuesta));
                var json = respuesta;
                var mensaje = $("#message");
                mensaje.css("color", "#DC3545");
                mensaje.css("padding-top", "0.5rem");
                
                if(!json['error'])
                {
                    if(json['message'])
                    {
                    
                        mensaje.empty();
                        mensaje.css("color", "#DC3545");
                        mensaje.append(json['message']);
                    }
                    else{
                    
                        mensaje.empty();
                        mensaje.css("color", "#090979");
                        mensaje.append(
                        '<p>' +  "Usuario Creado, redireccionando a Login..." + '</p>');
                        setTimeout(()=> location.href="http://localhost/formuTecMatematicasWeb/paginas/login.html", 1000);
                    }
                }
                else{
                    mensaje.empty();
                    
                    mensaje.append(
                    '<p>' +"Error interno"+ '</p>');
                }
                
               
            },
            error: function() 
            {
                console.log("No se ha podido obtener la información");
            }
            
        });

       
    });
});


  
