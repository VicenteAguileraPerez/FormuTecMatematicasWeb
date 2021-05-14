/*$("#registrar").on("click", login);

function login(event) {
    event.preventDefault();
    var $form = $(this),
        url = $form.attr("action");
    data = $.post(url, {
        nombre: $("#nombre").val(),
        email: $("#correo").val(),
        password: $("#contrasena1").val()
    });
    console.log(data);
}
var data;*/

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#registrar").click(function () {
        var nombre = $("#nombre").val();
        var email = $("#correo").val();
        var password1 = $("#contrasena1").val();
        var password2 = $("#contrasena2").val();
        var data = { "nombre": nombre, "email": email, "password": password1 };
        //console.log(data);
        login(JSON.parse(data));
    });
});
function login(data) {
    $.ajax({
        type: "POST",
        url: "http://localhost/FormuTecMatematicasWeb/public/v1/registrarse",
        data: data,
        dataType: "json",
    }).done(function (data, textStatus, jqXHR) {
        if (console && console.log) {
            console.log("La solicitud se ha completado correctamente.");
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("Algo ha fallado: " + textStatus);
        }
    });
}

/*$(document).ready(function () {
    $("scripts").submit(function (event) {
        var formData = {
            nombre: $("#nombre").val(),
            email: $("#correo").val(),
            password: $("#contrasena1").val(),
        };
        $.ajax({
            type: "POST",
            url: "/localhost/FormuTecMatematicasWeb/public/v1/registrarse",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
        }).fail(function (data) {
            $("scripts").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
        });
        event.preventDefault();
    });
});*/