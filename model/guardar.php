<!-- PARA LOS KPI -->
<?php

include_once "conexion.php";

    if (empty($_POST["txtnombre"]) or empty($_POST["txttipo"])  or empty($_POST["txtunidad"])){

        header('location: ../nuevokpi.php?mensaje="Error"');
        exit();

    }else{
                
        $area=$_POST["txtarea"];
        $nombre=strtoupper($_POST["txtnombre"]);
        $meta=$_POST["txtmeta"];
        $estado=$_POST["txtestado"];
        $unidad=$_POST["txtunidad"];
        $fecharegistro=date('Y-m-d H:i:s');
        $tipo=$_POST["txttipo"];
        $accion=$_POST["txtaccion"];
        $formula = strtoupper($_POST["txtformula"]);
        $txtmetaango = $POST["TXTtxtmetaango"];

            
        switch($accion){
            // Guarda nuevo
            case "1":
                $sentencia="INSERT INTO indicadores (area,nombre,meta,metaango,estado,unidad,fecharegistro,tipo,fechamodificacion,formula) VALUES (?,?,?,?,?,?,?,?,?,?);";
                $consulta = $base_de_datos->prepare($sentencia);
                $resultado=$consulta->execute([$area,$nombre,$meta,$metaango,$estado,$unidad,$fecharegistro,$tipo,$fecharegistro,$formula]);
                
                break;

       
            //modifica existente
            case "2":
                $cod_kpi=$_POST["txtcod_kpi"];
                $sentencia="UPDATE indicadores SET area=?,nombre=?,meta=?,metaango=?,estado=?,unidad=?,fechamodificacion=?,tipo=?,formula=? WHERE cod_kpi  = ?;";
                $consulta = $base_de_datos->prepare($sentencia);
                $resultado=$consulta->execute([$area,$nombre,$meta,$metaango,$estado,$unidad,$fecharegistro,$tipo,$formula,$cod_kpi]);
                
                break;
        
        }


        //Valida el resultado del SQL

        if ($resultado === TRUE){
            header('location: ../nuevokpi.php?mensaje=Ok');
            exit();
        }else{
            header('location: ../nuevokpi.php?mensaje=Error');
            exit();
        } 
       

    }
?>