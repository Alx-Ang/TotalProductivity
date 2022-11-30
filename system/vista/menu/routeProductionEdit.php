<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if ( empty($_POST['workcenter']) || empty($_POST['observaciones']) || empty($_POST['meta_hora']) || empty($_POST['ciclo_estado']) || empty($_POST['fecha_hora']) || empty($_POST['status'])) {
            $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Todo los campos son obligatorios !
                        </div> </center>';
        } else {
            $id_rutaproduccion = $_GET['id'];
            $workcenter = $_POST['workcenter'];
            $observaciones = $_POST['observaciones'];
            $meta_hora = $_POST['meta_hora'];
            $ciclo_estado = $_POST['ciclo_estado'];
            $fecha_hora = $_POST['fecha_hora'];
            $status = $_POST['status'];
            
            $sql_update = mysqli_query($mysqli, "UPDATE ruta_produccion SET workcenter='$workcenter', observaciones='$observaciones', meta_hora='$meta_hora', ciclo_estado='$ciclo_estado', fecha_hora='$fecha_hora', status='$status'");

            if ($sql_update) {
                $alert = '<center> <div class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente
                        </div> </center>';
            } else {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Error al actualizar los cambios !
                        </div> </center>';
            }
        }
    }
    // Validar seleccion de workcenter
    if (empty($_REQUEST['id'])) {
        header("Location: productionRoute.php");
        } else {
            $id_workcenter = $_REQUEST['id'];
            if (!is_numeric($id_workcenter)) {
            header("Location: productionRoute.php");
            }
            $query = mysqli_query($mysqli, "SELECT w.id_workcenter, w.workcenter FROM workcenter w WHERE w.id_workcenter = id_workcenter");
            $result_workcenter = mysqli_num_rows($query);
              
            if ($result_workcenter > 0) {
                $data_workcenter = mysqli_fetch_assoc($query);
            } else {
                
            }
        }
    // Mostrar Datos 

    if (empty($_REQUEST['id'])) {
        header("location: productionRoute.php");
        mysqli_close($mysqli);
        }
    
        $id_rutaproduccion = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM ruta_produccion WHERE id_rutaproduccion = $id_rutaproduccion");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: productionRoute.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_rutaproduccion = $data['id_rutaproduccion'];
                $workcenter = $data['workcenter'];
                $observaciones = $data['observaciones'];
                $meta_hora = $data['meta_hora'];
                $ciclo_estado = $data['ciclo_estado'];
                $fecha_hora = $data['fecha_hora'];
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
                <center>EDIT PRODUCTION ROUTE</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    
                    <div class="form-group">
                        <label for="workcenter">Work Center:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT id_workcenter, workcenter FROM workcenter");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);            
                            ?>
                            <select id="workcenter" name="workcenter" class="form-control">
                                <option ><?php echo $workcenter; ?></option>
                                <?php
                                if ($result > 0) {
                                    while ($workcenter = mysqli_fetch_array($query)) {
                                ?>
                                <option value="<?php echo $workcenter['id_workcenter']; ?>"><?php echo $workcenter['workcenter']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="observaciones">Observation:</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control" value="<?php echo $observaciones; ?>">
                    </div>

                    <div class="form-group">
                        <label for="meta_hora">Target Hour:</label>
                        <input type="text" name="meta_hora" id="meta_hora" class="form-control" value="<?php echo $meta_hora; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ciclo_estado">Status Cycle:</label>
                        <input type="text" name="ciclo_estado" id="ciclo_estado" class="form-control" value="<?php echo $ciclo_estado; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Date:</label>
                        <input type="date" name="fecha_hora" id="fecha_hora" class="form-control" value="<?php echo $fecha_hora; ?>">
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

                    <center><input type="submit" value="Save" class="btn btn-primary">
                    <a href="productionRoute.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>