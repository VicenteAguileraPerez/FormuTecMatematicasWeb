$(document).ready(function () {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

    //if(getCookie().length>0)
    //{
    $("#obtenerAll").click(function () {
        location.href = "http://localhost/FormutecMatematicasWeb/public/pdfscreator/pdfall.php";
    });
    $("#obtenerID").click(function () {
        var id = document.getElementById("id").value;
        if (id == undefined || id == null || id == "") {
            alert("Ingrese un id en el campo id")
        }
        else {
            location.href = "http://localhost/FormutecMatematicasWeb/public/pdfscreator/pdfall.php?id=" + id;
        }

    });
    //}
    //else{
    //    location.href = "http://localhost/FormutecMatematicasWeb/paginas/login.html" 
    //}
});