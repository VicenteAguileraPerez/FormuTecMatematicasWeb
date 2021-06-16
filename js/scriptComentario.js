
var json;
$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length > 0) {
        $.ajax({
            'url': "http://localhost/FormuTecMatematicasWeb/public/v1/vercomentarios",
            'method': "GET",
            headers: { 'Authorization': getCookie() },
            'contentType': 'application/json',
            success: function (data) {
                if (data['no_authorized']) {
                    alert(data['no_authorized']);
                    clearCookie();
                    setTimeout(() => location.href = "http://localhost/FormutecmatematicasWeb/login.html", 500);
                }
                else {
                    var trHTML = '<tbody>';
                    json = data;
                    $.each(data['success'], function (i, item) {
                        var motivo = data['success'][i]['motivo'] === 1 ? "Queja" : "Sugerencia";
                        id = parseInt(data['success'][i]['id']);
                        trHTML += '<tr scope="row"><td>' + data['success'][i]['id'] + '</td><td>' + data['success'][i]['nombre'] + '</td><td>' + data['success'][i]['email'] + '</td><td>' + data['success'][i]['mensaje'] + '</td><td>' + motivo + '</td><td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showData(' + id + ')">Ver</button></td></tr>';
                    });
                    $('#comments').append(trHTML + "</tbody>");
                }



            },

            error: function (msg) {

                alert(msg.responseText);
            }
        });
    }
    else {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html"
    }


});


$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if (getCookie().length > 0) {
        $("#eliminar").click(function () {

            $.ajax(
                {
                    'url': "http://localhost/FormuTecMatematicasWeb/public/v1/eliminarcomentario/" + id,
                    'method': "DELETE",
                    headers: { 'Authorization': getCookie() },
                    'contentType': 'application/json',
                    success: function (respuesta) {
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
                            else if (json['no_authorized']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['no_authorized']);
                                clearCookie();
                                setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/login.html", 500);
                            }
                            else {
                                mensaje.empty();
                                console.log(respuesta);
                                setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/comentarios.html", 500);
                            }
                        }
                        else {
                            mensaje.empty();
                            mensaje.append(
                                '<p>' + "Error interno" + '</p>');
                        }
                    },
                    error: function (resultado) {

                    }
                });
        });
    }
    else {
        location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html"
    }
});

