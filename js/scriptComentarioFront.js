
var id;
function showData(dataRow) 
{
    try {
        console.log(JSON.stringify(dataRow));
        console.log(JSON.stringify(json['success']));
        for (let [key, value] of Object.entries(json['success'])) 
        {
            if(value['id']==dataRow)
            {
                id=value['id'];
                document.getElementById('nombres').value=value['nombre'];
                document.getElementById('email').value=value['email'];
                document.getElementById('motivo').value=value['motivo'];
                document.getElementById('mensaje').value=value['mensaje'];
                console.log(`${key}: ${value['id']==dataRow}`);
                break;
            }
        }
        /*
         if(value['id']==id)
           {
               
                break;
           }
        for (var key in json['success']) {
            
                console.log(JSON.stringify(data[key]));
                if(data[key].id==dataRow)
                {
                    document.getElementById(nombres).value=data[key].nombre;
                   
                    break;
                }  
            }
        }*/
        
      } catch (error) {
        
        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
      }
    
}