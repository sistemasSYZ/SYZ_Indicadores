<!-- MODIFICA LOS REGISTROS KPI -->
<link rel="shortcut icon" href="img/syz.png" type="image/x-icon">
<?php 
    session_start();
    include 'template/header.php';
    include_once "model/conexion2.php";
    $conexion = new conexion;

?>

    <div class="container py-3">
        <h2>
            <?php
                $area = $_SESSION["area"];
                $codigo = $_GET["codigo"];
                if (empty($area)){
                    header('location: index.php');
                    exit();
                }
                echo 'Modificar el registro (KPI) '.$codigo.' para el area : '.$area;

                $textsenten = "select * from indicadores where area ='". $area ."'" ;
                $resultados3 = $conexion->obtenerDatos($textsenten); 

                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where c.cod_registro=".$codigo;
                $resultado = $conexion->obtenerDatos($textsentencia);
                foreach ($resultado as $datos){
            ?>
            
        </h2>
        <br>
    </div>

            
    <div class="container table-responsive" style="height: 500px">
        <div class="row">
            <div class="col-md-6">
                <form class="row g-3" method="POST" action="model/guardarkpi.php">

                    <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="2" >
                    <input type="hidden" class="form-control" id="txtcod_registro" name="txtcod_registro" value="<?php echo $codigo ?>" >
                    <br>
                    <div>
                        <label for="txtcod_kpi" class="form-label">NOMBRE del KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtcod_kpi">
                            <option value="<?php echo $datos->cod_kpi ?>" selected><?php echo $datos->nombre ?></option> 
                            
                            <?php foreach($resultados3 as $datos1){ ?>
                            
                                <option value="<?php echo $datos1->cod_kpi ?>"><?php echo $datos1->nombre ?></option>
                            
                            <?php } ?>

                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <?php $mes = $conexion->obtenerMes($datos->mes) ?>
                        <label for="txtmes" class="form-label">MES DE REGISTRO</label>
                        <select class="form-select" aria-label="Default select example" name="txtmes">
                            <option value="<?php echo $datos->mes ?>" selected><?php echo $mes ?></option>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>  
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>  
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>  
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>                        
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>                
                    </div>
                    <div>
                        <label for="txtyear" class="form-label">AÑO DEL KPI</label>
                        <input type="text" class="form-control" id="txtyear" name="txtyear" value="<?php echo $datos->ango ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtvalor" class="form-label">VALOR DEL KPI</label>
                        <input type="text" class="form-control" id="txtvalor" name="txtvalor" value="<?php echo $datos->valor ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txttipo" class="form-label">TIPO DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txttipo">
                            <option value ="<?php echo $datos->tiporegistro ?>" selected><?php echo $datos->tiporegistro ?></option>
                            <option value="META">META</option>
                            <option value="LOGRO">LOGRO</option>                    
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div>
                        <br>
                        <button class="btn btn-secondary" type="submit">Modificar</button>
                    </div>
                </form>
            </div>

           
        </div>
    </div>

<?php include 'template/footer.php' ?>