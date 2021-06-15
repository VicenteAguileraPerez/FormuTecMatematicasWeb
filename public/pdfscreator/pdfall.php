<?php
 require 'fpdf/fpdf.php';
 require 'connection.php';
 
    date_default_timezone_set('America/Mexico_City'); //Configuramos el horario de acuerdo a la ubicación del servidor
    class PDF extends FPDF
    {
        function Header() {        
            //$this->Image('img/logo.png', 12, 12, 25); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
            
            $ancho = 270;
            $this->SetFont('Arial', 'B', 6);
             
            if($this->pagina == 1){ //Cuando el archivo está en Horizontal
                $horizontal = 85; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
                $this->SetY(12);
                $this->Cell($ancho + $horizontal, 10,'FormuTec TecNM campus Uruapan', 0, 0, 'R');
                $this->SetY(15);
                $this->Cell($ancho + $horizontal, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
                $this->SetY(18);
                $this->Cell($ancho + $horizontal, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
            } else {            
                $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
                $this->Cell($ancho, 10,'FormuTec TecNM campus Uruapan', 0, 0, 'R');
                $this->SetY(15);
                $this->Cell($ancho, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
                $this->SetY(18);
                $this->Cell($ancho, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
            } 
            $this->Ln();   

        }
        // Load data
        function LoadData($id)
        {
            // Read file lines
            $servername = "localhost";
            $database = "formutec";
            $username = "root";
            $password = "";
            // Create connection
            $conn =new db($servername, $username, $password, $database);

           if($id==0)
           {
                $sql = "Select * from comentarios";//"SELECT * FROM encuesta WHERE idencuesta =". $id;
           }
           else
           {
            $sql = "Select * from comentarios where id=".$id;//"SELECT * FROM encuesta WHERE idencuesta =". $id;
           }
            if (!$result = $conn->connection->query($sql)) {
                die("There as a query error for some reason handle your query error 1");
            }
            $data = array();
            while($row =   $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        function Body() 
        {
            $yy = 20; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
            $y = $this->GetY(); 
            $x = 12;
           
            
            $this->SetFont('Arial', 'B', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
            $this->SetXY(0, $y + $yy); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
            $this->Cell(220, 10, "No Hay registros con ese id", 0, 1, 'C');
            $y = $this->GetY(); 
                     
        }
    
        // Colored table
        function FancyTable($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(0,123,255);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // Header
            $w = array(20, 60, 60, 25,100);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;

            
            for ($i=0;$i<count($data);$i++)
            {
            
                if($i==24)
                {
                    $this->AddPage();
                    // Colors, line width and bold font
                    $this->SetFillColor(0,123,255);
                    $this->SetTextColor(255);
                    $this->SetDrawColor(128,0,0);
                    $this->SetLineWidth(.3);
                    $this->SetFont('','B');
                    for($j=0;$j<count($header);$j++)
                         $this->Cell($w[$j],7,$header[$j],1,0,'C',true);
                        $this->Ln();
                    // Color and font restoration
                    $this->SetFillColor(224,235,255);
                    $this->SetTextColor(0);
                    $this->SetFont('');
                    // Data
                }
                $this->Cell($w[0],6,$data[$i]['id'],'LR',0,'L',$fill);
                $this->Cell($w[1],6,utf8_decode($data[$i]['nombre']),'LR',0,'L',$fill);
                $this->Cell($w[2],6,utf8_decode($data[$i]['email']),'LR',0,'R',$fill); 
                //$this->Cell($w[2],6,$data[$i]['password'],'LR',0,'R',$fill);
                //$this->Cell($w[2],6,"hola",'LR',0,'R',$fill);
                $motivo = $data[$i]['motivo']==1?"Queja":"Sugerencia";
                $this->Cell($w[3],6,$motivo,'LR',0,'R',$fill);
                $this->Cell($w[4],6,utf8_decode($data[$i]['mensaje']),'LR',0,'R',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        function Footer() 
        {        
            $this->SetY(-10);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo(), 0, 0, 'C');
            if($this->CurOrientation == 'L') { //Se reconoce el tipo de Orientación de la página (Vertical = P|Horizontal = L)
                $this->SetX(0);
                $this->Cell(292, 10, utf8_decode('Creado by FormuTec TecNM campus Uruapan'), 0, 0, 'R');            
            } else {       
                $this->SetX(0);
                $this->Cell(205, 10, utf8_decode('Creado by FormuTec TecNM campus Uruapan'), 0, 0, 'R');
                
            }
        }
    }

    $pdf = new PDF('L','mm','A4');
    // Column headings
    $header = array('Id', 'Nombre', 'email', 'motivo',"mensaje");

    $idPost=900;
    if(isset($_GET['id']))
    {
        //envidan id
        $id= $_GET['id'];
        $row = $pdf->LoadData($id);
    }
    else
    {
        $row = $pdf->LoadData(0);
    }
    
    // Data loading
    $pdf->pagina = 0;
    //var_dump($row);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    if(count($row)==0)
    {
        $pdf->Body();
    }
    else{
        $pdf->FancyTable($header,$row);
    }    
    $pdf->Output();
?>