<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre']) || empty($_POST['material']) || empty($_POST['area_nombre']) || empty($_POST['subarea']) || empty($_POST['status'])) {
            $alert = '<center> <div class="alert alert-danger" role="alert">
                           ¡ Todo los campos son obligatorios !
                        </div> </center>';
        } else {
            $nombre = $_POST['nombre'];
            $material = $_POST['material'];
            $area_nombre = $_POST['area_nombre'];
            $subarea = $_POST['subarea'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM materia_prima WHERE material = '$material'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<center><div class="alert alert-danger" role="alert">
                           ¡ El material ya ha sido registrado !
                        </div></center>';
            }else{
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO materia_prima (nombre, material, area_nombre, subarea, status) VALUES ('$nombre', '$material', '$area_nombre', '$subarea', '$status')");
            if ($query_insert) {
                $alert = '<center><div class="alert alert-primary" role="alert">
                            Materia prima registrado
                        </div></center>';
            } else {
                $alert = '<center><div class="alert alert-danger" role="alert">
                           ¡ Error al registrar una materia prima !
                        </div></center>';
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
                <center>NEW RAW MATERIALS</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">Name:</label>
                        <input type="text" placeholder="" name="nombre" id="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="material">Material:</label>
                        <input type="text" placeholder="" name="material" id="material" class="form-control">
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
                                    <option value="">Select</option>
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
                        <input type="text" placeholder="" name="subarea" id="subarea" class="form-control">
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
                    <a href="rawMaterials.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>