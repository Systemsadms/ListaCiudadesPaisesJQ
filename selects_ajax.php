<?php
/**
 * Codigo encargado de devolver el listado de poblaciones segun el pais
 * recibido por post...
 * Devuelve mediante json el codigo html del <select> de la ciudad
 */

include("selects_db.php");

$result=0;
$contenido="";

if($_POST["pais"])
{
    # se ha recibido el pais
    
    # comprobamos que exista dicho pais en la base de datos
    $sql="SELECT * FROM Paises WHERE Codigo=?";
    $params=array($_POST["pais"]);
    $db=$dbh->prepare($sql);
    $db->execute($params);
    if($db->rowCount()==1)
    {
        # existe el pais... vamos a bucar las ciudades...
        $sql="SELECT * FROM Ciudades WHERE Paises_Codigo=? ORDER BY Ciudad";
        $params=array($_POST["pais"]);
        $db=$dbh->prepare($sql);
        $db->execute($params);
        if($db->rowCount()>0)
        {
            $result=1;
            # creamos el contenido del select con todos los paises
            $contenido.="<option value='0'>Selecciona una ciudad</option>";
            foreach($db->fetchAll() as $row)
            {
                $contenido.="<option value='".$row["idCiudades"]."'>".$row["Ciudad"]."</option>";
            }
        }
    }
}else{
    $contenido.="<option value='0'></option>";
}

echo json_encode(
    array(  "result"=>$result,
            "contenido"=>utf8_encode($contenido)
         )
);
?>
