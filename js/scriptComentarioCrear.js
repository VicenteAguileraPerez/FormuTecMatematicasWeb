$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    var motivo;
    $("input[name=opcion]").change(function () {
        motivo = $(this).val();
        console.log(motivo);
    });
    $("#enviar").click(function () {
        var nombre = $("#nombre").val();
        var email = $("#email").val();
        var mensaje = $("#mensaje").val();
        if (motivo === undefined) {
            motivo = "";
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
                if (!json['error']) {
                    if (json['message']) {
                        mensaje.empty();
                        mensaje.css("color", "#DC3545");
                        mensaje.append(json['message']);
                    }

                    else {
                        mensaje.empty();
                        alert(json["success"]);
                        setTimeout(() => location.href = "http://localhost/FormutecmatematicasWeb/index.html", 500);
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