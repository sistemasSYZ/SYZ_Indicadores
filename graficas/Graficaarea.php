<?php
    session_start();
    require_once "../model/conexion2.php";
    $conexion = new conexion;
  
    $area = $_SESSION["area"];
    if (empty($area)){
        header('location: ../index');
        exit();
    }       

    
    If (isset($_POST["txtaccion"])){

        $gestion = $_POST["txtcampo"];
        echo "Esta es la variable de la ghestion = ".$gestion;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graficas KPI</title>
    <link rel="icon" href="../img/syz.png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

        <div class="container-fluid bg-danger" style = "margin-top:20px; margin-bottom:10px; margin-left:40px;">
            <h2> Graficas de los KPI de SYZ </h2>            
        </div>
        <div class="col-md-2" style = "margin-top:20px; margin-bottom:10px; margin-left:40px;">
            
        <form class="row g-3" method="POST" action="graficaarea.php">

            <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="1" >
            <select class="form-select" aria-label="Default select example" name="txtcampo">
                    <option selected>Seleccione Gestion a Graficar</option>
                    <option value="ADMINISTRATIVA">ADMINISTRATIVO</option>
                    <option value="COMERCIAL">COMERCIAL</option>
                    <option value="FINANCIERA">FINANCIERA </option>
                    <option value="INNOVACION">INNOVACION </option>
                    <option value="LOGISTICA">LOGISTICA </option>   
                    <option value="TECNICA">TECNICA </option>
                    <option value="TIC">TIC </option>                    
            </select>
            <div>
                <button class="btn btn-secondary" type="submit">Graficar</button>
                <a href="../menu.php" class="btn btn-info">Regresar al Menu</a>
            </div>
        </form>

        </div>                
   
    <div class="container" style="width: 90%;">
        <div class="row">
                
            <div class="col-md-2">
                <canvas id="myChart" ></canvas>
            </div>
            <div class="col-md-2">
                <canvas id="myChart2"></canvas>
            </div>
           
            <br>
            <br>
            <hr size=10 noshade="noshade" style = "margin-top:10px;">
            <br>
        
            <div class="col-md-2">
                <canvas id="myChart3" ></canvas>
            </div>
            <div class="col-md-2">
                <canvas id="myChart4" ></canvas>
            </div>

        </div>
    </div>
   

    <!-- 
        height="450" width="600"
        style="width: 45%;"
        style = "margin-top:50px; margin-bottom:80px; margin-left:40px;"
    -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // GRAFICA EN BARRAS POR PERIODO

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                         $textsentencia="select distinct mes from registrokpi order by mes";
                         $resultado = $conexion->obtenerDatos($textsentencia);
                         foreach($resultado as $dato) {
                             
                            $mes = $conexion->obtenerMes($dato->mes)
                    ?>
                    '<?php echo $mes; ?>',
                    <?php
                         }
                    ?>
                    
                ],
                datasets: [
                    {
                        label: 'Meta',
                        data: [
                            <?php
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$gestion."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                                            
                            ?>
                                '<?php echo $dato->valor; ?>',
                            <?php
                                }
                            ?>


                        ],
                        backgroundColor: [
                            'rgba(204, 48, 43, 0.5)',
                        ],
                        borderColor: [
                            'rgba(0, 0, 0, 1)'
                        ],
                        borderWidth: 2
                    },
                    {
                        label: 'Resultado',
                        data: [
                            <?php
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='LOGRO' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                                            
                            ?>
                                '<?php echo $dato->valor; ?>',
                            <?php
                                }
                            ?>


                        ],
                        backgroundColor: [
                            'rgba(68, 68, 68, 0.5)',
                        ],
                        borderColor: [
                            'rgba(0, 0, 0, 1)'
                        ],
                        borderWidth: 2
                    },
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Grafico de barras por periodo'
                    }
                }
            }
        });

    </script>
</body>
</html>