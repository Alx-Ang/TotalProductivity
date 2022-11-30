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
            $workcenter = $_POST['workcenter'];
            $observaciones = $_POST['observaciones'];
            $meta_hora = $_POST['meta_hora'];
            $ciclo_estado = $_POST['ciclo_estado'];
            $fecha_hora = $_POST['fecha_hora'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO ruta_produccion (workcenter, observaciones, meta_hora, ciclo_estado, fecha_hora, status) VALUES ('$workcenter', '$observaciones', '$meta_hora', '$ciclo_estado', '$fecha_hora', '$status')");
            if ($query_insert) {
                $alert = '<center> <div class="alert alert-primary" role="alert">
                            Nueva ruta de produccion registrada
                        </div> </center>';
            } else {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Error al registrar una nueva ruta de produccion !
                        </div> </center>';
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
                <center>NEW PRODUCTION ROUTE</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    
                    <div class="form-group">
                        <label for="workcenter">Work Center:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT * FROM workcenter");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);            
                            ?>
                            <select id="workcenter" name="workcenter" class="form-control" >
                                <option value="">Select</option>
                                <?php
                                if ($result > 0) {
                                while ($workcenter_nombre = mysqli_fetch_array($query)) {
                            
                                ?>
                                <option value="<?php echo $workcenter_nombre['id_workcenter']; ?>"><?php echo $workcenter_nombre['workcenter']; ?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="observaciones">Observation:</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="meta_hora">Target Hour:</label>
                        <input type="text" name="meta_hora" id="meta_hora" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ciclo_estado">Status Cycle:</label>
                        <input type="text" name="ciclo_estado" id="ciclo_estado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Date:</label>
                        <input type="date" name="fecha_hora" id="fecha_hora" class="form-control">
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