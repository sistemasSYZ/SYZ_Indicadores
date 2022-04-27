<!-- Crea los campos en html para crear un registro nuevo -->
<div class="container py-3">
        <h3>
            <?php
                $area = $_SESSION["area"];
                echo 'Ingresar un nuevo indicador (KPI) para el area '.$area;
            ?>
            
        </h3>
        <br>
    </div>
        
    <div class="container table-responsive" style="height: 450px">

        <form class="row g-3" method="POST" action="model/guardar.php">

            <input type="hidden" class="form-control" id="txtaccion" name="txtaccion" value="1" >

            <div class="col-md-6">
                <label for="txtarea" class="form-label">AREA</label>
                <input type="text" class="form-control" id="txtarea" name="txtarea" value="<?php echo $area ?>" required>
                <div class="valid-feedback"> Correcto ! </div>
            </div>
            <div class="col-md-6">
                <label for="txtnombre" class="form-label">NOMBRE KPI</label>
                <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="" required>
                <div class="valid-feedback"> Correcto ! </div>
            </div>
            <div class="col-md-6">
                <label for="txtmeta" class="form-label">META DEL KPI</label>
                <input type="text" class="form-control" id="txtmeta" name="txtmeta" value="" required>
                <div class="valid-feedback"> Correcto ! </div>
            </div>
            <div class="col-md-6">
                <label for="txtfigura" class="form-label">ESTADO DEL KPI</label>
                <select class="form-select" aria-label="Default select example" name="txtestado">
                    <option selected>Seleccione el estado</option>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>                    
                </select>
                <div class="valid-feedback"> Correcto ! </div>
            </div>
            <div class="col-md-6">
                <label for="txtmes" class="form-label">MES DE LA META</label>
                <select class="form-select" aria-label="Default select example" name="txtestado">
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
            <div class="col-md-6">
                <label for="txtyear" class="form-label">AÑO DEL KPI</label>
                <input type="text" class="form-control" id="txtyear" name="txtyear" value="2022" required>
                <div class="valid-feedback"> Correcto ! </div>
            </div>
            