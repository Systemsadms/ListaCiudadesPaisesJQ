<?php
/**
 * Codigo que muestra como recargar el desplegable (<select>) de poblaciones
 * utilizando AJAX con jquery, dependiendo del pais seleccionado
 */
include("selects_db.php");

if(isset($_POST["pais"]) && isset($_POST["ciudad"]))
{
    # aqui gestionariamos los valores del formulario
    echo "OK";
}
?>

<!DOCTYPE html>
<html>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="selects.js"></script>
    <link href="selects.css" type="text/css" rel="stylesheet">
<head>

</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" id="form1">
        <div class="error"></div>
        <div>
            <span>Pa&iacute;s</span>
            <select name="pais" id="pais">
                <option value='0'>Selecciona un pais</option>
                <?php
                # llenamos los valores del pais de la base de datos
                $sql="SELECT * FROM Paises ORDER BY Pais";
                foreach($dbh->query($sql) as $row)
                {
                    echo "<option value='".$row["Codigo"]."'>".$row["Pais"]."</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <span>Ciudad</span>
            <select name="ciudad" id="ciudad" disabled>
            </select>
        </div>
        
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>
