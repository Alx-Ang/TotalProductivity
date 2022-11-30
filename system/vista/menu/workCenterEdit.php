<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['workcenter']) || empty($_POST['modelo']) || empty($_POST['numero_serie']) || empty($_POST['fabricante']) || empty($_POST['area_nombre']) || empty($_POST['material']) || empty($_POST['status'])) {
            $alert = '<center><p class"msg_error" class="alert alert-danger" role="alert">
                       ¡ Todo los campos son requeridos ! 
                      </p></center>';
        } else {
            $id_workcenter = $_GET['id'];
            $workcenter = $_POST['workcenter'];
            $modelo = $_POST['modelo'];
            $numero_serie = $_POST['numero_serie'];
            $fabricante = $_POST['fabricante'];
            $area_nombre = $_POST['area_nombre'];
            $material = $_POST['material'];
            $status = $_POST['status'];

            $sql_update = mysqli_query($mysqli, "UPDATE workcenter SET workcenter = '$workcenter', modelo = '$modelo', numero_serie = '$numero_serie', fabricante = '$fabricante', area_nombre = '$area_nombre', material = '$material', status = '$status' WHERE id_workcenter = '$id_workcenter'");

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
    // Validar seleccion de areas
    if (empty($_REQUEST['id'])) {
        header("Location: workcenter.php");
        } else {
            $id_area = $_REQUEST['id'];
            if (!is_numeric($id_area)) {
            header("Location: workcenter.php");
            }
            $query = mysqli_query($mysqli, "SELECT a.id_area, a.area_nombre FROM areas a WHERE a.id_area = id_area");
            $result_areas = mysqli_num_rows($query);
              
            if ($result_areas > 0) {
                $data_areas = mysqli_fetch_assoc($query);
            } else {
                header("Location: workcenter.php");
            }
    }
    // Validar seleccion de material
    if (empty($_REQUEST['id'])) {
        header("Location: workcenter.php");
        } else {
            $id_areas = $_REQUEST['id'];
            if (!is_numeric($id_areas)) {
            header("Location: workcenter.php");
            }
            $query = mysqli_query($mysqli, "SELECT m.id_materiaprima, m.nombre FROM materia_prima m WHERE m.id_materiaprima = id_materiaprima");
            $result_rawMaterials = mysqli_num_rows($query);
            
            if ($result_rawMaterials > 0) {
                $data_materiaPrima = mysqli_fetch_assoc($query);
            } else {
                header("Location: workcenter.php");
            }
    }
    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("location: workCenter.php");
        mysqli_close($mysqli);
        }
    
        $id_workcenter = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM workcenter, areas, materia_prima WHERE id_workcenter = $id_workcenter");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: workCenter.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_workcenter = $data['id_workcenter'];
                $workcenter = $data['workcenter'];
                $modelo = $data['modelo'];
                $numero_serie = $data['numero_serie'];
                $fabricante = $data['fabricante'];
                $area_nombre = $data['area_nombre'];
                $material = $data['material'];
                $id_materiaprima = $data['id_materiaprima'];
                $status = $data['status'];
            }
    }

?>
<!-- Begin Page Content -->
<<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>EDIT WORK CENTER</center>
            </div>
            <div class="card">
                <form action="" method="post" autocomplete="off" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <input type="hidden" name="id" value="<?php echo $id_workcenter; ?>">
                        <div class="form-group">
                            <label for="workcenter">Work Center:</label>
                            <input type="text" placeholder="" name="workcenter" id="workcenter" class="form-control" value="<?php echo $workcenter; ?>">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Model:</label>
                            <input type="text" placeholder="" name="modelo" id="modelo" class="form-control" value="<?php echo $modelo; ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero_serie">Serial Number:</label>
                            <input type="text" placeholder="" name="numero_serie" id="numero_serie" class="form-control" value="<?php echo $numero_serie; ?>">
                        </div>
                        <div class="form-group">
                            <label for="fabricante">Maker Name:</label>
                            <input type="text" placeholder="" name="fabricante" id="fabricante" class="form-control" value="<?php echo $fabricante; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="area_nombre">Area Name:</label>
                            <div class="select">
                                <?php
                                    include "php/conexion.php";
                                    $query = mysqli_query($mysqli, "SELECT * FROM areas");
                                    $result = mysqli_num_rows($query);
                                    mysqli_close($mysqli);
                                    
                                ?>
                                <select id="area_nombre" name="area_nombre" class="form-control">
                                        <option ><?php echo $area_nombre?></option>
                                    
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
                            <label for="material">Material:</label>
                            <div>
                                <?php
                                    include "php/conexion.php";
                                    $query = mysqli_query($mysqli, "SELECT * FROM materia_prima");
                                    $result = mysqli_num_rows($query);
                                    mysqli_close($mysqli);
                                    
                                ?>
                                <select id="material" name="material" class="form-control" value="<?php echo $id_materiaprima; ?>">
                              
                                
                                    <?php
                                    if ($result > 0) {
                                    while ($nombre = mysqli_fetch_array($query)) {
                                        
                                    ?>
                                        <option value="<?php echo $nombre['id_materiaprima']; ?>"><?php echo $nombre['material']; ?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <div class="select" >
                                <select name="status" id="status" class="form-control" value="<?php echo $status; ?>">
                                    <option value="Activo">Active</option>
                                    <option value="Inactivo">Inactive</option>
                                </select>
                            </div>
                        </div>

                    <center><input type="submit" value="Save Change" class="btn btn-primary">
                    <a href="workCenter.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>