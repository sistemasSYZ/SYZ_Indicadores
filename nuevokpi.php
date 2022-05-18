<!-- REGISTRA UN NUEVO KPI -->
<link rel="icon" href="img/syz.png">
<?php 
    include 'template/header.php';
    include_once "model/conexion2.php";
    include_once "model/conexion.php";

    $conexion = new conexion;

?>

    <div class="container py-2" style="margin-top: 150px;">
        <h2>
            <?php
            $usuario = $_SESSION['usuario'];

            if (empty($usuario)){
                header('location: ../Login/partials/logout.php');
                exit();
            } 
            
    		$sql = "SELECT area FROM users WHERE email='$usuario'";
    		$consult = pg_query($sql);
    		$fila = pg_fetch_array($consult);
    		$area = $fila[0];
                
                echo 'Ingresar un nuevo indicador (KPI) para el area : '.$area;

                $textsentencia="select * from indicadores where area='".$area."' order by estado asc,nombre asc";
                $resultado = $conexion->obtenerDatos($textsentencia);
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
        
    <div class="container table-responsive" style="height: 500px; margin-top: 15px; margin-bottom: 47px;">
        <div class="row">
            <div class="col-md-3">
                <form class="row g-3" method="POST" action="model/guardar.php">

                    <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="1" >
                    <h3>Nuevo registro</h3>
                    <br>
                    <div>
                        <label for="txtarea" class="form-label">AREA</label>
                        <input type="text" class="form-control" id="txtarea" name="txtarea" value="<?php echo $area ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtnombre" class="form-label">NOMBRE KPI</label>
                        <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtmeta" class="form-label">META MES DEL KPI</label>
                        <input type="number" step="0.01" class="form-control" id="txtmeta" name="txtmeta" value="" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtmetaango" class="form-label">META ANUAL DEL KPI</label>
                        <input type="number" step="0.01" class="form-control" id="txtmetaango" name="txtmetaango" value="" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtformula" class="form-label">FORMULA DEL KPI</label>
                        <input type="text" class="form-control" id="txtformula" name="txtformula" value="" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtunidad" class="form-label">UNIDAD DE MEDIDA DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtunidad">
                            <option selected>Seleccione la unidad</option>    
                            <option value="DIAS">DIAS</option>    
                            <option value="PESOS">PESOS</option>                    
                            <option value="UNIDAD">UNIDAD</option> 
                            <option value="NUMERICO">NUMERICO</option>
                            <option value="PORCENTAJE">PORCENTAJE</option>
                            
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txttipo" class="form-label">TIPO DE KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txttipo">
                            <option selected>Seleccione un tipo</option>    
                            <option value="GESTION">GESTION</option>    
                            <option value="CORPORATIVO">CORPORATIVO</option>                  
                                                        
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtestado" class="form-label">ESTADO DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtestado">
                            <option selected>Seleccione el estado</option>
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>                    
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    
                    <div>
                        <br>
                        <button class="btn btn-secondary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9">

                    <H3>Listado de indicadores</H3>

                <table id="example" class="table table-striped table-hover" style="font-size: 10px">

                    <thead class="table-dark">

                        <tr class="text-center">

                            <th hidden scope="col">ID</th>
                            <th scope="col">AREA</th>
                            <th scope="col">NOMBRE KPI</th>
                            <th scope="col">META MENSUAL</th>
                            <th scope="col">META ANUAL</th>
                            <th scope="col">FORMULA KPI</th>
                            <th scope="col">UNIDAD</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">TIPO KPI</th>
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
                            <th hidden scope="row"><?php echo $dato->cod_kpi; ?> </th>
                            <td><?php echo $dato->area; ?></td>
                            <td><?php echo $dato->nombre; ?></td>
                            <td><?php echo $dato->meta; ?></td>
                            <td><?php echo $dato->metaango; ?></td>
                            <td><?php echo $dato->formula; ?></td>
                            <td><?php echo $dato->unidad; ?></td>
                            <td><?php echo $dato->estado; ?></td>
                            <td><?php echo $dato->tipo; ?></td>
                            <td><?php echo $dato->fecharegistro; ?></td>
                            
                            <td><a href="modificar.php?codigo=<?php echo $dato->cod_kpi;?>" class="btn btn-success"> Modificar</a> </td>
                            

                            <td><a href="./model/Eliminar.php?codigo=<?php echo $dato->cod_kpi;?>" class="btn btn-danger"> Eliminar </a></td>

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