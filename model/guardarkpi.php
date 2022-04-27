<!-- PARA LOS REGISTRO DE LOS KPI -->
<?php

include_once "conexion.php";

    if (empty($_POST["txtcod_kpi"]) or empty($_POST["txtvalor"])  or empty($_POST["txttipo"])){

        header('location: ../registrarkpi.php?mensaje="Error"');
        exit();

    }else{
                
        $cod_kpi=$_POST["txtcod_kpi"];
        $mes=$_POST["txtmes"];
        $agno=$_POST["txtyear"];
        $valor=$_POST["txtvalor"];
        $tiporegistro=$_POST["txttipo"];
        $fecharegistro=date('Y-m-d H:i:s');
        $accion=$_POST["txtaccion"];

            
        switch($accion){
            // Guarda nuevo
            case "1":
                $sentencia="INSERT INTO registrokpi (cod_kpi,mes,ango,valor,tiporegistro,fecharegistro,fechamodificacion) VALUES (?,?,?,?,?,?,?);";
                $consulta = $base_de_datos->prepare($sentencia);
                $resultado=$consulta->execute([$cod_kpi,$mes,$agno,$valor,$tiporegistro,$fecharegistro,$fecharegistro]);
                
                break;

       
            //modifica existente
            case "2":
                $cod_registro = $_POST["txtcod_registro"];
                $sentencia="UPDATE registrokpi SET cod_kpi=?, mes=?,ango=?,valor=?,tiporegistro=?,fechamodificacion=? WHERE cod_registro  = ?;";
                $consulta = $base_de_datos->prepare($sentencia);
                $resultado=$consulta->execute([$cod_kpi,$mes,$agno,$valor,$tiporegistro,$fecharegistro,$cod_registro]);
                
                break;
            
            
        }


        //Valida el resultado del SQL

        if ($resultado === TRUE){
            header('location: ../registrarkpi.php?mensaje=Ok');
            exit();
        }else{
            header('location: ../registrarkpi.php?mensaje=Error');
            exit();
        } 
       

    }
?>