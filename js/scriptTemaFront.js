var id;
var url;
var nombreAnt;
function showTema(dataRow) 
{
    try {
        console.log(JSON.stringify(dataRow));
        console.log(JSON.stringify(json['success']));
        for (let [key, value] of Object.entries(json['success'])) 
        {
            if(value['id']==dataRow)
            {
                id=value['id'];
                document.getElementById('nombreeli').value=value['nombre'];
                document.getElementById('descripcioneli').value=value['descripcion'];
                console.log(JSON.stringify(value['nombre']));
                url=value['imagen'];
                document.getElementById('imagen').src=value['imagen'];
                break;
            }
        }
        
      } catch (error) {
        
        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
      }
    
}
function showTemaEditar(dataRow) 
{
    try {
        console.log(JSON.stringify(dataRow));
        console.log(JSON.stringify(json['success']));
        for (let [key, value] of Object.entries(json['success'])) 
        {
            if(value['id']==dataRow)
            {
                id=value['id'];
                document.getElementById('nombreedit').value=value['nombre'];
                document.getElementById('descripcionedit').value=value['descripcion'];
                nombreAnt=value['nombre'];
                console.log(JSON.stringify(value['nombre']));
                url=value['imagen'];
                document.getElementById('imagenedit').src=value['imagen'];
                break;
            }
        }
        
      } catch (error) {
        
        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
      }
    
}
