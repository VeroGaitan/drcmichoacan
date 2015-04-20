<?php
ini_set('max_execution_time', 3000); //300 seconds = 5 minutes
require_once('../../class/mysqli.class.php');
$consulta = new conexionmysqli();
$oficialias = $consulta->query("SELECT distinct(clave) as clave,of_municipio,of_localidad from  nacimientos.oficialia;");

//echo "<pre>";
//var_dump($oficialias->fetch_all());
//echo "</pre>";

echo "<table cellpadding='1' cellspacing='1' border='1'>";
while ($fila = $oficialias->fetch_assoc()) {
      echo "<tr><td>CLAVE</td>";
            echo "<td COLSPAN='3'>MUNICIPIO</td>";
            echo "<td COLSPAN='3'>LOCALIDAD</td></tr>";
           
               
       echo "<tr><td> {$fila['clave']} </td>";
            echo "<td COLSPAN='3'>{$fila['of_municipio']}</td>";
            echo "<td COLSPAN='3'>{$fila['of_localidad']}</td></tr>";
               
    
echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
             echo "<tr>";
            echo "<td>AÑO</td>";
            echo "<td>TOMO</td>";
            echo "<td>ACTA INICIAL</td>";
            echo "<td>ACTA FINAL</td>";
            echo "<td>CAPTURADOS</td>";
            echo "<td>POR CAPTURAR</td>";
            echo "<td>OBSERVACIONES</td>";
            echo "</tr>";
    for ($i = 1990; $i <= 2015; $i++) {
       
        $sql = "(SELECT lpad(np.mun_ofi,3,'0') as municipio,lpad(np.oficialia,2,'0') as oficialia,ano,tomo,min(acta) as acta_inicial,max(acta) as acta_final,count(*) as total FROM registro_civil_dbo.nacimiento_pc np
where ano='{$i}' and mun_ofi=left('{$fila["clave"]}',3) and oficialia=right('{$fila["clave"]}',2)
group by mun_ofi,np.oficialia,ano,tomo)
union distinct
(SELECT munoficn  as municipio,oficialn as oficialia,anorn,tomon as tomo,min(actan) as acta_inicial,max(actan) as acta_final,count(*) as total FROM nacimientos.nacimientos c
where anorn='{$i}' and munoficn=left('{$fila["clave"]}',3) and oficialn=right('{$fila["clave"]}',2)
group by munoficn,oficialn,anorn,tomon);"; //OJO separa las consultas por ;         
        //$sql = "SELECT * FROM registro_civil_dbo.nacimiento_pc c where ano='1990' limit 1;"; 
        // $sql .= "SELECT {$i};";

        $result = $consulta->query($sql);
    
        
        //var_dump($result->fetch_assoc());
        $total = $result->num_rows;
        if ($total == 0) {
            echo "<tr>";         
            echo "<td>$i</td>";
            echo "<td>.</td>";
            echo "<td>.</td>";
            echo "<td>.</td>";
             echo "<td>.</td>";
            echo "<td>.</td>";
            echo "<td>.</td>";
            echo "</tr>"; 
        } else {
            while ($libro= $result->fetch_assoc()) {
            echo "<tr>";
//            echo "<td> {$fila['clave']}</td>";
//            echo "<td>{$fila['of_municipio']}</td>";
//            echo "<td>{$fila['of_localidad']}</td>";
            
            $porcapturar=($libro['total'])-(($libro['acta_final'])-($libro['acta_inicial'])+(1));
            $porcapturar=$porcapturar*(-1);
            echo "<td>  $i</td>";
            echo "<td>{$libro['tomo']}</td>";
            echo "<td>{$libro['acta_inicial']}</td>";
            echo "<td>{$libro['acta_final']}</td>";
             echo "<td>{$libro['total']}</td>";            
            echo "<td>{$porcapturar}</td>";
              echo "<td>.</td>";
     
            
            echo "</tr>";                                
            }
        }
        $result->free();
        
    }
}
echo "<table>";


//if (!$consulta->multi_query($sql)) {
//    echo "Fallo la multiconsulta: " . $consulta->errno . " - " . $consulta->error;
//}
//
//do {
//    if ($resultado = $consulta->store_result()) {
//        var_dump($resultado->fetch_all(MYSQLI_ASSOC));
//        $resultado->free();
//    }
//} while ($consulta->more_results() && $consulta->next_result());
//
//
//
//
//while ($_oficialias) {
//
//    
//        $consulta = new conexionmysqli();
//        $libros = $consulta->query($sql);
//        
//    if (ISSET($libros)) {
//            echo "EXISTE LIBRO EN {$_oficialias["clave"]} AÑO {$i}";
//            echo "<br>";
//        } else {
//            echo "LIBRO LOCALIZADO  EN {$_oficialias["clave"]} AÑO {$i}";
//            echo "<br>";
//        }
//print_r($combooficialias);
?>


