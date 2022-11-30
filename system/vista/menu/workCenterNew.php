<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['workcenter']) || empty($_POST['modelo']) || empty($_POST['numero_serie']) || empty($_POST['fabricante']) || empty($_POST['area_nombre']) || empty($_POST['material']) || empty($_POST['status'] <  0)) {
            $alert = '<center><div class="alert alert-danger" role="alert">
                        ¡ Todo los campos son obligatorios !
                    </div></center>';
        } else {
            $workcenter = $_POST['workcenter'];
            $modelo = $_POST['modelo'];
            $numero_serie = $_POST['numero_serie'];
            $fabricante = $_POST['fabricante'];
            $area_nombre = $_POST['area_nombre'];
            $material = $_POST['material'];;
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM workcenter WHERE numero_serie = '$numero_serie'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ El numero de serie ya ha sido registrado !
                        </div> </center>';
            }else{
    
            $query_insert = mysqli_query($mysqli, "INSERT INTO workcenter (workcenter, modelo, numero_serie, fabricante, area_nombre,  material, status) VALUES ('$workcenter', '$modelo', '$numero_serie', '$fabricante', '$area_nombre', '$material', '$status')");

            if ($query_insert) {
                $alert = '<center> <div class="alert alert-primary" role="alert">
                            Nuevo work center registrado
                        </div> </center>';
            } else {
                $alert = '<center> <div class="alert alert-danger" role="alert">
                            ¡ Error al registrar un work center !
                        </div> </center>';
            }
            }
        }
    }
  
?>
    
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>NEW WORK CENTER</center>
            </div>
            <div class="card">
                <form action="" method="post" autocomplete="off" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="workcenter">Work Center:</label>
                        <input type="text" name="workcenter" id="workcenter" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="modelo">Model:</label>
                        <input type="text" name="modelo" id="modelo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="numero_serie">Serial Number:</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fabricante">Maker:</label>
                        <input type="text" name="fabricante" id="fabricante" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="area_nombre">Area Name:</label>
                        <div class="select">
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT *FROM areas");
                                $resultado = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                ?>
                            <select id="area_nombre" name="area_nombre" class="form-control">
                                <option selected disabled>Select</option>
                                <?php
                                if ($resultado > 0) {
                                    while ($area_nombre = mysqli_fetch_array($query)) {
                                    // code...
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
                        <div >
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT *FROM materia_prima");
                                $resultado = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                            ?>
                            <select id="material" name="material" class="form-control">
                                <option selected disabled>Select</option>
                                <?php
                                if ($resultado > 0) {
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
                        <div class="select">
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <center><input type="submit" value="Save" class="btn btn-primary">
                    <a href="workCenter.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>