<?php

   
    //Se traen los datos de conexion del config
    
    $direccion = dirname(__FILE__);
    $jsondata = file_get_contents($direccion."/"."config");
    $listado = json_decode($jsondata, true);
    foreach ($listado as $key => $value) {

        $rutaServidor = $value['server'];
        $usuario = $value['user'];
        $contraseña = $value['pasword'];
        $nombreBaseDeDatos = $value['database'];
        $puerto = $value['port'];
    }

    // se establece conexion a la BD.
    try {
        $base_de_datos = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Se conecto full: OK";
    } catch (Exception $e) {
        echo "Ocurrió un error con la base de datos: " . $e->getMessage();
    }

?>