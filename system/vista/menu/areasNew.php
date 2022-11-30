<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if ( empty($_POST['area_nombre']) || empty($_POST['material']) || empty($_POST['proceso']) || empty($_POST['subproceso']) || empty($_POST['status'])) {
            $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Todo los campos son obligatorios !
                        </div> </center>';
        } else {
            $area_nombre = $_POST['area_nombre'];
            $material = $_POST['material'];
            $proceso = $_POST['proceso'];
            $subproceso = $_POST['subproceso'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM areas WHERE area_nombre = '$area_nombre'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ El nombre del area ya ha sido registrado !
                        </div> </center>';
            }else{
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO areas (area_nombre, material, proceso, subproceso, status) VALUES ('$area_nombre', '$material', '$proceso', '$subproceso', '$status')");
            if ($query_insert) {
                $alert = '<center> <div class="alert alert-primary" role="alert">
                            Nueva area registrada
                        </div> </center>';
            } else {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Error al registrar una nueva area !
                        </div> </center>';
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
                <center>NEW AREA</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    
                    <div class="form-group">
                        <label for="area_nombre">Area Name:</label>
                        <input type="text" name="area_nombre" id="area_nombre" class="form-control">
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
                                    <option value="">Select</option>
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
                        <input type="text" name="proceso" id="proceso" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="subproceso">Sub-process:</label>
                        <input type="text" name="subproceso" id="subproceso" class="form-control">
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
                    <a href="areas.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>