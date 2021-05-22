

$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

  $.ajax({
    'url': "http://localhost/FormuTecMatematicasWeb/public/v1/temas/front",
    'method': "GET",
    'contentType': 'application/json',
    success: function (data) {

      var imagen, descripcion, titulo;
      var topic = "";
      $.each(data['success'], function (i, item) {
        imagen = data['success'][i]['imagen'];
        descripcion = data['success'][i]['descripcion'];
        titulo = data['success'][i]['nombre']
        topic += `
                      <article class="card card_hover">
                        <a href="#">
                          <picture class="thumbnail">
                              <img class="img" src="${imagen}"
                                  alt="icono de tema">
                          </picture>
                          <div class="card-content">

                              <h2>${titulo}</h2>
                              <p>${descripcion}</p>
                          </div>
                        </a>
                      </article>
                    `;
      });
      $('#cards').append(topic);
    },

    error: function (msg) {

      alert("No está disponible el servidor");
    }
  });

});