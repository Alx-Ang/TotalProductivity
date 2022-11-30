<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['codigo_producto']) || empty($_POST['codigo_sistema']) || empty($_POST['descripcion']) || empty($_POST['nombre_area']) || empty($_POST['observaciones']) || empty($_POST['ciclo_meta']) || empty($_POST['status'])) {
            $alert = '<center><p class"msg_error" class="alert alert-danger" role="alert">
                        ¡ Todo los campos son requeridos !
                      </p></center>';
        } else {
            $id_producto = $_GET['id'];
            $codigo_producto = $_POST['codigo_producto'];
            $codigo_sistema = $_POST['codigo_sistema'];
            $descripcion = $_POST['descripcion'];
            $nombre_area = $_POST['nombre_area'];
            $observaciones= $_POST['observaciones'];
            $ciclo_meta = $_POST['ciclo_meta'];
            $status = $_POST['status'];

            $sql_update = mysqli_query($mysqli, "UPDATE producto SET codigo_producto = '$codigo_producto', codigo_sistema = '$codigo_sistema', descripcion = '$descripcion', nombre_area = '$nombre_area', observaciones = '$observaciones', ciclo_meta = '$ciclo_meta', status = '$status' WHERE id_producto = '$id_producto'");

            if ($sql_update) {
                $alert = '<center> <p class"msg_save" class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente </p> </center>';
            } else {
                $alert = '<center><p class"msg_error class="alert alert-danger" role="alert">
                           ¡ Error al actualizar los cambios ! </p></center>';
            }
        }
    }
    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("location: product.php");
        mysqli_close($mysqli);
        }
    
        $id_producto = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM producto, areas WHERE id_producto = $id_producto");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: product.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_producto = $data['id_producto'];
                $codigo_producto = $data['codigo_producto'];
                $codigo_sistema = $data['codigo_sistema'];
                $descripcion = $data['descripcion'];
                $nombre_area = $data['nombre_area'];
                $area_nombre = $data['area_nombre'];
                $observaciones= $data['observaciones'];
                $ciclo_meta = $data['ciclo_meta'];
                $status = $data['status'];
            }
        }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>EDIT PRODUCT</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <input type="hidden" name="id" value="<?php echo $id_producto; ?>">
                                <div class="form-group">
                            <label for="codigo_producto">Product Code:</label>
                                <input type="text" placeholder="" name="codigo_producto" id="codigo_producto" class="form-control" value="<?php echo $codigo_producto; ?>">
                            </div>
                            <div class="form-group">
                                <label for="codigo_sistema">System Code:</label>
                                <input type="text" placeholder="" name="codigo_sistema" id="codigo_sistema" class="form-control" value="<?php echo $codigo_sistema; ?>">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Description:</label>
                                <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
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
                                            <option ><?php echo $nombre_area; ?></option>
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
                                <label for="observaciones">Observations:</label>
                                <input type="text" name="observaciones" id="observaciones" class="form-control" value="<?php echo $observaciones; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ciclo_meta">Target Cycle:</label>
                                <input type="text" placeholder="" name="ciclo_meta" id="ciclo_meta" class="form-control" value="<?php echo $ciclo_meta; ?>">
                            </div>                   
                            <div class="form-group">
                                <label>Status</label>
                                <div class="select" >
                                    <select name="status" id="status" class="form-control" value="<?php echo $status; ?>">
                                        <option value="Activo">Active</option>
                                        <option value="Inactivo">Inactive</option>
                                    </select>
                                </div>
                            </div>
                    <center><input type="submit" value="Save Change" class="btn btn-primary">
                    <a href="product.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>