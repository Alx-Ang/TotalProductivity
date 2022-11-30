<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_problema']) || empty($_POST['descripcion']) || empty($_POST['nombre_area']) || empty($_POST['status'])) {
            $alert = '<div class="alert alert-danger" role="alert">
                            Todo los campos son obligatorios
                        </div>';
        } else {
            $nombre_problema = $_POST['nombre_problema'];
            $descripcion = $_POST['descripcion'];
            $nombre_area = $_POST['nombre_area'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM problemas WHERE nombre_problema = '$nombre_problema'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<div class="alert alert-danger" role="alert">
                            El problema ya esta registrado con aterioridad
                        </div>';
            }else{
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO problemas (nombre_problema, descripcion, nombre_area, status) VALUES ('$nombre_problema', '$descripcion', '$nombre_area', '$status')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Nuevo problema registrado
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar un nuevo problema
                        </div>';
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
                <center>Problem</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre_problema">Problem Name:</label>
                        <input type="text" placeholder="" name="nombre_problema" id="nombre_problema" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Description:</label>
                        <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre_area">Area Name:</label>
                        <input type="text" placeholder="" name="nombre_area" id="nombre_area" class="form-control">
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
                    

                    <input type="submit" value="Guardar" class="btn btn-primary">
                    <a href="problems.php" class="btn btn-danger">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>