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


    /*  clave='TIC*123456+' WHERE nom_usuario='TIC';
        clave='ADM*123456+' WHERE nom_usuario='ADMINISTRATIVA';
        clave='TEC*123456+' WHERE nom_usuario='TECNICA';
        clave='INN*123456+' WHERE nom_usuario='INNOVACION';
        clave='COM*123456+' WHERE nom_usuario='COMERCIAL';
        clave='LOG*123456+' WHERE nom_usuario='LOGISTICA';
        clave='FIN*123456+' WHERE nom_usuario='FINANCIERA';

    */
?>