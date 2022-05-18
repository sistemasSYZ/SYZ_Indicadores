<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI SYZ</title>
    <link rel="icon" href="../img/syz.png">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<?php
session_start();
include_once "model/conexion3.php";
$usuario = $_SESSION['usuario'];
//Extraccion de BBDD
$sql= "SELECT * FROM users WHERE email='$usuario'";
$obj = pg_query($sql);
$fila = pg_fetch_array($obj);
$userName = $fila[2];
$userGender = $fila[6];
$userArea = $fila[11];
$userPermi = $fila[13];
$userId = $fila[12];

?>
    <header id="header">
        <?php
        if($userGender == "F"){
            echo "<h2 id='salute'><b>BIENVENIDA $userName</b></h2>";
        }else if ($userGender == "M"){
            echo "<h2 id='salute'><b>BIENVENIDO $userName</b></h2>";
        }

        ?>
        <img src="../Login/multimedia/logopng.png" id="img-hd">
        <a href="../Login/portales/gestor.php" id="logout"><p1 class='bx bx-log-out'></p1></a>
    </header> 
</head>
<body>
    <div style="border-top: 5px solid black; border-bottom: 5px solid black;top: 90; position: fixed; width: 100%; background-color: rgb(204 48 43)">
        <header class="mt-2 text-center"> 
            <H2 class="text-light">INDICADORES DE GESTION SYZ</H2>
                <div class="listsss">
                <li class="itemsss"><a class="linktopsss" href="menu.php">INICIO</a></li>
                <li class="itemsss"><a class="linktopsss" href="nuevokpi.php">Nuevo KPI</a></li>
                <li class="itemsss"><a class="linktopsss" href="registrarkpi.php">Registrar KPI</a></li>
                <!--<li class="itemsss"><a class="linktopsss" href="graficas/graficaarea.php">Graficas por Area</a></li>-->
                </div>
        </header>
    </div>
<body>

<style>
.listsss{
    position: fixed;
    top: 100;
    right: 10;
}

.itemsss{
    display: inline-block;
    list-style: none;
    text-align: right;
    font-weight: bold;
}

.itemsss, .linktopsss{
    color:black;
    text-decoration: none;
    padding: 10px;
    font-size: 16px;
    color: black;
}

.linktopsss:hover{
    color: white;
}
</style>
