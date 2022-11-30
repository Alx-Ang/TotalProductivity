<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if ( empty($_POST['codigo_producto']) || empty($_POST['descripcion']) || empty($_POST['ruta_produccion']) || empty($_POST['nombre_area']) || empty($_POST['ciclo_meta']) | empty($_POST['meta_hora']) || empty($_POST['status'])) {
            $alert = '<center><div class="alert alert-danger" role="alert">
                           ¡ Todo los campos son obligatorios !
                        </div></center>';
        } else {
            $codigo_producto = $_POST['codigo_producto'];
            $descripcion = $_POST['descripcion'];
            $ruta_produccion = $_POST['ruta_produccion'];
            $nombre_area = $_POST['nombre_area'];
            $ciclo_meta = $_POST['ciclo_meta'];
            $meta_hora = $_POST['meta_hora'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM eficiencias WHERE codigo_producto = '$codigo_producto'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<center><div class="alert alert-danger" role="alert">
                            ¡ El codigo del producto ya esta registrado !
                        </div></center>';
            }else{
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO eficiencias (codigo_producto, descripcion, ruta_produccion, nombre_area, ciclo_meta,  meta_hora, status) VALUES ('$codigo_producto', '$descripcion', '$ruta_produccion', '$nombre_area', '$ciclo_meta', '$meta_hora', '$status')");
            if ($query_insert) {
                $alert = '<center><div class="alert alert-primary" role="alert">
                            Nueva eficiencia registrada
                        </div></center>';
            } else {
                $alert = '<center><div class="alert alert-danger" role="alert">
                            ¡ Error al registrar una nueva eficiencia !
                        </div><center>';
            }
            }
        }
    }
    mysqli_close($mysqli);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>NEW EFFICIENCIES</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="codigo_producto">Product Code:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT id_producto, codigo_producto FROM producto");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                
                            ?>
                            <select id="codigo_producto" name="codigo_producto" class="form-control" >
                                <option selected> Select</option>

                                <?php
                                if ($result > 0) {
                                while ($codigoProducto = mysqli_fetch_array($query)) {
                                    
                                ?>
                                <option value="<?php echo $codigoProducto['id_producto']; ?>"><?php echo $codigoProducto['codigo_producto']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Description:</label>
                        <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ruta_produccion">Production Route:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT *FROM workcenter");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                
                            ?>
                            <select id="ruta_produccion" name="ruta_produccion" class="form-control" >
                                <option selected> Select</option>

                                <?php
                                if ($result > 0) {
                                while ($rutaProduccion = mysqli_fetch_array($query)) {
                                    
                                ?>
                                <option value="<?php echo $rutaProduccion['id_workcenter']; ?>"><?php echo $rutaProduccion['workcenter']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre_area">Area Name:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT * FROM areas");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                
                            ?>
                            <select id="nombre_area" name="nombre_area" class="form-control" >
                                <option selected> Select</option>

                                <?php
                                if ($result > 0) {
                                while ($area_nombre = mysqli_fetch_array($query)) {
                                    
                                ?>
                                <option value="<?php echo $area_nombre['id_area']; ?>"><?php echo $area_nombre['area_nombre']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ciclo_meta">Cycle Meta:</label>
                        <input type="text" placeholder="" name="ciclo_meta" id="ciclo_meta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="meta_hora">Hour Meta:</label>
                        <input type="text" placeholder="" name="meta_hora" id="meta_hora" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <div class="select">
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Activo">Active</option>
                                <option value="Inactivo">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <center><input type="submit" value="Save" class="btn btn-primary">
                    <a href="efficiencies.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>