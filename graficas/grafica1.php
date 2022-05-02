<?php
    session_start();
    require_once "../model/conexion2.php";
    $conexion = new conexion;
  
    $area = $_SESSION["area"];
    if (empty($area)){
        header('location: ../index.php');
        exit();
    } 

    $codigo = $_GET["codigo"];
    $textsentencia="select * from indicadores where cod_kpi =".$codigo;
    $resultado = $conexion->obtenerDatos($textsentencia);
    foreach($resultado as $dato) {
        $nombrekpi = $dato->nombre;
        $unidadkpi = $dato->unidad;
        $area = $dato->area;
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

        <div class="col-md-8" style = "margin-top:20px; margin-bottom:10px; margin-left:40px;">
            <h2><?php echo " Grafica de KPI: ".$nombrekpi." del area: ".$area ?></h2>            
        </div>
        <div class="col-md-4" style = "margin-top:20px; margin-bottom:10px; margin-left:40px;">
            <a href="../menu.php" class="btn btn-info">Regresar al Menu</a>
        </div>                
   
    <div class="container" style="width: 85%;">
        <div class="row">
                
            <div class="col-md-6">
                <canvas id="myChart" ></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="myChart2"></canvas>
            </div>
           
            <br>
            <br>
            <hr size=10 noshade="noshade" style = "margin-top:10px;">
            <br>
        
            <div class="col-md-6">
                <canvas id="myChart3" ></canvas>
            </div>
            <div class="col-md-6">
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
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
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

        // SEGUNDA GRAFICA DE LINEAS

        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'line',
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
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                                            
                            ?>
                                <?php echo $dato->valor; ?>,
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
                                <?php echo $dato->valor; ?>,
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
                        text: 'Grafico de Lineas por periodo'
                    }
                }
            }
        });
        
        // VALIDA QUE EL INDICADOR SEA NUMERO O PESOS
        <?php
            if ($unidadkpi == "PESOS") {
        ?>

        // GRAFICA EN BARRAS ACUMULADO

        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const myChart3 = new Chart(ctx3, {
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
                                $acum=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum=$acum+$dato->valor;
                                                            
                            ?>
                                '<?php echo $acum; ?>',
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
                                $acum1=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='LOGRO' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum1=$acum1+$dato->valor;                        
                            ?>
                                '<?php echo $acum1; ?>',
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
                        text: 'Grafico de barras acumulado'
                    }
                }
            }
        });

        // SEGUNDA GRAFICA DE LINEAS ACUMULADO

        const ctx4 = document.getElementById('myChart4').getContext('2d');
        const myChart4 = new Chart(ctx4, {
            type: 'line',
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
                                $acum = 0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                   $acum=$acum+$dato->valor;
                            ?>
                                <?php echo $acum; ?>,
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
                                $acum4=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='LOGRO' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum4 = $acum4 + $dato->valor;                 
                            ?>
                                <?php echo $acum4; ?>,
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
                        text: 'Grafico de Lineas acumulado'
                    }
                }
            }
        });

        <?php } else { ?>
            
        // <!-- graficas de promedios -->

        // GRAFICA EN BARRAS ACUMULADO

        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const myChart3 = new Chart(ctx3, {
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
                                $acum=0;
                                $i=0;
                                $prom=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum=$acum+$dato->valor;
                                    $i=$i+1;
                                    $prom = $acum / $i;
                                                            
                            ?>
                                '<?php echo $prom; ?>',
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
                                $acum1=0;
                                $i=0;
                                $prom1=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='LOGRO' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum1=$acum1+$dato->valor;
                                    $i=$i+1;
                                    $prom1 = $acum1 / $i;                       
                            ?>
                                '<?php echo $prom1; ?>',
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
                        text: 'Grafico de barras promedio'
                    }
                }
            }
        });

        // SEGUNDA GRAFICA DE LINEAS ACUMULADO

        const ctx4 = document.getElementById('myChart4').getContext('2d');
        const myChart4 = new Chart(ctx4, {
            type: 'line',
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
                                $acum = 0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='META' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                   $acum=$acum+$dato->valor;
                            ?>
                                <?php echo $acum; ?>,
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
                                $acum4=0;
                                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' and tiporegistro='LOGRO' and b.nombre='".$nombrekpi."' order by c.mes";
                                $resultado = $conexion->obtenerDatos($textsentencia);
                                foreach($resultado as $dato) {
                                    $acum4 = $acum4 + $dato->valor;                 
                            ?>
                                <?php echo $acum4; ?>,
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
                        text: 'Grafico de Lineas acumulado'
                    }
                }
            }
        });

        
        <?php
        }
       
        ?>

    </script>
</body>
</html>