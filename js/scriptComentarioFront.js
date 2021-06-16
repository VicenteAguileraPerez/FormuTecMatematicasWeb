
var id;
var motivo;
function showData(dataRow) {
  try {
    console.log(JSON.stringify(dataRow));
    console.log(JSON.stringify(json['success']));
    for (let [key, value] of Object.entries(json['success'])) {
      if (value['id'] == dataRow) {
        id = value['id'];
        document.getElementById('nombres').value = value['nombre'];
        document.getElementById('email').value = value['email'];
        motivo = value['motivo'];
        document.getElementById('motivo').value = (motivo === 1) ? "Queja" : "Sugerencia";
        document.getElementById('mensaje').value = value['mensaje'];
        console.log(`${key}: ${value['id'] == dataRow}`);
        break;
      }
    }

  } catch (error) {

    // expected output: ReferenceError: nonExistentFunction is not defined
    // Note - error messages will vary depending on browser
  }

}