<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['area_nombre']) || empty($_POST['material']) || empty($_POST['proceso']) || empty($_POST['subproceso']) || empty($_POST['status'])) {
            $alert = '<center> <div class"msg_error" class="alert alert-danger" role="alert">
                       ¡ Todo los campos son requeridos ! 
                      </div> </center>';
        } else {
            $id_area = $_GET['id'];
            $area_nombre = $_POST['area_nombre'];
            $material = $_POST['material'];
            $proceso = $_POST['proceso'];
            $subproceso = $_POST['subproceso'];
            $status = $_POST['status'];

            

            $sql_update = mysqli_query($mysqli, "UPDATE areas SET area_nombre = '$area_nombre', material = '$material', proceso = '$proceso', subproceso = '$subproceso', status= '$status' WHERE id_area = '$id_area'");

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
    
    // Validar seleccion de areas de la tabla areas
    if (empty($_REQUEST['id'])) {
        header("Location: areas.php");
        } else {
            $id_area = $_REQUEST['id'];
            if (!is_numeric($id_area)) {
            header("Location: areas.php");
            }
            $query = mysqli_query($mysqli, "SELECT a.id_area, a.area_nombre FROM areas a WHERE a.id_area = id_area");
            $result_areas = mysqli_num_rows($query);
              
            if ($result_areas > 0) {
                $data_areas = mysqli_fetch_assoc($query);
            } else {
                header("Location: areas.php");
            }
        }

    // Validar seleccion de material de tabla materia prima
    if (empty($_REQUEST['id'])) {
        header("Location: areas.php");
        } else {
            $id_materiaprima = $_REQUEST['id'];
            if (!is_numeric($id_materiaprima)) {
            header("Location: areas.php");
            }
            $query = mysqli_query($mysqli, "SELECT m.id_materiaprima, m.nombre FROM materia_prima m WHERE m.id_materiaprima = id_materiaprima");
            $result_materiaPrima = mysqli_num_rows($query);
              
            if ($result_materiaPrima > 0) {
                $data_materiaPrima = mysqli_fetch_assoc($query);
            } else {
                header("Location: areas.php");
            }
        }

    // Mostrar Datos 

    if (empty($_REQUEST['id'])) {
        header("location: areas.php");
        mysqli_close($mysqli);
        }
    
        $id_area = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM areas WHERE id_area = $id_area");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: areas.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_area = $data['id_area'];
                $area_nombre = $data['area_nombre'];
                $material = $data['material'];
                $proceso = $data['proceso'];
                $subproceso = $data['subproceso'];
                $status = $data['status'];
            }
        }
    
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>EDIT AREA</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                        <input type="hidden" name="id" value="<?php echo $id_area; ?>">
                            <div class="form-group">
                                <label for="area_nombre">Area Name:</label>
                                <div>
                                    <?php
                                        include "php/conexion.php";
                                        $query = mysqli_query($mysqli, "SELECT * FROM areas");
                                        $result = mysqli_num_rows($query);
                                        mysqli_close($mysqli);
                                        
                                    ?>
                                    <select id="area_nombre" name="area_nombre" class="form-control" >
                                        <option selected> <?php echo $area_nombre; ?></option>

                                        <?php
                                        if ($result > 0) {
                                        while ($area_nombre = mysqli_fetch_array($query)) {
                                            
                                        ?>
                                            <option value="<?php echo $area_nombre['area_nombre']; ?>"><?php echo $area_nombre['area_nombre']; ?></option>
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
                                    <select id="material" name="material" class="form-control">
                                        <option selected><?php echo $material; ?></option>
                                        <?php
                                        if ($result > 0) {
                                        while ($nombre = mysqli_fetch_array($query)) {    
                                        ?>
                                        <option value="<?php echo $nombre['id_materiaprima']; ?>"><?php echo $nombre['nombre']; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="proceso">Process:</label>
                                <input type="text" placeholder="" name="proceso" id="proceso" class="form-control" value="<?php echo $proceso; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="subproceso">Sub-process:</label>
                                <input type="text" placeholder="" name="subproceso" id="subproceso" class="form-control" value="<?php echo $subproceso; ?>">
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
                        <a href="areas.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>