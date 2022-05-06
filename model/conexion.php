<?php
$conexion = "host='mydbsyzinstance.c38sbdell0f1.us-east-2.rds.amazonaws.com' port='5432' dbname='usuarios' user='postgres' password='-s46Hs..'";
$validar = pg_connect($conexion);

  /* 
    //Se traen los datos de conexion del config
    
    $direccion = dirname(__FILE__);
    $jsondata = file_get_contents($direccion."/"."config2");
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
*/
?>