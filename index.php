<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indicadores SYZ</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    
</head>
<body>
    <div class="container-fluid bg-danger">
        <div class="row">
            <div class="col-8">
                <header class="py-2 text-center"> 
                    <H1 class="text-light">INDICADORES DE GESTION SYZ</H1>
                </header>
            </div>
                       
        </div>
    </div>

    <div class="container py-2">
        <form class="p-2" method="post" action="model/login.php">
        
            <div class="container py-3">
                <select class="form-select" aria-label="Default select example" name="txtcampo">
                    <option selected>Seleccione usuario a ingresar</option>
                    <option value="ADMINISTRATIVA">ADMINISTRATIVO</option>
                    <option value="COMERCIAL">COMERCIAL</option>
                    <option value="FINANCIERA">FINANCIERA </option>
                    <option value="INNOVACION">INNOVACION </option>
                    <option value="LOGISTICA">LOGISTICA </option>   
                    <option value="TECNICA">TECNICA </option>
                    <option value="TIC">TIC </option>
                    <option value="PRESIDENCIA">PRESIDENCIA </option>
                </select>
                <br>
                <input type="text" class="form-control py-2" name="txtcontraseña" placeholder="Digite su contraseña">
            </div><br>
                
            <input type="submit" name="Consultar" class="btn btn-primary" value="Ingresar">
            <br>
            <br>
                       

            <?php
                If (isset($_GET['mensaje']) and $_GET['mensaje'] == 'Error'){
            ?>
            
                <div class="alert alert-danger alert-dismissible fade show py-3" role="alert">
                    <strong>Alerta!</strong> Su contraseña o Usuario no son validos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            
            <?php
                }
            
            ?>
            
            
        </form>
        
    </div>

<?php include 'template/footer.php' ?>