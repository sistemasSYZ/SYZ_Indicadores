<!-- REGISTRA UN NUEVO VALOR PARA UN KPI -->
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
                if (empty($area)){
                    header('location: index.php');
                    exit();
                } 
                echo 'Nuevo registro (KPI) para el area : '.$area;
               
                $textsentencia="select c.*, b.nombre from registrokpi c inner join indicadores b on c.cod_kpi = b.cod_kpi where b.area= '".$area."' order by c.ango, c.mes, b.cod_kpi";
                $resultado = $conexion->obtenerDatos($textsentencia);
                
                $textsenten = "select * from indicadores where area ='". $area ."' order by nombre" ;
                $resultados3 = $conexion->obtenerDatos($textsenten);     
            ?>
            
        </h2>
        <br>
    </div>

    <!-- alerta -->

            <?php
                If (isset($_GET['mensaje']) and $_GET['mensaje'] == 'Error'){
            ?>
               
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alerta!</strong> Faltan datos importante.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            
            <?php
                }
                If (isset($_GET['mensaje']) and $_GET['mensaje'] == 'Ok'){

            ?>
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Confirmacion!</strong> Registro guardado / actualizado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                }
                If (isset($_GET['mensaje']) and $_GET['mensaje'] == 'Eliminar'){

            ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Confirmacion!</strong> Registro eliminado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                
                }
                            
            ?>
    <!-- alerta -->
        
    <div class="container table-responsive" style="height: 450px">
        <div class="row">
            <div class="col-md-3">
                <form class="row g-3" method="POST" action="model/guardarkpi.php">

                    <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="1" >
                    <br>
                    <div>
                        <label for="txtcod_kpi" class="form-label">NOMBRE DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtcod_kpi">
                            <option selected>Seleccione el KPI</option> 
                            
                            <?php foreach($resultados3 as $datos1){ ?>
                            
                                <option value="<?php echo $datos1->cod_kpi ?>"><?php echo $datos1->nombre ?></option>
                            
                            <?php } ?>

                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtmes" class="form-label">MES DE REGISTRO</label>
                        <select class="form-select" aria-label="Default select example" name="txtmes">
                            <option selected>Seleccione el mes</option>
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
                        <input type="text" class="form-control" id="txtyear" name="txtyear" value="2022" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtvalor" class="form-label">VALOR DEL KPI</label>
                        <input type="number" step="0.01" class="form-control" id="txtvalor" name="txtvalor" value="" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txttipo" class="form-label">TIPO DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txttipo">
                            <option selected>Seleccione el tipo de registro</option>
                            <option value="META">META</option>
                            <option value="LOGRO">LOGRO</option>                    
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    
                    <div>
                        <br>
                        <button class="btn btn-secondary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>

            <div class="col-md-8">

                    <H3>Listado de registro</H3>

                <table id="example" class="table table-striped table-hover" style="font-size: 10px">

                    <thead class="table-dark">

                        <tr class="text-center">

                            <th hidden scope="col">ID</th>
                            <th scope="col">NOMBRE KPI</th>
                            <th scope="col">MES</th>
                            <th scope="col">AÑO</th>
                            <th scope="col">VALOR</th>
                            <th scope="col">TIPO</th>
                            <th scope="col">F Registro</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                            <!-- <th scope="col">Eliminar</th> -->
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($resultado as $dato){
                        ?>
                        <tr class="trhover text-center">
                            <th hidden scope="row"><?php echo $dato->cod_registro; ?> </th>
                            <td><?php echo $dato->nombre; ?></td>
                            <td><?php echo $dato->mes; ?></td>
                            <td><?php echo $dato->ango; ?></td>
                            <td><?php echo $dato->valor; ?></td>
                            <td><?php echo $dato->tiporegistro; ?></td>
                            <td><?php echo $dato->fecharegistro; ?></td>
                                                        
                            <td><a href="modificarkpi.php?codigo=<?php echo $dato->cod_registro;?>" class="btn btn-success"> Modificar</a> </td>

                            <td><a href="./model/Eliminarkpi.php?codigo=<?php echo $dato->cod_registro;?>" class="btn btn-danger"> Eliminar</a></td>

                        </tr>
                            
                        <?php
                            }
                        ?>
                        
                    </tbody>
                </table>
                <button id="btn1"> clon </button>

            </div>
        </div>
    </div>

<?php include 'template/footer.php' ?>