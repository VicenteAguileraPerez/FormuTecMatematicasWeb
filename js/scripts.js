
/**
 * Evaluar pass1=pass2
 */
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
            success: function (respuesta) {
                console.log(JSON.stringify(respuesta));
                var json = respuesta;
                var mensaje = $("#message");
                mensaje.css("color", "#DC3545");
                mensaje.css("padding-top", "0.5rem");
                if (!json['error']) {
                    if (json['message']) {
                        mensaje.empty();
                        mensaje.css("color", "#DC3545");
                        mensaje.append(json['message']);
                    }
                    else {
                        mensaje.empty();
                        mensaje.css("color", "#090979");
                        mensaje.append(
                            '<p>' + "Usuario Creado, redireccionando a Login..." + '</p>');
                        setTimeout(() => location.href = "http://localhost/Formutecmatematicasweb/paginas/login.html", 500);
                    }
                }
                else {
                    mensaje.empty();
                    mensaje.append(
                        '<p>' + "Error interno" + '</p>');
                }
            },
            error: function () {
                console.log("No se ha podido obtener la información");
            }
        });
    });
});

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if (getCookie().length > 0) {
        location.href = "http://localhost/Formutecmatematicasweb/paginas/administracion.html";

    }
    else {
        $("#login").click(function () {

            var email = $("#correo").val();
            var password = $("#contrasena").val();
            $.ajax({
                url: "http://localhost/FormuTecMatematicasWeb/public/v1/iniciarsesion",
                type: "POST",
                data: { email: email, password: password },
                success: function (respuesta) {
                    console.log(JSON.stringify(respuesta));
                    var json = respuesta;
                    var mensaje = $("#message");
                    mensaje.css("color", "#DC3545");
                    mensaje.css("padding-top", "0.5rem");
                    if (!json['error']) {
                        if (json['message']) {
                            mensaje.empty();
                            mensaje.css("color", "#DC3545");
                            mensaje.append(json['message']);
                        }
                        else {
                            mensaje.empty();
                            mensaje.css("color", "#090979");
                            mensaje.append(
                                '<p>' + "Bienvenido " + json['name'] + '</p>');
                            setCookie(json['success']);
                            setTimeout(() => location.href = "http://localhost/Formutecmatematicasweb/paginas/administracion.html", 500);
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
    }
});