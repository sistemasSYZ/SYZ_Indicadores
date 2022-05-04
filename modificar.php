<!-- MODIFICA LOS KPI -->

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
                echo 'Modificar el indicador (KPI) '.$codigo.' para el area : '.$area;

                $textsentencia="select * from indicadores where cod_kpi=".$codigo;
                $resultado = $conexion->obtenerDatos($textsentencia);
                foreach ($resultado as $dato){
            ?>
            
        </h2>
        <br>
    </div>

            
    <div class="container table-responsive" style="height: 500px">
        <div class="row">
            <div class="col-md-6">
                <form class="row g-3" method="POST" action="model/guardar.php">

                    <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="2" >
                    <input type="hidden" class="form-control" id="txtcod_kpi" name="txtcod_kpi" value="<?php echo $codigo ?>" >
                    <h3>Modificar registro</h3>
                    <br>
                    <div>
                        <label for="txtarea" class="form-label">AREA</label>
                        <input type="text" class="form-control" id="txtarea" name="txtarea" value="<?php echo $dato->area ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtnombre" class="form-label">NOMBRE KPI</label>
                        <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="<?php echo $dato->nombre ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtmeta" class="form-label">META MES DEL KPI</label>
                        <input type="number" step="0.01" class="form-control" id="txtmeta" name="txtmeta" value="<?php echo $dato->meta ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtmetaango" class="form-label">META AÑO DEL KPI</label>
                        <input type="number" step="0.01" class="form-control" id="txtmetaango" name="txtmetaango" value="<?php echo $dato->metaango ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtunidad" class="form-label">UNIDAD DE MEDIDA DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtunidad">
                            <option vlue="<?php echo $dato->unidad ?>" selected><?php echo $dato->unidad ?></option>    
                            <option value="DIAS">DIAS</option>    
                            <option value="PESOS">PESOS</option>                    
                            <option value="UNIDAD">UNIDAD</option> 
                            <option value="NUMERICO">NUMERICO</option>
                            <option value="PORCENTAJE">PORCENTAJE</option>
                            
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtformula" class="form-label">FORMULA KPI</label>
                        <input type="text" class="form-control" id="txtformula" name="txtformula" value="<?php echo $dato->formula ?>" required>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txttipo" class="form-label">TIPO DE KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txttipo" >
                           
                            <option value="<?php echo $dato->tipo ?>" selected><?php echo $dato->tipo ?></option>    
                            <option value="GESTION">GESTION</option>    
                            <option value="CORPORATIVO">CORPORATIVO</option>                  
                                                        
                        </select>
                        <div class="valid-feedback"> Correcto ! </div>
                    </div>
                    <div>
                        <label for="txtestado" class="form-label">ESTADO DEL KPI</label>
                        <select class="form-select" aria-label="Default select example" name="txtestado">
                            <option value="<?php echo $dato->estado ?>" selected><?php echo $dato->estado ?></option>
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>                    
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