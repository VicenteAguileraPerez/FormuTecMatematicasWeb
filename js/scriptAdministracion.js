$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length == 0) {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html"

    }

});

document.getElementById("cerrar").addEventListener("click", cerrarSesion);
function cerrarSesion() {
    clearCookie();
    if (getCookie().length == 0) {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html";
    }
}


document.getElementById("editarB").addEventListener("click", ventanaEditar);
function ventanaEditar() {
    if (getCookie().length > 0) {
        var datos = JSON.parse(atob(getCookie()));
        document.getElementById("nombre").value = datos['nombre'];
        document.getElementById("email").value = datos['email'];
    }
    else {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html";
    }
}
//update data
$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length > 0) {
        $("#editar").click(function () {
            var datos = JSON.parse(atob(getCookie()));
            var id = datos['id'];
            var nombre = document.getElementById("nombre").value;
            var email = document.getElementById("email").value;
            var emailant = datos['email'];
            var passant = document.getElementById("paswordant1").value;
            var mensaje = $("#message");
            if (nombre != '' && email != '' && passant != '') {
                var datosEnviar = JSON.stringify({ email: email, id: id, emailant: emailant, nombre: nombre, password: passant });
                $.ajax({
                    url: "http://localhost/FormuTecMatematicasWeb/public/v1/modificar/cliente",
                    type: "POST",
                    data: { email: email, id: id, emailant: emailant, nombre: nombre, password: passant },
                    success: function (respuesta) {
                        console.log(JSON.stringify(respuesta));
                        var json = respuesta;
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
                                    '<p>Datos actualizados correctamente</p>');
                                setCookie(btoa(JSON.stringify(json['success'])));
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
            }
            else {
                mensaje.empty();
                mensaje.css("color", "#DC3545");
                mensaje.append("Email, nombre o contraseña están vacíos");
            }

        });
    }
    else {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html"
    }
});
//actualizar contraseña
$(document).ready(function () {

    if (getCookie().length > 0) {
        $("#cambiar").click(function () {
            var datos = JSON.parse(atob(getCookie()));
            var id = datos['id'];
            var email = datos['email'];
            var passant = document.getElementById("paswordant2").value;
            var pass1 = document.getElementById("paswordnue1").value;
            var pass2 = document.getElementById("paswordnue2").value;
            var mensaje = $("#messagecambiar");
            if (pass1 != '' && pass2 != '' && passant != '') {
                if (pass1 === pass2) {
                    var datosEnviar = JSON.stringify({ email: email, id: id, passwordant: passant, password: pass1 });
                    //alert(datosEnviar);

                    $.ajax({
                        url: "http://localhost/FormuTecMatematicasWeb/public/v1/modificar/contrasena",
                        type: "POST",
                        data: { email: email, id: id, passwordant: passant, password: pass1 },
                        success: function (respuesta) {
                            console.log(JSON.stringify(respuesta));
                            var json = respuesta;
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
                                        '<p>Datos actualizados correctamente, reinicia sesión</p>');
                                    clearCookie();
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

                }
                else {
                    mensaje.empty();
                    mensaje.css("color", "#DC3545");
                    mensaje.append("El password nuevo y su confirnación son diferentes");
                    document.getElementById("paswordnue1").value = "";
                    document.getElementById("paswordnue2").value = "";
                }


            }
            else {
                mensaje.empty();
                mensaje.css("color", "#DC3545");
                mensaje.append("Algunos campos están vacíos");
            }

        });
    }
    else {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html"
    }
});
