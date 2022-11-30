<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre']) || empty($_POST['material']) || empty($_POST['area_nombre']) || empty($_POST['subarea']) || empty($_POST['status'])) {
            $alert = '<center><p class"msg_error" class="alert alert-danger" role="alert">
                        ¡ Todo los campos son requeridos !
                      </p></center>';
        } else {
            $id_materiaprima  = $_GET['id'];
            $nombre = $_POST['nombre'];
            $material = $_POST['material'];
            $area_nombre = $_POST['area_nombre'];
            $subarea = $_POST['subarea'];
            $status = $_POST['status'];

            $sql_update = mysqli_query($mysqli, "UPDATE materia_prima SET nombre = '$nombre', material = '$material', area_nombre = '$area_nombre', subarea = '$subarea', status = '$status' WHERE id_materiaprima = '$id_materiaprima'");

            if ($sql_update) {
                $alert = '<center><p class"msg_save" class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente 
                          </p></center>';
            } else {
                $alert = '<center><p class"msg_error class="alert alert-danger" role="alert">
                            ¡ Error al actualizar los cambios ! 
                          </p></center>';
            }
        }
    }
    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("location: rawMaterials.php");
        mysqli_close($mysqli);
        }
    
        $id_materiaprima = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM materia_prima WHERE id_materiaprima = $id_materiaprima");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: rawMaterials.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_materiaprima = $data['id_materiaprima'];
                $nombre = $data['nombre'];
                $material = $data['material'];
                $area_nombre = $data['area_nombre'];
                $subarea = $data['subarea'];
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
                <center>EDIT RAW MATERIAL</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                <?php echo isset($alert) ? $alert : ''; ?>
                    <input type="hidden" name="id" value="<?php echo $id_materiaprima; ?>">
                        <div class="form-group">
                            <label for="nombre">Name:</label>
                            <input type="text" placeholder="" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>">
                        </div>
                        <div class="form-group">
                            <label for="material">Material:</label>
                            <input type="text" placeholder="" name="material" id="material" class="form-control" value="<?php echo $material; ?>">
                        </div>
                        <div class="form-group">
                            <label for="area_nombre">Area Name:</label>
                            <div>
                                <?php
                                    include "php/conexion.php";
                                    $query = mysqli_query($mysqli, "SELECT id_area, area_nombre FROM areas");
                                    $result = mysqli_num_rows($query);
                                    mysqli_close($mysqli);
                                    
                                ?>
                                <select id="area_nombre" name="area_nombre" class="form-control">
                                        <option value=""><?php echo $area_nombre?></option>
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
                            <label for="subarea">Sub-Area:</label>
                            <input type="text" placeholder="" name="subarea" id="subarea" class="form-control" value="<?php echo $subarea; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <div class="select" >
                                <select name="status" id="status" class="form-control"value="<?php echo $status; ?>">
                                    <option value="Activo">Active</option>
                                    <option value="Inactivo">Inactive</option>
                                </select>
                            </div>
                        </div>
                    <center><input type="submit" value="Save Change" class="btn btn-primary">
                    <a href="rawMaterials.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>