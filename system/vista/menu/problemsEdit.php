<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_problema']) || empty($_POST['descripcion']) || empty($_POST['nombre_area']) || empty($_POST['status'])) {
            $alert = '<p class"msg_error" class="alert alert-danger" role="alert">
                        Todo los campos son requeridos </p>';
        } else {
            $id_problema = $_GET['id'];
            $nombre_problema = $_POST['nombre_problema'];
            $descripcion = $_POST['descripcion'];
            $nombre_area = $_POST['nombre_area'];
            $status = $_POST['status'];

            $sql_update = mysqli_query($mysqli, "UPDATE problemas SET nombre_problema = '$nombre_problema', descripcion = '$descripcion', nombre_area = '$nombre_area', status = '$status' WHERE id_problema = '$id_problema'");

            if ($sql_update) {
                $alert = '<p class"msg_save" class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente </p>';
            } else {
                $alert = '<p class"msg_error class="alert alert-danger" role="alert">
                            Error al actualizar los cambios </p>';
            }
        }
    }
    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("location: problems.php");
        mysqli_close($mysqli);
        }
    
        $id_problema = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM problemas WHERE id_problema = $id_problema");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: problems.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_problema = $data['id_problema'];
                $nombre_problema = $data['nombre_problema'];
                $descripcion = $data['descripcion'];
                $nombre_area = $data['nombre_area'];
                $status = $data['status'];
            }
        }
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">
            <?php echo isset($alert) ? $alert : ''; ?>
            <form class="" action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id_problema; ?>">
                        <div class="form-group">
                    <label for="nombre_problema">Problem Name:</label>
                        <input type="text" placeholder="" name="nombre_problema" id="codigo_producto" class="form-control" value="<?php echo $nombre_problema; ?>">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Description:</label>
                        <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_area">Area Name:</label>
                        <input type="text" placeholder="" name="nombre_area" id="nombre_area" class="form-control" value="<?php echo $nombre_area; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="select" value="<?php echo $status; ?>">
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Activo">Active</option>
                                <option value="Inactivo">Inactive</option>
                            </select>
                        </div>
                    </div>
                <input type="submit" value="Guardar Cambios" class="btn btn-primary">
                <a href="problems.php" class="btn btn-danger">Regresar</a>
            </form>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>