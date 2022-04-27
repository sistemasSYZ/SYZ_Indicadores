<?php
    
    //Elimina los datos de la BD
    include_once "conexion.php";

    if (empty($_GET["codigo"])){

        header('location: ../registrarkpi.php?mensaje = Error');
        //exit();

    }else{

        $cod_id1=$_GET["codigo"];
        $consulta = $base_de_datos->prepare("DELETE FROM registrokpi WHERE cod_registro = ?;");
        $resultado=$consulta->execute([$cod_id1]);
        //printf($sentencia);
        
        if ($resultado === TRUE){
            header('location: ../registrarkpi.php?mensaje=Eliminar');
            exit();
        }else{
            header('location: ../registrarkpi.php?mensaje=Error');
            exit();
        }
    }
?>
                