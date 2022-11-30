<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['codigo_producto']) || empty($_POST['descripcion']) || empty($_POST['ruta_produccion']) || empty($_POST['nombre_area']) || empty($_POST['ciclo_meta']) | empty($_POST['meta_hora']) || empty($_POST['status'])) {
            $alert = '<center> <div class"msg_error" class="alert alert-danger" role="alert">
                       ¡ Todo los campos son requeridos ! 
                      </div> </center>';
        } else {
            $id_eficiencias = $_GET['id'];
            $codigo_producto = $_POST['codigo_producto'];
            $descripcion = $_POST['descripcion'];
            $ruta_produccion = $_POST['ruta_produccion'];
            $nombre_area = $_POST['nombre_area'];
            $ciclo_meta = $_POST['ciclo_meta'];
            $meta_hora = $_POST['meta_hora'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            

            $sql_update = mysqli_query($mysqli, "UPDATE eficiencias SET codigo_producto = '$codigo_producto', descripcion = '$descripcion', ruta_produccion = '$ruta_produccion', nombre_area = '$nombre_area', ciclo_meta = '$ciclo_meta', meta_hora = '$meta_hora', status = '$status', WHERE id_eficiencias = '$id_eficiencias'");

            if ($sql_update) {
                $alert = '<center> <div class"msg_save" class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente 
                          </div> </center>';
            } else {
                $alert = '<center> <div class"msg_error class="alert alert-danger" role="alert">
                           ¡ Error al actualizar los cambios !
                          </div> </center>';
            }
        }
    }
    // Validar seleccion de codigoProducto
    if (empty($_REQUEST['id'])) {
        header("Location: efficiencies.php");
        } else {
            $id_eficiencias = $_REQUEST['id'];
            if (!is_numeric($id_eficiencias)) {
            header("Location: efficiencies.php");
            }
            $query = mysqli_query($mysqli, "SELECT p.id_producto, p.codigo_producto FROM producto p WHERE p.id_producto = id_producto");
            $result_Producto = mysqli_num_rows($query);
              
            if ($result_Producto > 0) {
                $data_Productos = mysqli_fetch_assoc($query);
            } else {
                header("Location: efficiencies.php");
            }
        }
    // Validar seleccion de rutaProduccion
    if (empty($_REQUEST['id'])) {
        header("Location: efficiencies.php");
        } else {
            $id_eficiencias = $_REQUEST['id'];
            if (!is_numeric($id_eficiencias)) {
            header("Location: efficiencies.php");
            }
            $query = mysqli_query($mysqli, "SELECT r.id_rutaproduccion, r.workcenter FROM ruta_produccion r WHERE r.id_rutaproduccion = id_rutaproduccion");
            $result_Ruta = mysqli_num_rows($query);
              
            if ($result_Ruta > 0) {
                $data_Ruta = mysqli_fetch_assoc($query);
            } else {
                header("Location: efficiencies.php");
            }
        }

    // Validar seleccion de nombreArea
    if (empty($_REQUEST['id'])) {
        header("Location: efficiencies.php");
        } else {
            $id_eficiencias = $_REQUEST['id'];
            if (!is_numeric($id_eficiencias)) {
            header("Location: efficiencies.php");
            }
            $query = mysqli_query($mysqli, "SELECT a.id_area, a.area_nombre FROM areas a WHERE a.id_area = id_area");
            $result_areas = mysqli_num_rows($query);
              
            if ($result_areas > 0) {
                $data_areas = mysqli_fetch_assoc($query);
            } else {
                header("Location: efficiencies.php");
            }
        }
    
    // Mostrar Datos 

    if (empty($_REQUEST['id'])) {
        header("location: efficiencies.php");
        mysqli_close($mysqli);
        }
    
        $id_eficiencias = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM eficiencias WHERE id_eficiencias = $id_eficiencias");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: efficiencies.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_eficiencias = $data['id_eficiencias'];
                $codigo_producto = $data['codigo_producto'];
                $descripcion = $data['descripcion'];
                $ruta_produccion = $data['ruta_produccion'];
                $nombre_area = $data['nombre_area'];
                $ciclo_meta = $data['ciclo_meta'];
                $meta_hora = $data['meta_hora'];
                $status = $data['status'];
            }
        }
    
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>EDIT EFFICIENCIES</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                        <input type="hidden" name="id" value="<?php echo $id_eficiencias; ?>">
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
                                        <option value=""><?php echo $codigo_producto; ?></option>

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
                                <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control"value="<?php echo $descripcion; ?>">
                            </div>

                            <div class="form-group">
                                <label for="ruta_produccion">Production Route:</label>
                                <div>
                                    <?php
                                        include "php/conexion.php";
                                        $query = mysqli_query($mysqli, "SELECT id_workcenter, workcenter FROM workcenter");
                                        $result = mysqli_num_rows($query);
                                        mysqli_close($mysqli);
                                        
                                    ?>
                                    <select id="ruta_produccion" name="ruta_produccion" class="form-control" >
                                        <option value=""><?php echo $ruta_produccion; ?></option>

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
                                        $query = mysqli_query($mysqli, "SELECT id_area, area_nombre FROM areas");
                                        $result = mysqli_num_rows($query);
                                        mysqli_close($mysqli);
                                        
                                    ?>
                                    <select id="nombre_area" name="nombre_area" class="form-control" >
                                            <option value=""><?php echo $nombre_area; ?></option>
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
                                <input type="text" placeholder="" name="ciclo_meta" id="ciclo_meta" class="form-control" value="<?php echo $ciclo_meta; ?>">
                            </div>
                            <div class="form-group">
                                <label for="meta_hora">Hour Meta:</label>
                                <input type="text" placeholder="" name="meta_hora" id="meta_hora" class="form-control" value="<?php echo $meta_hora; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Status:</label>
                                <div class="select">
                                    <select name="status" id="status" class="form-control" value="<?php echo $status; ?>">
                                        <option value="Activo">Active</option>
                                        <option value="Inactivo">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        
                        <center><input type="submit" value="Save Changes" class="btn btn-primary">
                        <a href="efficiencies.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>