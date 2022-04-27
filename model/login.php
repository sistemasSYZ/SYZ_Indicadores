<?php

    require_once "conexion.php";
    session_start();

    // error_reporting(0);

    $usuario = $_POST['txtcampo'];
    $contraseña = $_POST['txtcontraseña'];
    $_SESSION["area"] = $usuario;


    
        $consulta = $base_de_datos->prepare("SELECT * FROM usuarios WHERE nom_usuario = ? and clave = ?;");
        $consulta->execute([$usuario, $contraseña]);
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

           
    
    if (!empty($resultado)){

            $_SESSION['usuario']= $usuario;
            header('location: ../menu.php');

    }else{

        session_destroy();
        header('location: ../index.php?mensaje=Error');
        
    } 


    /*  credenciales actuales
        insert into prueba values('COMERCIAL','COMER123CIAL');
        insert into prueba values('LOGISTICA','LOGIS987TICA');
        insert into prueba values('FINANCIERA','FINAN456CIERA');
        insert into prueba values('SOPORTE','SOPOR234TE');
        insert into prueba values('OTROS','OTROS123');
        insert into prueba values('ADMINISTRADOR','SYZADM1N');

    */
?>