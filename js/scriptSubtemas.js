$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if (getCookie().length > 0) {
        $("#agregar").click(function () {
            var nombre = $("#nombre").val();
            var idTema = $("#temasselected").val();
            console.log(idTema);
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file', files);

            var mensaje = $("#message");
            if (nombre) {
                if (idTema !== "-1") {
                    if (files) {
                        $.ajax({
                            url: "http://localhost/FormuTecMatematicasWeb/public/v1/subtema/" + nombre + "/" + idTema,
                            type: "POST",
                            headers: { 'Authorization': getCookie() },
                            data: fd,
                            contentType: false,
                            processData: false,
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
                                    else if (json['pdf_format']) {
                                        mensaje.empty();
                                        mensaje.css("color", "#DC3545");
                                        mensaje.append(json['pdf_format']);
                                    }
                                    else if (json['big_pdf']) {
                                        mensaje.empty();
                                        mensaje.css("color", "#DC3545");
                                        mensaje.append(json['big_pdf']);
                                    }
                                    else if (json['no_authorized']) {
                                        mensaje.empty();
                                        mensaje.css("color", "#DC3545");
                                        mensaje.append(json['no_authorized']);
                                        clearCookie();
                                        setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html", 500);
                                    }
                                    else {
                                        mensaje.empty();
                                        mensaje.css("color", "#090979");
                                        mensaje.append(json["success"]);
                                        setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerSubtema.html", 500);

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
                    else {
                        mensaje.empty();
                        mensaje.css("color", "#DC3545");
                        mensaje.append("Seleccione un archivo");
                    }
                }
                else {
                    mensaje.empty();
                    mensaje.css("color", "#DC3545");
                    mensaje.append("Seleccione un Tema");
                }
            }
            else {
                mensaje.empty();
                mensaje.css("color", "#DC3545");
                mensaje.append("Introduce el nombre del subtema");
            }

        });
    }
    else {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }

});

var jsonTemas;
$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length > 0) {
        $.ajax({
            'url': "http://localhost/FormuTecMatematicasWeb/public/v1/temas",
            'method': "GET",
            headers: { 'Authorization': getCookie() },
            'contentType': 'application/json',
            success: function (data) {

                if (data['no_authorized']) {
                    alert(data['no_authorized']);
                    clearCookie();
                    setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/login.html", 500);
                }
                else {
                    jsonTemas = data;
                    var HTML = '<option value="-1">Seleccione el tema al que pertenece</option>';
                    $.each(data['success'], function (i, item) {
                        id = parseInt(data['success'][i]['id']);
                        HTML += '<option value="' + id + '">' + data['success'][i]['nombre'] + '</option>'
                    });
                    $('#temasselected').append(HTML);
                }



            },

            error: function (msg) {

                alert(msg.responseText);
            }
        });
    }
    else {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }


});
var json;
$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length > 0) {
        $.ajax({
            'url': "http://localhost/FormuTecMatematicasWeb/public/v1/subtemas",
            'method': "GET",
            headers: { 'Authorization': getCookie() },
            'contentType': 'application/json',
            success: function (data) {
                if (data['no_authorized']) {
                    alert(data['no_authorized']);
                    clearCookie();
                    setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/login.html", 500);
                }
                else {
                    var trHTML = '<tbody>';
                    json = data;
                    $.each(data['success'], function (i, item) {

                        id = parseInt(data['success'][i]['id']);
                        pdf = data['success'][i]['pdf'];
                        idTema = parseInt(data['success'][i]['idTema']);
                        trHTML += '<tr scope="row"><td>' + data['success'][i]['id'] + '</td><td>' + data['success'][i]['nombre'] + '</td><td><img width="85px" height="100px" src="../assets/imgs/file_pdf.png" ></td><td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" onclick="showSubtema(' + id + ')">Eliminar</button></td><td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal" onclick="showSubtemaEditar(' + id + ')" >Editar</button></td></tr>';//
                    });
                    $('#temas').append(trHTML + "</tbody>");
                }



            },

            error: function (msg) {

                alert(msg.responseText);
            }
        });
    }
    else {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }


});

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    if (getCookie().length > 0) {
        $("#eliminar").click(function () {

            $.ajax(
                {
                    'url': "http://localhost/FormuTecMatematicasWeb/public/v1/subtema/" + id,
                    'method': "DELETE",
                    headers: { 'Authorization': getCookie() },
                    data: JSON.stringify({ url: url }),
                    'contentType': 'application/json',
                    success: function (respuesta) {
                        var json = respuesta;
                        var mensaje = $("#messageeli");
                        mensaje.css("color", "#DC3545");
                        mensaje.css("padding-top", "0.5rem");
                        if (!json['error']) {
                            if (json['message']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['message']);
                            }
                            else if (json['pdf_format']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['pdf_format']);
                            }
                            else if (json['big_pdf']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['big_pdf']);
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
                                setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerSubtema.html", 500);
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
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
});

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    if (getCookie().length > 0) {
        $("#editar").click(function () {
            var nombre = $("#nombreedit").val();
            var idTema = $("#temasselectededit").val();
            var fd = new FormData();
            var files = $('#fileedit')[0].files[0];
            fd.append('file', files);

            var mensaje = $("#messageedit");
            if (idTema === '-1') {
                idTema = idTemaActual;
            }
            // alert(nombre,idTema,id);

            $.ajax(
                {
                    'url': "http://localhost/FormuTecMatematicasWeb/public/v1/subtema/" + id + "/" + nombre + "/" + nombreAnt + "/" + idTema,
                    'method': "POST",
                    headers: { 'Authorization': getCookie() },
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        var json = respuesta;
                        console.log(json);
                        mensaje.css("color", "#DC3545");
                        mensaje.css("padding-top", "0.5rem");
                        if (!json['error']) {
                            if (json['message']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['message']);
                            }
                            else if (json['pdf_format']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['pdf_format']);
                            }
                            else if (json['big_pdf']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['big_pdf']);
                            }
                            else if (json['no_authorized']) {
                                mensaje.empty();
                                mensaje.css("color", "#DC3545");
                                mensaje.append(json['no_authorized']);
                                clearCookie();
                                setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html", 500);
                            }
                            else {
                                mensaje.empty();
                                mensaje.css("color", "#007BFF");
                                mensaje.append(json['success']);
                                setTimeout(() => location.href = "http://localhost/FormuTecMatematicasWeb/paginas/VerSubtema.html", 500);
                            }
                        }
                        else {
                            mensaje.empty();
                            mensaje.append(
                                '<p>' + "Error interno" + '</p>');
                        }
                    },
                    error: function (resultado, responseText) {
                        console.log(responseText);
                    }
                });

        });
    }
    else {
        location.href = "http://localhost/FormuTecMatematicasWeb/paginas/login.html"
    }
});