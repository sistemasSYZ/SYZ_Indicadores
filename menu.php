<link rel="icon" href="img/syz.png">
<?php 
    include 'template/header.php';
    include_once "model/conexion2.php";
    include_once "model/conexion.php";
    session_start();
    
    $usuario = $_SESSION['usuario'];

    if (empty($usuario)){
        header('location: ../Login/partials/logout.php');
        exit();
    } 

    $sql = "SELECT area FROM users WHERE email='$usuario'";
    $consult = pg_query($sql);
    $fila = pg_fetch_array($consult);
    $area = $fila[0];


    $conexion = new conexion;
    $textsentencia="SELECT distinct a.* from indicadores a inner join registrokpi b on a.cod_kpi = b.cod_kpi where a.estado='ACTIVO' order by a.area,a.tipo,a.nombre";
    $resultado = $conexion->obtenerDatos($textsentencia);      
               
?>

<div class="container py-2">
    
    <h2> 
        <?php
            echo "Bienvenido al registro de indicadores (KPI) del area " .$area
        ?>
    </h2>
</div>

<div class="container table-responsive" style="height: 450px">

    <div class="col-md-8">

        <H3 style = "margin-top:20px; margin-bottom:30px;">Listado de indicadores SYZ</H3>

        <table id="example" class="table table-striped table-hover" style="font-size: 10px">

        <thead class="table-dark">

            <tr class="text-center">

                <th hidden scope="col">ID</th>
                <th scope="col">AREA</th>
                <th scope="col">TIPO</th>
                <th scope="col">NOMBRE KPI</th>
                <th scope="col">META MENSUAL</th>
                <th scope="col">UNIDAD</th>
                <th scope="col">F Registro</th>
                <th scope="col">GRAFICAS</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($resultado as $dato){
            ?>
            <tr class="trhover text-center">
                <th hidden><?php echo $dato->cod_kpi; ?> </th>
                <td><?php echo $dato->area; ?></td>
                <td><?php echo $dato->tipo; ?></td>
                <td><?php echo $dato->nombre; ?></td>
                <td><?php echo $dato->meta; ?></td>
                <td><?php echo $dato->unidad; ?></td>
                <td><?php echo $dato->fecharegistro; ?></td>
                <td> <a href="graficas/grafica1.php?codigo=<?php echo $dato->cod_kpi;?>" class="btn btn-info"> Graficar </a> </td>
            </tr>
                
            <?php
                }
            ?>
            
        </tbody>
        </table>
        <button id="btn1"> clon </button>

    </div>
</div>

<?php include 'template/footer.php' ?>
