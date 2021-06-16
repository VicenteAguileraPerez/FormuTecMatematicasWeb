var id;
var idTemaActual;
var url;
var nombreAnt;
function showSubtema(idSubTema) {
    try {
        console.log(JSON.stringify(idSubTema));
        console.log(JSON.stringify(json['success']));
        for (let [key, value] of Object.entries(json['success'])) {
            if (value['id'] == idSubTema) {
                id = value['id'];
                document.getElementById('nombreeli').value = value['nombre'];
                document.getElementById('temaeli').value = searchTema(parseInt(value['idTema']));
                console.log(JSON.stringify(value['nombre']));
                url = value['pdf'];
                break;
            }
        }

    } catch (error) {

        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
    }

}
function searchTema(id) {
    for (let [key, value] of Object.entries(jsonTemas['success'])) {
        if (value['id'] == id) {
            return value['nombre'];
        }
    }
}
function showSubtemaEditar(idSubTema) {
    try {
        console.log(JSON.stringify(idSubTema));
        console.log(JSON.stringify(json['success']));

        for (let [key, value] of Object.entries(json['success'])) {
            if (value['id'] === idSubTema) {
                id = value['id'];
                document.getElementById('nombreedit').value = value['nombre'];
                document.getElementById("temasselectededit").innerHTML = fillSelection();
                //$('#temasselectededit').val(value['idTema']);
                document.querySelector('#temasselectededit').value = value['idTema'];
                nombreAnt = value['nombre'];
                idTemaActual = value['idTema'];
                // alert(JSON.stringify(value['nombre']));
                url = value['pdf'];
                break;
            }
        }

    } catch (error) {

        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
    }

}
function fillSelection() {
    var HTML = '';
    for (let [key, value] of Object.entries(jsonTemas['success'])) {
        HTML += '<option value="' + value['id'] + '">' + value['nombre'] + '</option>';
    }
    return HTML;
}

