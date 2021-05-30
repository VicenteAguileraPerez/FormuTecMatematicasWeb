$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    var url = document.location.href,
    params = url.split('?')[1].split('&'),
    data = {}, tmp;
    for (var i = 0, l = params.length; i < l; i++) {
        tmp = params[i].split('=');
        data[tmp[0]] = tmp[1];
    }
    $('#titulo').append("<h1 class=\"texto-blanco text-align\">Áreas "+decodeURIComponent(data['tema'])+"</h1>");
    $.ajax({
      'url': "http://localhost/FormuTecMatematicasWeb/public/v1/subtemas/front/"+data['id'],
      'method': "GET",
      'contentType': 'application/json',
      success: function (data) {
        var pdf,  titulo;
        var topic = "";
        $.each(data['success'], function (i, item)
        {
          pdf =data['success'][i]['pdf']
          titulo = data['success'][i]['nombre']
          topic += `
                        <article class="card card_hover">
                          <a href="${pdf}">
                            <div class="card-content">
                                <h3>${titulo}</h3>
                            </div>
                          </a>
                        </article>
                      `;
        });
        $('#cards').append(topic);
      },
  
      error: function (msg) {
  
        alert("No está disponible el servidor se callo");
      }
    });
  
  });